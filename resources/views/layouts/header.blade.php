<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Reddit | Edit Crypto</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/style.css">
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/responsive.css">
      <style type="text/css">
         .error{
         color: red;
         }
      </style>
      <!-- jQuery UI CSS -->
      <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   </head>
   <body>
      <header>
         <nav class="navbar nav-bar navbar-expand-md">
            <div class="navigation">
               <a class="navbar-brand Brand-logo" href="{{url('/')}}">
                  <h1 class="title-logo">Edit <span class="title-effect">Crypto</span></h1>
               </a>

               <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                  <span class="navbar-toggler-icon">
                     <i class="fa fa-bars" aria-hidden="true"></i>
                  </span>
               </button>
            </div>

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
               <ul class="navbar-nav top-nav ml-auto">
                  <li class="nav-item d-none d-md-block">
                     @if(request()->segment(1) == 'beginner')
                     <div class="search-block">
                        <form method="post" action="{{route('beginner')}}">
                           <input type="hidden" name="_token" value="{{csrf_token()}}">
                           <input class="form-control searchbar" type="text" title="Search" name="searchword" placeholder="Search Crypto ex, What is Bitcoin?" @if(isset($searchkeyword) && $searchkeyword!='') value="{{$searchkeyword}}" @endif >
                           <input type="hidden" class='employeeid' readonly name="selected_result_id">
                        </form>
                        <i class="fa fa-search" aria-hidden="true"></i>
                     </div>
                     @endif
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{route('glossary')}}">Glossary</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{route('forums')}}">Forums</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{route('page',['about-us'])}}">About Us</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{route('page',['donate'])}}">Donate</a>
                  </li>
                  @if(Auth::user()!=null)
                  @if(isset(Auth::user()->id))
                  <li class="nav-item">
                     <a class="nav-link" href="{{route('myprofile')}}">My Profile</a>
                  </li>
                  @endif
                  @endif
                  <!--<li class="nav-item">
                     <a class="nav-link" href="#">New to Crypto?</a>
                     
                     </li>
                     
                     
                     
                     <li class="nav-item">
                     
                     <a class="nav-link" href="login.html">Sign In/Create Account</a>
                     
                     </li> -->  
                  <!-- <li class="nav-item"><a href="{{url('/new_to_crypto')}}">Add Post</a></li> -->
                  @if (Route::has('login'))
                  @if (!Auth::check())
                  <li class="nav-item">
                     <a href="{{url('/login')}}">Sign In/Create Account</a>
                  </li>
                  @else
                  <li class="nav-item">
                     <a href="{{ url('/logout') }}">{{ __('views.welcome.logout') }}</a>
                  </li>
                  @endif
                  @endif
               </ul>
            </div>
         </nav>
         <!-- for mobile -->
         <div class="search-block d-md-none">
            <input class="form-control" type="text" title="Search" placeholder="Search Crypto ex, What is Bitcoin?">
            <i class="fa fa-search" aria-hidden="true"></i>
         </div>
         <!-- for mobile -->
      </header>
      @include('partials.alert')