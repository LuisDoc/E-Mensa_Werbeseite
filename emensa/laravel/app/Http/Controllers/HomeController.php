<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\WunschgerichtRequest;
use App\Models\Ersteller;
use App\Models\Wunschgericht;
use App\Models\Gericht;
use App\Models\Kategorie;
use App\Models\Newsletter;
use App\Models\Allergen;
use DB;
use Carbon\Carbon;
class HomeController extends Controller
{
    public function index(){
        /*
            Informationen für alle Gerichte berechnen
        */
        $gerichte = Gericht::offset(0)
        ->limit(5)
        ->orderBy('name', 'asc')
        ->get();

        $GerichtAllergene = Gericht::with('allergene')->orderBy('name', 'asc')->get();
        $allergeneProGericht=array(
            0=> $GerichtAllergene->first()->allergene, 
            1=> $GerichtAllergene->get(1)->allergene, 
            2=> $GerichtAllergene->get(2)->allergene, 
            3=> $GerichtAllergene->get(3)->allergene, 
            4=> $GerichtAllergene->get(4)->allergene, 
            );
        $Allergene = [];
        $inAllergene = false;
        foreach($allergeneProGericht as $allergenProGericht){
            foreach($allergenProGericht  as $allergene){
                foreach($Allergene as $val){
                    if($val->code == $allergene->code )
                        $inAllergene=true;
                }
                if(!$inAllergene)
                    array_push($Allergene, $allergene);
                $inAllergene=false;
                    
            }
        }
       

        /*
            Informationen für E-Mensa in Zahlen sammeln
        */
        //
        // Berechnung der Besuche der Webseite
        //
        if(Session::get('counterViewer') >= 0){
            Session::put('counterViewer', Session::get('counterViewer')+1);
        }
        else{
            Session::put('counterViewer', 0);
        }
        Session::save();
        
        //
        // Berechnung NewsletterAnmneldungen
        //
        $counterNewsletterAnmeldungen = Newsletter::all()->count();
        
        //
        // Berechnung der Menge an Speisen
        //
        $counterSpeisen =Gericht::all()->count();
        

        /*
            Was uns wichtig ist
        */
        $wichtig= [
            "Beste frische saisonale Zutaten",
            "Ausgewogene abwechlungsreiche Zutaten",
            "Sauberkeit"
        ];
        /*
            Weiterleitung an View
        */
        //Alert::success('Hello');
        return view('index')
        ->with('Gerichte',$gerichte)
        ->with('Allergene',$Allergene)
        ->with('AllergeneProGericht',$allergeneProGericht)
        ->with('CounterNewsletterAnmeldungen',$counterNewsletterAnmeldungen)
        ->with('CounterSpeisen',$counterSpeisen)
        ->with('WasUnsWichtigIst',$wichtig);
    }
    public function requestMeal(){
        return view ('wunschgerichte');
    }
    public function validateMeal(WunschgerichtRequest $request){
        //Variablen verteilen
        $name = $request->name;
        $email = $request->email;
        $gericht = $request->gericht;
        $beschreibung = $request->beschreibung;
        
        //Name auf Inhalt überprüfen
        if(empty($name)){
            $name = "anonym"; //Wenn der Name leer ist, soll dieser auf anonym gesetzt werden
        }

        //Ersteller anlegen

        Ersteller::firstOrCreate([
            'name' => $name,
            'email' => $email
        ]);

        //Daten können hinzugefügt werden
        Wunschgericht::create([
            'created_at' => Carbon::now(),
            'gerichtname' => $gericht,
            'beschreibung' => $beschreibung,
            'ersteller_email' => $email
        ]);


        Alert::success('Erfolg','Ihr Wunschgericht wurde erfolgreich weitergeleitet');
        return redirect('/requestMeal');
    }
}
