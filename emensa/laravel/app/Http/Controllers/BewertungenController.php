<?php

namespace App\Http\Controllers;

use App\Models\Bewertung;
use App\Models\Gericht;
use Illuminate\Http\Request;

class BewertungenController extends Controller
{
    public function bewertung(Request $request){
        //Zu bewertendes Gericht ermitteln
        $gericht = Gericht::where('id',$request->id)->limit(1)->get()->first();

        //Wenn der Nutzer noch nicht angemeldet ist
        if(!Auth()->User()){
            return redirect('/anmeldung');
        }
        //Wenn der Nutzer bereits angemeldet ist
        return view('bewertungen')->with('gericht',$gericht);
    }
    public function addBewertung(Request $request){
        $bewertung = $request->bewertung;
        if($bewertung != null){
            dd($bewertung);
        }
        else{
            return redirect()->back();
        }
    }
}
