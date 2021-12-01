<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsletterRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Newsletter;

class NLAdminPanelController extends Controller
{
    public function viewPanel(){
        
        $Registrations = Newsletter::all();
        return view('nl-admin')->with('Registrations',$Registrations);
    }
    public function viewPanelSortedByNameAsc(){
        $Registrations = Newsletter::orderBy('username')->get();
        return view('nl-admin')->with('Registrations',$Registrations);
    }
    public function viewPanelSortedByEmailAsc(){
        $Registrations = Newsletter::orderBy('email')->get();
        return view('nl-admin')->with('Registrations',$Registrations);
    }
    public function search(Request $request){
        
        $search = $request->searchText;
        
        if(empty($search)){
            return redirect ("/showNewsletterAdmin");
        }
        
        $filteredRegistrations = Newsletter::where('username', 'LIKE', "%{$search}%")
        ->orWhere('email', 'LIKE', "%{$search}%")
        ->orWhere('language', 'LIKE', "%{$search}%")
        ->get();
        
        return view('nl-admin')->with('Registrations',$filteredRegistrations);
    }

}
