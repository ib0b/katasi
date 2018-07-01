<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class SessionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(!auth()->attempt(request(['username','password']),request('remember'))){
            return back()->withErrors(['username' => 'Username or Password does not match']);
        }
        return redirect()->route('restaurants');

         
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
    public function edit()
    {
        //
          $this->validate(request(),[            
            'name'=>'required|string',            
            'mobile_number'=>'required|string',
            'country'=>'nullable|string',
            'city'=>'nullable|string',           
            
            ]);
          $user = auth()->user();
          $user->name = request('name');
          $user->mobile_number = request('mobile_number');
          $user->city = request('city');
          $user->city = request('country');
          $user->save();
          
          return redirect('myprofile')->with('success','Successfully saved your profile.');
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
    public function destroy()
    {
        //
        auth()->logout();
        return redirect()->route('landing');
    }
}
