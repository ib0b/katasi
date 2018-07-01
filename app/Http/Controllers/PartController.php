<?php

namespace App\Http\Controllers;

use App\Part;
use App\PartImage;
use Illuminate\Http\Request;
use Storage;
use File;
use Illuminate\Contracts\Filesystem\Filesystem;

class PartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $parts = Part::orderBy('receiver_id','asc')->paginate(5);
        return view('parts')->with('parts', $parts);
    }

    public function new()
    {
        return view('addpart');
    }
    public function claim($id)
    {
        $part = Part::find($id);
         if(!$part || $part->user_id==auth()->id() ||$part->isClaimed()){
          //return back
              return redirect()->route('parts');
         }
         
         $part->receiver_id=auth()->id();
         $part->save();
         return redirect()->route('part.show',[$part])->with('success','Successfully claimed . Contact the user owner to collect it.');

    }
    public function restore($id)
    {
        $part = Part::find($id);
         if(!$part || $part->user_id!=auth()->id() ||!$part->isClaimed()){
          //return back
              return redirect()->route('parts');
         }
         
         $part->receiver_id=0;
         $part->save();
         return redirect()->route('part.show',[$part])->with('success','Your Part is now available.');

    }
    public function search()
    {
        $query=request('q');
        $parts = Part::where('aggregated_name','like','%'.$query.'%')->orderBy('receiver_id','asc')->paginate(5);
       
        return view('parts')->with('parts', $parts);
    }
    public function unclaim($id)
    {
        $part = Part::find($id);
         if(!$part || $part->receiver_id!=auth()->id() ||!$part->isClaimed()){
          //return back
              return redirect()->route('parts');
         }
         
         $part->receiver_id=0;
         $part->save();
         return redirect()->route('part.show',[$part])->with('success','Your Part is now available.');

    }
    public function myparts()
    {
      $parts = auth()->user()->parts()->orderBy('receiver_id','asc')->paginate(5);
      return view('myparts')->with('parts', $parts);
    }
    public function reserved()
    {
      $parts = auth()->user()->reserved()->paginate(5);
      return view('reserved')->with('parts', $parts);
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
        
         $part = new Part;
            request()->validate([            
            'name'=>'required|string',            
            'year'=>'required|numeric',
            'model'=>'required|string',
            'description'=>'required|string',
            'collection_point'=>'required|string', 
            'images.*'=>'file'                     
            
            ]);
            
            
          $part->name = request('name');
          $part->year = request('year');
          $part->collection_point = request('collection_point');          
          $part->description = request('description');
          $part->car_model= request('model');
          $part->user_id=auth()->id();          
          $part->aggregated_name= request('model').' '.request('name').' '.request('year');
          $part->save();

        
            

            if(!empty($request->images)){
                $first = true;
              foreach($request->images as $image){
                
                $partImage = new PartImage;
                $partImage->part_id = $part->id;
                $partImage->image_name = "image".$partImage->id.$image->getClientOriginalName();
                $partImage->save();
                $filename  = $partImage->image_name;
                Storage::put($filename, file_get_contents($image));
                if ( $first )
                  {
                    $part->preview_image =$partImage->image_name;
                    $part->save();
                    $first = false; //in order not to get into the if statement for the next loops
                  }
              }  
            }
           
       
          
        return redirect('myparts')->with('success','Successfully added your part');
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
        $part = Part::find($id);
        if(!$part){
            return redirect('parts');
        }
        return view('partshow')->with('part', $part);
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
           $part = Part::find($id);
           if(!$part || $part->user_id!=auth()->id()){
            //return back
                return redirect()->route('parts');
           }else{
                return view('editpart',compact('part'));
           } 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
        request()->validate([            
            'name'=>'required|string',            
            'year'=>'required|numeric',
            'model'=>'required|string',
            'description'=>'required|string',
            'collection_point'=>'required|string', 
            'images.*'=>'file'                     
            
            ]);
           $part = Part::find($id);
           if(!$part || $part->user_id!=auth()->id()){
            //return back
                return redirect()->route('parts');
           }
            
            
          $part->name = request('name');
          $part->year = request('year');
          $part->collection_point = request('collection_point');          
          $part->description = request('description');
          $part->car_model= request('model');
          $part->user_id=auth()->id();          
          $part->aggregated_name= request('model').' '.request('name').' '.request('year');
          $part->save();

          return redirect()->route('part.show',[$part]);

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
        $part = Part::find($id);
           if(!$part || $part->user_id!=auth()->id()){
            //return back
                return redirect()->route('parts');
           }
           if ($part->preview_image!='default.jpg') {
               foreach ($part->partImages as $image) {
                   Storage::delete($image->image_name);
               }
           }
           
           $part->delete();
           return redirect()->route('parts')->with('success','Successfully deleted your part');

    }
}
