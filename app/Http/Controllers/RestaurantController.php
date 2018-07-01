<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Restaurant;
use App\RestaurantImage;
use Storage;
use File;
use Illuminate\Contracts\Filesystem\Filesystem;
class RestaurantController extends Controller
{
    //
    public function index()
    {
        //
      $restaurants = Restaurant::orderBy('overall_rating','desc')->paginate(5);
        return view('restaurants')->with('restaurants', $restaurants);
    }

    public function new()
    {
        return view('addrestaurant');
    }
    public function claim($id)
    {
        $restaurant = Restaurant::find($id);
         if(!$restaurant || $restaurant->user_id==auth()->id() ||$restaurant->isClaimed()){
          //return back
              return redirect()->route('restaurants');
         }
         
         $restaurant->receiver_id=auth()->id();
         $restaurant->save();
         return redirect()->route('restaurant.show',[$restaurant])->with('success','Successfully claimed . Contact the user owner to collect it.');

    }
    public function restore($id)
    {
        $restaurant = Restaurant::find($id);
         if(!$restaurant || $restaurant->user_id!=auth()->id() ||!$restaurant->isClaimed()){
          //return back
              return redirect()->route('restaurants');
         }
         
         $restaurant->receiver_id=0;
         $restaurant->save();
         return redirect()->route('restaurant.show',[$restaurant])->with('success','Your restaurant is now available.');

    }
    public function search()
    {
        $query=request('q');
        $restaurants = Restaurant::where('name','like','%'.$query.'%')->orderBy('overall_rating','desc')->paginate(5);
       
        return view('restaurants')->with('restaurants', $restaurants);
    }
    public function unclaim($id)
    {
        $restaurant = Restaurant::find($id);
         if(!$restaurant || $restaurant->receiver_id!=auth()->id() ||!$restaurant->isClaimed()){
          //return back
              return redirect()->route('restaurants');
         }
         
         $restaurant->receiver_id=0;
         $restaurant->save();
         return redirect()->route('restaurant.show',[$restaurant])->with('success','Your restaurant is now available.');

    }
    public function myrestaurants()
    {
      $restaurants = auth()->user()->restaurants()->orderBy('overall_rating','desc')->paginate(5);
      return view('myrestaurants')->with('restaurants', $restaurants);
    }
    public function reserved()
    {
      $restaurants = auth()->user()->reserved()->paginate(5);
      return view('reserved')->with('restaurants', $restaurants);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        //
      
         $restaurant = new restaurant;
            request()->validate([            
            'name'=>'required|string',            
            'seat_capacity'=>'required|numeric',
            'location'=>'required|string',
            'description'=>'required|string', 
            'images.*'=>'nullable|image'           
                                 
            
            ]);
            
            
          $restaurant->name = request('name');
          $restaurant->seat_capacity = request('seat_capacity');
          $restaurant->location = request('location');          
          $restaurant->description = request('description');          
          $restaurant->user_id=auth()->id();         
          $restaurant->save();

        
            

            if(!empty($request->images)){
              $first = true;
              foreach($request->images as $image){
                
                $restaurantImage = new RestaurantImage;
                $restaurantImage->restaurant_id = $restaurant->id;
                $restaurantImage->image_name = "image".$restaurantImage->id.$image->getClientOriginalName();
                $restaurantImage->save();
                $filename  = $restaurantImage->image_name;
                Storage::put($filename, file_get_contents($image));
                if ( $first )
                  {
                    $restaurant->preview_image =$restaurantImage->image_name;
                    $restaurant->save();
                    $first = false; //in order not to get into the if statement for the next loops
                  }
              }  
            }
           
       
          
        return redirect('myrestaurants')->with('success','Successfully added your restaurant');
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
        $restaurant = Restaurant::find($id);
        if(!$restaurant){
            return redirect('restaurants');
        }
        return view('restaurantshow')->with('restaurant', $restaurant);
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
           $restaurant = Restaurant::find($id);
           if(!$restaurant || $restaurant->user_id!=auth()->id()){
            //return back
                return redirect()->route('restaurants');
           }else{
                return view('editrestaurant',compact('restaurant'));
           } 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //

        request()->validate([            
            'name'=>'required|string',            
            'seat_capacity'=>'required|numeric',
            'location'=>'required|string',
            'description'=>'required|string',            
            'images.*'=>'image'                     
            
            ]);
           $restaurant = Restaurant::find($id);
           if(!$restaurant || $restaurant->user_id!=auth()->id()){
            //return back
                return redirect()->route('restaurants');
           }
            
            
          $restaurant->name = request('name');
          $restaurant->seat_capacity = request('seat_capacity');
          $restaurant->location = request('location');          
          $restaurant->description = request('description');          
          $restaurant->user_id=auth()->id();         
          $restaurant->save();
         
          if(!empty($request->images)){
             if($restaurant->preview_image!="default.jpg"){
                //do not change default
                $first = false;
              }else{
                $first = true;
                //change default
              }
                
              foreach($request->images as $image){
                
                $restaurantImage = new RestaurantImage;
                $restaurantImage->restaurant_id = $restaurant->id;
                $restaurantImage->image_name = "image".$restaurantImage->id.$image->getClientOriginalName();
                $restaurantImage->save();

                $filename  = $restaurantImage->image_name;
                Storage::put($filename, file_get_contents($image));
                if ( $first )
                  {
                    $restaurant->preview_image =$restaurantImage->image_name;
                    $restaurant->save();
                    $first = false; //in order not to get into the if statement for the next loops
                  }
              }  
          }

          return redirect()->route('restaurant.show',[$restaurant])->with('success','Successfully updated your restaurant');;

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
        $restaurant = Restaurant::find($id);
           if(!$restaurant || $restaurant->user_id!=auth()->id()){
            //return back
                return redirect()->route('restaurants');
           }
           if ($restaurant->preview_image!='default.jpg') {
               foreach ($restaurant->restaurantImages as $image) {
                   Storage::delete($image->image_name);
               }
           }
           
           $restaurant->delete();
           return redirect()->route('restaurants')->with('success','Successfully deleted your restaurant');

    }
}
