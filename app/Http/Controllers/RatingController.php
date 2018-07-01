<?php

namespace App\Http\Controllers;

use App\Rating;
use App\User;
use App\Restaurant;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request, Rating $rating)
    {
        //check if rating exist
        $restaurant= Restaurant::find($id);
        if($rating = $restaurant->ratings->where('user_id',auth()->id())->first()){

        }else{
            //does not exist
            $rating = new Rating;
            request()->validate([ 
            'rating'=>'required|numeric|max:5|min:0',         
            ]);
            
        }
        $rating->restaurant_id=$id; 
        $rating->user_id=auth()->id();     
        $rating->rating= request('rating');
        $rating->save();
        $restaurant->refresh();
        $overall = $restaurant->ratings->avg('rating');        
        $restaurant->overall_rating = $overall;
        $restaurant->save();
        return redirect()->route('restaurant.show',['id' => $id]);
        // $restaurants = Restaurant::all(); 
        // foreach ($restaurants as $restaurant) { 
                     
        //     $restaurant->overall_rating = $restaurant->ratings->avg('rating');
        //     $restaurant->save(); 
        // }
       
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        //
    }
}
