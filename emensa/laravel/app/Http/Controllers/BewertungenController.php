<?php

namespace App\Http\Controllers;

use App\Models\Bewertung;
use App\Models\Gericht;
use RealRashid\SweetAlert\Facades\Alert;
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
        
        $bewertungen = Bewertung::where('gericht_id',$request->id)->orderByDesc('created_at')->limit(30)->get();
        
        return view('bewertungen')->with('gericht',$gericht)->with('bewertungen',$bewertungen);
    }
    /*
    *
    */
    public function addBewertung(Request $request, $id){
        //Daten Sammeln
        $gericht = Gericht::find($id);
        $user_id = Auth()->User()->id;
        
        //Validierung
        $attributes = $request->validate([
            'bemerkung' => 'min:5',
        ]);

        if($request->bewertung == null){
            Alert::error('Fehler','Geben Sie eine Bewertung');
            return redirect()->back();
        }
        
        Bewertung::create([
            'highlighted' => false,
            'bewertung' => $request->bewertung,
            'bemerkung' =>$attributes['bemerkung'],
            'user_id' => auth()->user()->id,
            'gericht_id' => $gericht->id,
        ]);
        Alert::success('Erfolg','Die Bewertung wurde erfolgreich erstellt');
        return redirect()->back();
    }

    public function highlight($id){
        $bewertung = Bewertung::find($id);
        //Toggle Highlight Status
        if($bewertung->highlighted == 1){
           $bewertung->highlighted = 0;
           $bewertung->save();
           Alert::success('Erfolg','Die Markierung der Bewertung wurde erfolgreich aufgehoben');
        }
        else{
           $bewertung->highlighted = 1;
           $bewertung->save();
           Alert::success('Erfolg','Die Markierung der Bewertung wurde erfolgreich gesetzt');
        }
        return redirect()->back();
    }

    
    public function MyBewertungen(){
        $bewertungen = auth()->user()->bewertungen()->orderBy('created_at', 'desc')->get();;

        return view('meineBewertungen')->with('bewertungen', $bewertungen);
    }

    public function destroy($id){
        $Bewertung = Bewertung::find($id);
        $Bewertung->delete();
        return redirect()->back();
    }

    public function bewertungen(){
        $bewertungen = Bewertung::orderByDesc('created_at')->limit(30)->get();

        return view('letzten30bewertungen')->with('bewertungen', $bewertungen);
    }
}
