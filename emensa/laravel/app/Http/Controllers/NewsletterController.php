<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsletterRequest;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Newsletter;
class NewsletterController extends Controller
{
    public function signupNL(NewsletterRequest $request){

        Newsletter::create([
            'email' =>$request->email,
            'username' => $request->name,
            'language'=>$request->language,
        ]);
        
        session()->flash('success','Anmeldung für den Newsletter erfolgreich');
        return redirect('/#newsletter');
    }
}
