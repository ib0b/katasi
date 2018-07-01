@php
$user = auth()->user();
@endphp
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>{{ config('app.name') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
    <link href="/css/navbar-fixed.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark" style="background-color: #133640!important">
      <a class="navbar-brand mr-3" href="#"><img class="" width="140px" src="/katasi.png" alt="{{ config('app.name') }}"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item ">
            <a class="nav-link" href="/restaurants">Browse Restaurants <span class="sr-only">(current)</span></a>
          </li>          
        </ul>
        <form class="form-inline col-4 mt-2 mt-md-0" method="GET" action="/search">
          <input class="form-control mr-sm-2 col-9" type="text" name="q" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
        <ul class="navbar-nav">
          <li class="nav-item dropdown" >
            <span class="nav-link dropdown-toggle" data-toggle="dropdown" href="/parts">{{$user->name}}</span></span>
            <div class="dropdown-menu dropdown-menu-right ">
              
              <a class="dropdown-item" href="/myrestaurants">My Restaurants</a>
              <a class="dropdown-item" href="/myprofile">My Profile</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item text-danger" href="/logout">Logout </a>
            </div>  
          </li>
                  
        </ul>
      </div>
    </nav>

    <main role="main" class="container">
     
      <div class="row">
      	
        <div class="col-lg-9">
            @if(session("success"))
                      <div class="card border-success mx-auto mb-3 text-center">
                        <div class="card-header">Success</div>      
                      <div class="card-block">
                        <blockquote class="card-blockquote m-2 text-success">
                          <h4>{{session("success")}}</h4>                          
                        </blockquote>
                      </div>
                    </div>                      
                    
            @endif
             @if($errors->any())
                      <div class="card border-danger mx-auto mb-3 ">
                        <div class="card-header">Error</div>      
                      <div class="card-block">
                        <blockquote class="card-blockquote m-3 text-error">
                          @foreach($errors->all() as $error)
                          <p class="text-danger">{{$error}}</p>   
                          @endforeach                       
                        </blockquote>
                      </div>
                    </div>                      
                    
            @endif
          @yield('content')
    	  </div>

        <div class="col-lg-3">
          <h1 class="my-4">Menu</h1>
          <div class="list-group">
            <a href="/restaurants" class="list-group-item">Browse Restaurants</a>
            <a href="/restaurant/new" class="list-group-item">Add New Restaurant</a>
            <a href="/myrestaurants" class="list-group-item">My Restaurants</a>            
            <a href="/myprofile" class="list-group-item">My Profile</a>
            <a href="/logout" class="list-group-item">Logout</a>
          </div>
          <h1 class="my-4">Account Info</h1>
           <li class="list-group">
            <ul class="list-group-item">User: <span class="float-right">{{$user->name}}</span></ul>  
          </li>
        </div>
      </div>
    </main>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery.js" ></script>

    <script src="/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
