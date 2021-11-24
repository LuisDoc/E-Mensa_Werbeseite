<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
class HomeController extends Controller
{
    public function index(){
        /*
            Informationen für alle Gerichte berechnen
        */
        $Allergene = DB::table('gericht_hat_allergen')
        ->join('allergen','gericht_hat_allergen.code','=','allergen.code')
        ->orderBy('gericht_hat_allergen.code')
        ->get();

        $gerichte = DB::table('gericht')
        ->limit(5)
        ->orderBy('name')
        ->get();
        /*
        Berechnung aller vorkommenden Allergene
        */
        $vorkommendeAllergene = [];
        $allergeneProGericht = [];

        foreach($gerichte as $gericht){
            foreach($Allergene as $all){
                if($all->gericht_id == $gericht->id){
                    //Wenn für das Gericht schon Einträge vorhanden sind
                    if(!empty($allergeneProGericht[$gericht->id])){
                        $allergeneProGericht[$gericht->id] = $allergeneProGericht[$gericht->id]." ".$all->code;
                    }
                    else{
                        $allergeneProGericht[$gericht->id] = $all->code;
                    }
                    
                    $gefunden = false;
                    foreach($vorkommendeAllergene as $bereitsNotierteAllergene){
                        if($bereitsNotierteAllergene->code == $all->code){
                            $gefunden = true;
                        }
                    }
                    if(!$gefunden){
                        array_push($vorkommendeAllergene,$all);
                    }
                   
                }
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
        $counterNewsletterAnmeldungen = DB::table('newsletter')->count();
        
        //
        // Berechnung der Menge an Speisen
        //
        $counterSpeisen = DB::table('gericht')->count();;
        

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
        Alert::success('Hello');
        return view('index')
        ->with('Gerichte',$gerichte)
        ->with('Allergene',$Allergene)
        ->with('AlleAllergene',$vorkommendeAllergene)
        ->with('AllergeneProGericht',$allergeneProGericht)
        ->with('CounterNewsletterAnmeldungen',$counterNewsletterAnmeldungen)
        ->with('CounterSpeisen',$counterSpeisen)
        ->with('WasUnsWichtigIst',$wichtig);
    }
}
