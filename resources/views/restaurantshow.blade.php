@extends('layouts.browser')
@section('content')

       

          <div class="card mt-4">
            @if($restaurant->preview_image!='default.jpg')
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              @for ($i = 1; $i < $restaurant->restaurantImages->count(); $i++)                  
                <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}"></li>                
              @endfor
              </ol>
              <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                  <img class="d-block img-fluid" src="/images/{{$restaurant->restaurantImages[0]->image_name}}" alt="Image">
                </div>
                @for ($i = 1; $i < $restaurant->restaurantImages->count(); $i++)                  
                <div class="carousel-item">
                  <img class="d-block img-fluid" src="/images/{{$restaurant->restaurantImages[$i]->image_name}}" alt="Image">
                </div>                
                @endfor
                
              </div>
              <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
            </div>
            @else
            <img class="card-img-top img-fluid" src="/images/{{$restaurant->preview_image}}" alt="">
            @endif


            <div class="card-body">
              <h2 class="card-title"><span class="">({{$restaurant->ratings->count()}})
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
                 
                </span>{{$restaurant->name}}
              
              </h2> 
              <hr>
              <h3>Description</h3>            
              <p class="card-text">{{$restaurant->description}}</p>
              <p class="card-text">Location :{{$restaurant->location}}<br>
                Number of Ratings : <b>{{$restaurant->ratings->count()}}</b><br>
                Date Added : {{$restaurant->created_at->toFormattedDateString()}}
              </p>              
              <p>
                 
                @if(auth()->user()->id==$restaurant->user_id) 
                 <a href="/restaurant/{{$restaurant->id}}/edit" class="btn btn-outline-info btn-lg">Edit Details</a>
                  <a href="/restaurant/{{$restaurant->id}}/delete" class="float-right btn btn-outline-danger btn-lg">Delete</a>
                @endif
                 
                 
                 
              </p>

              
            </div>
          </div>
          <!-- /.card -->

          <div class="card bg-dark text-white my-4">
            <div class="card-header">
              My Rating
            </div>
            <div class="card-body bg-dark text-white">
              <h3 class="card-title">The following is your rating.

              <span class="">
                  @php
                  //check of rated
                  $checked = round($restaurant->overall_rating);
                  $unchecked = 5-$checked;
                  if($rating = $restaurant->ratings->where('user_id',auth()->id())->first()){
                    //found rating 
                    $rating = $rating->rating;
                    $checked = round($rating);
                    $unchecked = 5-$checked;
                  }else{
                    //rating =0
                    $rating = 0;
                    $checked =0;
                    $unchecked = 5;
                  }
                   
                  @endphp                  
                  @while ($checked>0)
                      <span class="fa fa-star checked"></span>
                      @php $checked-- @endphp 
                  @endwhile
                  @while ($unchecked>0)
                      <span class="fa fa-star"></span>
                      @php $unchecked-- @endphp 
                  @endwhile                
                 
                </span></h3>
              @if(!($rating))
                <span class="font-italic">You haven't rated this restaurant. Rate it below</span>
              @endif
              <p>The final rating is averaged out from all our users who have rated the restaurant.</p>             
              <hr>
              <p>
                
                 <form class="form-horizontal" method="POST" action="/rating/{{$restaurant->id}}/edit" enctype="multipart/form-data">
                        {{ csrf_field() }}
                       <div class="form-group">
                            <label for="rating" class="col-md-4 control-label">Rate out of 5 : (0-5)</label>
                            <div class="col-9">
                                <input id="rating" type="number" min="0" max="5" class="form-control" name="rating" value="{{$rating}}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-9 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                </form>
               
              
            </div>
          </div>
          
          <!-- /.card -->

        
@endsection