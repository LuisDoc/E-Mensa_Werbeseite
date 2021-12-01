<?php

namespace App\Http\Controllers;
use App\Models\Kategorie;
use App\Models\Gericht;
use Illuminate\Http\Request;
use DB;
class ExampleController extends Controller
{
    public function queryparameter(Request $request){
        return view('examples.m4_6a_queryparameter')->with('name', $request->name);
    }

    public function kategorie(){
        return view('examples.m4_6b_kategorie')->with('kategorien', Kategorie::orderBy('name','asc')->get());
    }

    public function gerichte(){
        return view('examples.m4_6c_gerichte')->with('gerichte', Gericht::where('preis_intern','>','2.0')->orderBy('name')->get());
    }

    public function pick_page(Request $request){
        if($request->no==1){
            return view('examples.m4_6d_page_1');
        }
        else if($request->no==2){
            return view('examples.m4_6d_page_2');
        }
        else if($request->no==3){
            return view('examples.m4_6d_page_3');
        }

        return view('examples.m4_6d_page_1');
    }
}
