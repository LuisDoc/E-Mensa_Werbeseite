<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class HomeController extends Controller
{
    public function index(){
        $gerichte =DB::table('gericht')
        ->select ('gericht.name','gericht.preis_intern','gericht.preis_extern',DB::raw('GROUP_CONCAT(gericht_hat_allergen.code)as Allergien'))
        ->join('gericht_hat_allergen','gericht.id','=','gericht_hat_allergen.gericht_id')
        ->pluck('gericht_hat_allergen.code')
        ->orderBy('gericht.id')
        ->limit(5)
        ->get();


        dd($gerichte);
        $allergene = [];



        foreach($gerichte as $gericht){

            $allergeneProGericht = DB::table('gericht_hat_allergen')
                                    ->where('gericht_id','=',$gericht->id)
                                    ->get();


            
        }
        
        return view('index')->with('Gerichte',$gerichte);
    }
}
