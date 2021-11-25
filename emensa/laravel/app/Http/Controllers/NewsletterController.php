<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsletterRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use DB;
class NewsletterController extends Controller
{
    public function signupNL(NewsletterRequest $request){

        DB::table('newsletter')->insert([
            'email' =>$request->email,
            'username' => $request->name,
            'language'=>$request->language,
        ]);
        //Alert::success('Erfolg','Anmeldung für den Newsletter erfolgreich');
        session()->flash('success','Anmeldung für den Newsletter erfolgreich');
        return redirect('/#newsletter');
    }
}
