<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    //
    public function index()
    {   
        if (auth()->user()->isVerified()) {
          return redirect()->route('parts')->with('success','Account has been Verified');
        }
    	return view('auth.verify');
    }
    public function verify($username,$token)
    {		
    	User::where(['username'=>$username ,'verification_token'=>$token])->firstOrFail()->update(['verification_token'=>null, 'verified'=>true]);
    	
    	return redirect()->route('parts')->with('success','Account Verified');
    }
}
