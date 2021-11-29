<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsletterRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use DB;

class NLAdminPanelController extends Controller
{
    public function viewPanel(){
        
        $Registrations = DB::table('newsletter')->get();
        return view('nl-admin')->with('Registrations',$Registrations);
    }
    public function viewPanelSortedByNameAsc(){
        $Registrations = DB::table('newsletter')->orderBy('username')->get();
        return view('nl-admin')->with('Registrations',$Registrations);
    }
    public function viewPanelSortedByEmailAsc(){
        $Registrations = DB::table('newsletter')->orderBy('email')->get();
        return view('nl-admin')->with('Registrations',$Registrations);
    }
    public function search(Request $request){
        
        $search = $request->searchText;
        
        if(empty($search)){
            return redirect ("/showNewsletterAdmin");
        }
        
        $filteredRegistrations = DB::table('newsletter')
        ->where('username', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('language', 'LIKE', "%{$search}%")
        ->get();
        
        return view('nl-admin')->with('Registrations',$filteredRegistrations);
    }

}
