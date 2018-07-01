
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/favicon.ico">

    <title>Katasi</title>
    
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/landing.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/all.css" rel="stylesheet">

  </head>

  <body>
    <div id="overlay">
        <div id="preloader"></div>
      </div>
    
    <div class="site-wrapper">
      
      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <img class="masthead-brand" src="/katasi.png" alt="{{ config('app.name') }}">
              <nav class="nav nav-masthead">
                <a class="nav-link active" href="#">Home</a>                
                <a class="nav-link" href="/login">Login</a>
                <a class="nav-link" href="/signup">Sign Up</a>

              </nav>
            </div>
          </div>

          <div class="inner cover">
            <h1 class="cover-heading">Welcome to {{ config('app.name') }}</h1>
            <p class="lead landing-message">{{ config('app.name') }} is a service that helps you rate restaurants.<br>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
              <span class="fa fa-star checked"></span>
            </p>
            <p class="lead">
              <a href="/signup" class="btn btn-lg btn-primary">Sign Up</a>
              <a href="/login" class="btn btn-lg btn-secondary">Login</a>
            </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p></p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="/js/landing.js"></script> 
    <script src="/js/jquery.js" crossorigin="anonymous"></script> 
    
    <script src="/js/bootstrap.bundle.min.js"></script>
   
  </body>
</html>
