<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    public function index(){

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

        return view('index')->with('Gerichte',$gerichte)->with('Allergene',$Allergene)->with('AlleAllergene',$vorkommendeAllergene)->with('AllergeneProGericht',$allergeneProGericht);
    }
}
