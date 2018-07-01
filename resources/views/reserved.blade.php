@extends('layouts.browser')
@section('content')
  @if($parts->count()==0)
  <div class="card border-primary mt-4">            
            <div class="card-body text">
              You do not have any parts reserved browse our site and claim any part that you like.<br>

              <p>Click <a href="/parts" class="btn btn-outline-info ">Browse Parts</a> to browse our listings</p>
            </div>
   </div>           
  @endif
       
  @foreach($parts as $part)
          <div class="card mt-4">
            <img class="card-img-top img-fluid cropped" src="/images/{{$part->preview_image}}" alt="">
            <div class="card-body">
              <h3 class="card-title"><a href="/part/{{$part->id}}">{{$part->aggregated_name}}</a> 
              @if(!$part->isClaimed())
                <span class="badge badge-success">Available</span>
              @else
                <span class="badge badge-danger">Claimed</span>
              @endif
              </h3> 
              <hr>
              <h4>Descripton</h4>            
              <p class="card-text">{{$part->description}}</p>
              <p class="card-text">Collection Point:{{$part->collection_point}}<br>
                Date Posted : {{$part->created_at->toFormattedDateString()}}
              </p>
              @if(auth()->user()->id==$part->receiver_id)
                 <h5 class="text-success">This item has been claimed by You</h5>
                 
              @endif
              
              <p>
                 @if(auth()->user()->id!==$part->user_id && !$part->isClaimed())
                 <a href="/part/{{$part->id}}/claim" class="btn btn-outline-success btn-lg">Claim</a>
                 @endif
                 
                 <a href="/part/{{$part->id}}" class="float-right btn btn-outline-info btn-lg">More Info</a>
                 
                 
              </p>

              
            </div>
          </div>

          <!-- /.card -->
@endforeach
          
        <div class="mt-4 mx-auto"> 
          {{$parts->render('pagination::bootstrap-4')}}
        </div>

        
        
@endsection