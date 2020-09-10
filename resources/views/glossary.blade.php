@include("layouts.header")
<style type="text/css">
   .active svg {
   fill: #f30000;
   }
</style>

<section class="bg-light">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8 col-md-8 col-12">
            <div class="branded-content">
               <h1 class="">Keywords</h1>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="pt-5 pb-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="keywords-alphabets-header">
               <ul class="a2z-block">
                @php
                $alpha = array('A','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z');
                @endphp
                @for($i=0;$i<count($alpha); $i++)
                  <li><a href="#{{$alpha[$i]}}ecy">{{$alpha[$i]}}</a></li>
                @endfor
               </ul>
               @if (!Auth::check())
               <a href="{{route('login')}}" class="theme-btn">Add to Glossary</a>
               @else
               <div class="new-keyword">
                  <a href="#newKeyword" class="theme-btn" data-toggle="modal" data-target="#newKeyword">Add to Glossary</a>
               </div>

               <!-- The Modal -->
               <div class="modal fade" id="newKeyword">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header keywords-header">
                           <h4 class="modal-title">Add New Keywords</h4>
                           <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                           <form action="{{route('add-keywords')}}" method="post">
                              <div class="keyword-input">
                                 <input type="hidden" class="form-control" name="_token" value="{{csrf_token()}}">
                                 <input type="text" class="form-control" name="keywords" placeholder="Add New Keywords" id="keywords">
                                 <input type="submit" name="submit" value="save" class="keywords-btn">
                              </div>
                              <div class="animate-checkbox">
                                 <input type="checkbox" value="1" name="is_crypto" id="checkbox_1" class="_checkbox">
                                 <label for="checkbox_1" class="creative-chech-label">
                                    <div class="check"></div>
                                    <div id="tick_mark"></div>
                                    <div class="check-details">
                                       <p>Check if it's a crypto currency</p>
                                    </div>
                                 </label>
                              </div>
                              <div class="ticker-input">
                                 <input type="text" name="ticker" class="form-control" placeholder="ticker" style="text-transform: uppercase;">
                              </div>
                           </form>
                        </div>
                     </div>
                  </div>
               </div><!-- The Modal -->
               @endif
            </div>
         </div>
      
         <div class="col-lg-12 mt-4">
            <div class="keyword-block">
               @if(isset($keyworddata_result) && !empty($keyworddata_result) && $totalrecord>0)
               <ul>
                  @php
                  $letter = '';
                  @endphp
                  @foreach($keyworddata_result as $key => $val)
                  @php
                  $nk = strtolower($val->name);
                  @endphp
                  @if($letter != substr($nk,0,1))
                  @php
                  $letter = substr($nk,0,1);
                  @endphp
                  <h5 style="margin-top: 20px; ">
                     <a href="{{route('glossary-search',[$letter])}}" class="alphabet" id="{{$letter}}ecy">{{ucfirst($letter)}}</a>
                  </h5>
                  @endif
                  <li class="inlinedisplay">
                     <a href="{{route('glossary',[str_replace(' ','_',$val->name)])}}">{{ucfirst($val->name)}}</a>
                  </li>
                  @endforeach
               </ul>
               @else
               <div class="card">
                  <h3>That word isn't in our glossary yet. Would you like to add it?</h3>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>
   <!--   <form action="uservoting-onpost" method="post">
      <input type="text" name="_token" value="{{csrf_token()}}">
      <input type="submit" name="submit" value="sen">
      
      </form> -->
</section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
    $('.ticker-input').hide();
    $('#checkbox_1').on('click',function(){
      if($(this).is(":checked")==true){
        $('.ticker-input').show();
        // console.log($('.ticker-input input').val());
      }else{
        $('.ticker-input').hide();
        $('.ticker-input input').val('');
      }
    });


     $('#checkbox_2').on('click',function(){
       var keywords = $('#keywords').val();
       console.log($(this).is(":checked"));
       if($(this).is(":checked")==true){
         $('#keywords').val(keywords.toUpperCase());
       }else{
         $('#keywords').val(keywords.toLowerCase());
       }
     });
   });
    function voting(element,votingtype,postid){
       $('.vote-update button').removeAttr('disabled').removeClass('active');
       console.log(votingtype+','+postid);
       $(element).attr('disabled','disabled');
       $(element).addClass('active');
       // uservoting_onpost
       $.ajax({
          type: "POST",
          url: "{{route('uservoting-onpost')}}",
          data: {'postid': postid, '_token': "{{csrf_token()}}","votingtype":votingtype},
          success: function (res) {
            console.log(res);
            $(element).parent().find('p.vote-count').text(res.resp);
            // $("#gallery-record").html(res.html);
            // $("#galleryModal").modal('show');
            // setTimeout(function () {
            //     bxslider.bxSlider({
            //         video: true,
            //         selector: true,
            //     });
            // }, 200)
          }
       })
    }
</script>
@include("layouts.footer")