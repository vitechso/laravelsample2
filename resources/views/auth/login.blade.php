<!-- <!DOCTYPE html>
<html lang="en">
<head>
   <title>Reddit | Edit Crypto</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/style.css">
   <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/responsive.css">

</head>

<body>

<header>
   <nav class="navbar nav-bar navbar-expand-md">
      <a class="navbar-brand Brand-logo" href="{{url('/')}}">
         <h1 class="title-logo">Edit <span class="title-effect">Crypto</span></h1>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
         <span class="navbar-toggler-icon">
            <i class="fa fa-bars" aria-hidden="true"></i>
         </span>
      </button>

      <div class="collapse navbar-collapse" id="collapsibleNavbar">
         <ul class="navbar-nav top-nav ml-auto">

            <li class="nav-item d-none d-md-block">
               <div class="search-block">
                  <input class="form-control" type="text" title="Search" placeholder="Search Crypto ex, What is Bitcoin?">
                  <i class="fa fa-search" aria-hidden="true"></i>
               </div>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="{{url('/new_to_crypto')}}">New to Crypto?</a>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="{{url('/login')}}">Sign In/Create Account</a>
            </li>   
         </ul>
      </div>  
   </nav>

  
   <div class="search-block d-md-none">
      <input class="form-control" type="text" title="Search" placeholder="Search Crypto ex, What is Bitcoin?">
      <i class="fa fa-search" aria-hidden="true"></i>
   </div>
  
      
</header> -->
@include("layouts.header")

<section class="bg-light">
   <div class="container">
      <div class="row justify-content-center vertical-middle">
         <div class="col-lg-5 col-md-10 col-12">
            <div class="login-block">
               <div class="inner-login-block">
                  <div class="form-title">
                     <h2>Login</h2>
                     <p>Lorem Ipsum is simply dummy text</p>
                  </div>
                  
                  {{ Form::open(['route' => 'login']) }}
                  
                    @if(isset($_SERVER['HTTP_REFERER']))
                        
                    <input type="hidden" name="returnurl" value="{{$_SERVER['HTTP_REFERER']}}">
                     
                     @endif
                     <div class="form-group">
                        <!-- <input type="email" class="form-control" placeholder="Enter email" id="email" required=""> -->
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   placeholder="{{ __('views.auth.login.input_0') }}" required autofocus>
                     </div>

                     <div class="form-group">
                       <!--  <input type="password" class="form-control" placeholder="Enter password" id="pwd" required=""> -->
                       <input id="password" type="password" class="form-control" name="password"
                                   placeholder="{{ __('views.auth.login.input_1') }}" required>
                     </div>


                      @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (!$errors->isEmpty())
                            <div class="alert alert-danger" role="alert">
                                {!! $errors->first() !!}
                            </div>
                        @endif


                     <div class="custom-control custom-checkbox mb-3">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                        <label class="custom-control-label" for="customCheck">
                           <span>Remember me</span>
                        </label>
                     </div>

                     <div class="btn-block">
                         <button class="theme-btn" type="submit">{{ __('views.auth.login.action_0') }}</button>
                     </div>
                  {{ Form::close() }}
               </div>

               <div class="forgot-block">
                  <a href="{{url('/')}}/register">New here? <span class="forgot-effect">Sign Up</span></a>
                  <a href="forgot.html">Forgot Password?</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@include("layouts.footer")
<!-- </body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html> -->
