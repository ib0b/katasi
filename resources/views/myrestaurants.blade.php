@extends('layouts.browser')
@section('content')
  @if($restaurants->count()==0)
  <div class="card border-info mt-4">            
            <div class="card-body text">
              You do not have any restaurants listed on our site.<br>

              <p>Click <a href="/restaurant/new" class="btn  btn-outline-info">Add restaurant</a> to add a restaurant to our site</p>
            </div>
   </div>           
  @endif
   
       
  @foreach($restaurants as $restaurant)
          <div class="card mt-4">
            <img class="card-img-top img-fluid cropped" src="/images/{{$restaurant->preview_image}}" alt="">
            <div class="card-body">
              <h3 class="card-title"><a href="/restaurant/{{$restaurant->id}}">
                <span class="">
                  ({{$restaurant->ratings->count()}})
                  @php
                   $checked = round($restaurant->overall_rating);
                   $unchecked = 5-$checked;
                  @endphp                  
                  @while ($checked>0)
                      <span class="fa fa-star checked"></span>
                      @php $checked-- @endphp 
                  @endwhile
                  @while ($unchecked>0)
                      <span class="fa fa-star"></span>
                      @php $unchecked-- @endphp 
                  @endwhile                
                 
                </span>
                {{$restaurant->name}}</a>             
                
              
              </h3> 
              <hr>
              <h4>Description</h4>            
              <p class="card-text">{{$restaurant->description}}</p>
              <p class="card-text">Location:{{$restaurant->lcoation}}<br>
                Date Addedd : {{$restaurant->created_at->toFormattedDateString()}}
              </p>
           
              <p>                               
                 <a href="/restaurant/{{$restaurant->id}}" class="float-right btn btn-outline-info btn-lg">More Info</a>   
                 @if(auth()->user()->id==$restaurant->user_id) 
                 <a href="/restaurant/{{$restaurant->id}}/edit" class="btn btn-outline-dark btn-lg">Edit Details</a>
                  <a href="/restaurant/{{$restaurant->id}}/delete" class="float-right mr-2 btn btn-outline-danger btn-lg">Delete</a>
                @endif              
              </p>

              
            </div>
          </div>

          <!-- /.card -->
@endforeach
          
        <div class="mt-4 mx-auto"> 
          {{$restaurants->render('pagination::bootstrap-4')}}
        </div>
@endsection