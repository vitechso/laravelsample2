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
               <h1 class="">Forums<span class="title-effect"></span></h1>
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
               <form method="post" enctype="multipart/form-data" id="form1" action="{{route('forums')}}">
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
                           <input type="text" placeholder="Question (250 characters)" id="title1" name="question" class="form-control" required maxlength="250">
                        </div>
                        <div class="form-group post-input-block">
                           <textarea name="answer" class="form-control" placeholder="Answer"></textarea>
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

      <div class="row mt-4">
         <div class="col-lg-12">
         @foreach($forumsdata as $val)
            <div class="forum-QA-block">
               <div class="vote-update">
                  @if(!auth()->check())
                  <button onclick="window.location.href = '{{route("login")}}'">
                  @else
                  <button onclick="voting(this,1,{{$val->id}})">
                     @endif
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="16px" viewBox="0 0 612 792" enable-background="new 0 0 612 792" xml:space="preserve" class="up-vote">
                        <g>
                           <g>
                              <path fill="#888888" d="M569.643,348.866L314.627,93.722c-2.397-2.397-5.635-3.722-9.024-3.722s-6.628,1.352-9.024,3.747
                                 L42.326,348.866c-3.646,3.646-4.716,9.125-2.753,13.893c1.988,4.767,6.628,7.852,11.777,7.852h140.203v318.644
                                 c0,7.036,5.71,12.746,12.746,12.746h203.932c7.035,0,12.746-5.71,12.746-12.746V370.61h139.667c5.149,0,9.789-3.11,11.777-7.877
                                 S573.288,352.512,569.643,348.866z"/>
                           </g>
                        </g>
                     </svg>
                  </button>

                  <p class="vote-count">{{$val->vote}}</p>
                  @if(!auth()->check())
                  <button onclick="window.location.href = '{{route("login")}}'">
                  @else
                  <button onclick="voting(this,2,{{$val->id}})">
                     @endif
                     <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                        width="16px" viewBox="0 0 612 792" enable-background="new 0 0 612 792" xml:space="preserve" class="down-vote">
                        <g>
                           <g>
                              <path fill="#888888" d="M572.418,429.266c-1.988-4.767-6.628-7.877-11.776-7.877H420.974V102.746
                                 c0-7.036-5.71-12.746-12.746-12.746H204.295c-7.036,0-12.746,5.71-12.746,12.746V421.39H51.347c-5.149,0-9.789,3.11-11.777,7.853
                                 c-1.963,4.767-0.893,10.247,2.753,13.893L296.6,698.254c2.396,2.396,5.634,3.747,9.024,3.747c3.391,0,6.628-1.352,9.024-3.722
                                 L569.665,443.16C573.312,439.514,574.407,434.033,572.418,429.266z"/>
                           </g>
                        </g>
                     </svg>
                  </button>
               </div>
               <h5>{{$val->question}}</h5>
               <p>{{$val->answer}}</p>
            </div>
            @endforeach
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
   function voting(element,votingtype,forum_id){
      $('.vote-update button').removeAttr('disabled').removeClass('active');
      console.log(votingtype+','+forum_id);
      $(element).attr('disabled','disabled');
      $(element).addClass('active');
      // uservoting_onpost
      $.ajax({
         type: "POST",
         url: "{{route('user-vote-onforums')}}",
         data: {'forum_id': forum_id, '_token': "{{csrf_token()}}","votingtype":votingtype},
         success: function (res) {
           console.log(res);
           $(element).parent().find('p.vote-count').text(res.resp);
         }
      })
   }
</script>