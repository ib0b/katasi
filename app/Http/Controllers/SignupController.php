<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Notifications\VerifyEmail;
class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth.register');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        $this->validate(request(),[
            'username'=>'required|string|max:255|unique:users',
            'email'=>'required|string|email|max:255|unique:users',
            'name'=>'required|string',
            'password'=>'required|string|min:6|confirmed',
            'mobile_number'=>'required|string',
            'country'=>'nullable|string',
            'city'=>'nullable|string',
            
            
            ]);
        $user=User::create([
            'username' => request('username'),
            'email' => request('email'),
            'country' => request('country'),
            'city' => request('city'),
            'mobile_number' => request('mobile_number'),
            'name' => request('name'),
            'password' => bcrypt(request('password')),
            'verification_token'=>str_random(45)
            
        ]);
        $user->notify(new VerifyEmail($user));
        auth()->login($user);
        return redirect()->route('verifyAccount');
    }
    public function resendVerification()
    {
        $user = auth()->user();
        $user->notify(new VerifyEmail($user));
        return  redirect()->route('verifyAccount')->with('success','Email has been resent.');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
