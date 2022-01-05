<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\DomainRules;
use Hash;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function indexLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        
 
        $validator = Validator::make($request->all(), [
            'email' => 'email|string|email',
            'passwort' =>'required|string',
        ]);

        if($validator->fails()){
            Log::channel('authentication')->warning('[Login] Userauthentication failed (validation error)');
            return redirect('/anmeldung')->withErrors($validator)->withInput();
        }

        if(!$request->session()->has('attempts')){
            session()->put('attempts',0);
        }


        $credentials = $request->only('email', 'passwort');
        if(!Auth::attempt([
            'email' => $request->email,
            'password' => $request->passwort]
        )){
            $attempts = session()->get('attempts');
            session()->put('attempts',$attempts+1);
            if(!$request->session()->has('letzter_fehler')){
                session()->put('letzter_fehler',Carbon::now());
            }
            Log::channel('authentication')->warning('[Login] Userauthentication failed, (invalid Auth-attempt)');

            Alert::error('Fehler', 'Benutzerdaten stimmen nicht überein');
            return redirect('/anmeldung')->withErrors($validator);
        }
        $benutzeremail;
        DB::beginTransaction();
        try{
            $benutzer = User::where('email', $request->email)->first();
            $benutzeremail = $benutzer->email;
            $fehler = $benutzer->anzahlfehler;
            $benutzer->anzahlfehler= $fehler+ session()->get('attempts');
            $anmeldungen = $benutzer->anzahlanmeldungen;
            $benutzer->letzteanmeldung = Carbon::now();
            if($request->session()->has('letzter_fehler')){
                $benutzer->letzterfehler = session()->get('letzter_fehler');
            }
            $benutzer->save();

            DB::select('call increment_logincounter(?);', [$benutzer->id]);

        }
        catch(Exception $e){
            DB::rollback();
        }


        DB::commit();

        Log::channel('authentication')->info('User '.$benutzeremail.' has been logged in');

        Alert::success('Erfolg', 'Benutzer eingeloggt');
        return redirect('/');
    }

    public function indexRegister(){
        return view ('auth.register');
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required','max:100', 'unique:benutzer','email',  new DomainRules()],
            'password' =>'required|string|min:8|confirmed|max:200',
            'password_confirmation' => 'required',
        ]);

        if($validator->fails()){
            Log::channel('authentication')->warning('[Register] Userauthentication failed (validation error)');
            return redirect('/registrieren')->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try{
            User::create([
                'email' =>$request->email,
                'passwort' => Hash::make($request->password),
                'letzteanmeldung' => Carbon::now(),
                'admin' => false,
                'anzahlanmeldungen'=>0,
                'anzahlfehler' =>0,
                'letzterfehler' =>null,
    
            ]);
        }catch(Exception $e){
            DB::rollback();
        }
        
        DB::commit();
        Log::channel('authentication')->info('User '.$request->email.' has been registered');
        Alert::success('Erfolg', 'Benutzer registriert');
        return redirect('/');
    }

    public function signOut(){
        session()->flush();
        
        $email = auth()->User()->getEmail();
        Auth::logout();
        Log::channel('authentication')->info('User '.$email.' has been logged out');
        return redirect('/');
    }


}
