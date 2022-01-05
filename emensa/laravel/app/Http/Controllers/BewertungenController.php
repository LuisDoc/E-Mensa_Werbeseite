<?php

namespace App\Http\Controllers;

use App\Models\Bewertung;
use App\Models\Gericht;

use Illuminate\Http\Request;

class BewertungenController extends Controller
{
    /*
    *
    */
    public function bewertung(Request $request){
        //Zu bewertendes Gericht ermitteln
        $gericht = Gericht::where('id',$request->id)->limit(1)->get()->first();

        //Wenn der Nutzer noch nicht angemeldet ist
        if(!Auth()->User()){
            return redirect('/anmeldung');
        }
        
        $bewertungen = Bewertung::orderByDesc('created_at')->limit(30)->get();
        $bewertung = Bewertung::find(1);
        dd($bewertung->user());       //Wenn der Nutzer bereits angemeldet ist
        return view('bewertungen')->with('gericht',$gericht)->with('bewertungen',$bewertungen);
    }
    /*
    *
    */
    public function addBewertung(Request $request, $id){
        //Daten Sammeln
        $gericht = Gericht::find($id);
        $user_id = Auth()->User()->id;
        
        $attributes = $request->validate([
            'bemerkung' => 'min:5'
        ]);

        //Validierung der Bewertung
        if($bewertung->count_chars < 5){
            Alert::error('Fehler','Bitte geben Sie eine Bewertung, mit mindestens 5 Zeichen ein.');
            return view('bewertungen')->with('gericht',$gericht);
        }

        Bewertung::create([
            'highlighted' => false,
            'bewertung' => $request->bewertung,
            'bemerkung' =>$attributes['bemerkung'],
            'user_id' => auth()->user()->id,
            'gericht_id' => $gericht->id,
        ]);
    }
}
