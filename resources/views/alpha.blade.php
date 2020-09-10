@include("layouts.header")

<style type="text/css">
   
   .active svg {
    fill: #f30000;
   }
</style>

<section class="bnner-bg">

   <div class="container">

      <div class="row justify-content-center">

         <div class="col-lg-8 col-md-8 col-12">

            <div class="branded-content">

               <h1 class="">Your Branded Content <span class="title-effect">Here</span></h1>

            </div>

         </div>

      </div>

   </div>

</section>



<section class="pt-5 pb-5">

   <div class="container">

      <div class="row">

         <div class="col-lg-12">

            <div id="accordion">
               @if(isset($postdata_result) && !empty($postdata_result) && $totalrecord>0)
               
               @foreach($postdata_result as $key => $val)
               <div class="card">

                  <div class="card-header" id="headingOne{{$key}}">

                     <h5 class="mb-0">

                     <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne{{$key}}" aria-expanded="false" aria-controls="collapseOne{{$key}}">{{$val->title}}</button>

                  </div>



                  <div id="collapseOne{{$key}}" class="collapse" aria-labelledby="headingOne{{$key}}" data-parent="#accordion">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="description-block">
                                 @php
                                   $mediapath=url("/")."/assets/posts/".$val->media_file;
                                 @endphp
                                 @if(!empty($val->description))
                                 {!! $val->description !!}
                                 @elseif(@is_array(getimagesize($mediapath)))
                                   <img src="{{$mediapath}}">
                                 @else
                                    <video width="100%" height="400" controls>
                                       <source src="{{$mediapath}}" type="video/mp4">
                                    </video>
                                 @endif
                              </div>

                              <div class="row">
                                 <div class="col-lg-4 col-md-4 col-12">
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
                                 </div>
                                 <div class="col-lg-8 col-md-8 col-12 social-propery">
                                    <ul>
                                       <li>

                                          <a href="#">

                                             <i class="fa fa-comment" aria-hidden="true"></i>

                                             <span>2.6k</span>

                                             <p>Comments</p>

                                          </a>

                                       </li>



                                       <li>

                                          <a href="#">

                                             <i class="fa fa-share" aria-hidden="true"></i>

                                             <p>Share</p>

                                          </a>

                                       </li>



                                       <li>

                                          <a href="#">

                                             <i class="fa fa-flag" aria-hidden="true"></i>

                                             <p>Report</p>

                                          </a>

                                       </li>

                                    </ul>

                                 </div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>

               </div>
               @endforeach
               @else
                  <div class="card">
                     <h3>No result found.</h3>
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


<script type="text/javascript">
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

