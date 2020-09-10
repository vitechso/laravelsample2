@include("layouts.header")
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="{{url('/')}}/assets/css/bootstrap-tagsinput.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/themes/github.css">
<link rel="stylesheet" href="{{url('/')}}/assets/css/app.css">
<script>
   (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
   (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
   m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
   })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
   
   ga('create', 'UA-42755476-1', 'bootstrap-tagsinput.github.io');
   ga('send', 'pageview');
</script>
<style type="text/css">
   .label-info {
   background-color: #5bc0de !important;
   }
</style>
<section class="bg-light">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8 col-md-8 col-12">
            <div class="branded-content">
               <h1 class="">Post a <span class="title-effect">Question</span></h1>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="pt-5 pb-5">
   <div class="container">
      <center>{!!session('flash_message')!!}</center>
      <div class="row">
         <div class="col-lg-12">
            <div class="form-post-block">
               <form method="post" enctype="multipart/form-data" id="form1" action="{{route('new_to_crypto')}}">
                  <input type="hidden" name="keyword_id" @if($keywords_id) value="{{$keywords_id->id}}" @endif>
                  @if(isset($_SERVER['HTTP_REFERER']))
                  <input type="hidden" name="returnurl" value="{{$_SERVER['HTTP_REFERER']}}">
                  @endif
                  <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <div class="row" style="display: none;">
                     <label class="radio-inline">
                     <input type="radio" name="user_id" value="{{Auth::user()->id}}" checked>Registered user
                     </label>
                     <label class="radio-inline">
                     <input type="radio" name="user_id" value="0">Anonymous user
                     </label>
                  </div>

                  <div class="row">
                     <div class="col-lg-12">
                        <div class="form-group post-input-block">
                           <input type="text" placeholder="Question (250 characters)" id="title1" name="title" class="form-control" required maxlength="250">
                        </div>
                        
                        <div class="form-group post-input-block">
                           <input type="text" placeholder="Tags" id="tags1" name="tags" class="form-control" value="{{$keywords_id->name}}" data-role="tagsinput"  />
                        </div>

                        <div class="post-btns">
                           <button type="submit" class="theme-btn">Cancel</button>
                           <button type="submit" class="theme-btn">Post</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div> 
         </div>
      </div>
   </div>
</section>
@include("layouts.footer");
<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.2.20/angular.min.js"></script>
<script src="{{url('/')}}/assets/js/bootstrap-tagsinput.min.js"></script>
<script src="{{url('/')}}/assets/js/bootstrap-tagsinput-angular.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/rainbow.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/generic.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/html.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/rainbow/1.2.0/js/language/javascript.js"></script>
<script src="{{url('/')}}/assets/js/app.js"></script>
<script src="{{url('/')}}/assets/js/app_bs3.js"></script>
<script type="text/javascript">
   $(function() {
   $(".bootstrap-tagsinput input").keypress(function(event) {
   //alert(event.keyCode);
     if (event.keyCode == 13 ||e.which==13) {
         event.preventDefault();
     }
   });
   });
</script>