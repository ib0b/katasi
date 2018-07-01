@extends('layouts.browser')
@section('content')
  @if($restaurants->count()==0 && isset($_GET['q']))
  <div class="card border-danger mt-4">            
            <div class="card-body text">
              Your search term - <strong>{{$_GET['q']}}</strong> - did not match any restaurants listed.<br>

              <p>Suggestions:</p>
              <ul>
                <li>Make sure that all words are spelled correctly.</li>
                <li>Try different keywords.</li>
                <li>Try more general keywords.</li>
              </ul>
              
            </div>
   </div>           
  @endif
  
  @if($restaurants->count()!=0 && isset($_GET['q']))
  <div class="card border-success mt-4">            
            <div class="card-body text">
              Your search term - <strong>{{$_GET['q']}}</strong> - retrieved the following listings<br>

           
              
            </div>
   </div>           
  @endif  
  @foreach($restaurants as $restaurant)
          <div class="card mt-4">
            <img class="card-img-top img-fluid cropped" src="/images/{{$restaurant->preview_image}}" alt="">
            <div class="card-body">
              <h3 class="card-title"> ({{$restaurant->ratings->count()}})<a href="/restaurant/{{$restaurant->id}}">
               
                <span class="">
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
                 
                </span>{{$restaurant->name}}</a> 
            
              </h3> 
              <hr>
              <h4>Description</h4>            
              <p class="card-text">{{$restaurant->description}}</p>
              <p class="card-text">Location:  <strong>{{$restaurant->location}}</strong><br>
                Date Added : <strong>{{$restaurant->created_at->toFormattedDateString()}}</strong>
              </p>
             
              
              
              <p>
                 
                 
                 <a href="/restaurant/{{$restaurant->id}}" class="float-right btn btn-outline-info btn-lg">More Info</a>
                 
                 
              </p>

              
            </div>
          </div>

          <!-- /.card -->
@endforeach
          
        <div class="mt-4 mx-auto"> 
          {{$restaurants->render('pagination::bootstrap-4')}}
        </div>

        
        
@endsection