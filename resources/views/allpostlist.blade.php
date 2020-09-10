@include("layouts.header")
<style type="text/css">
   .active svg {
   fill: #f30000;
   }
</style>

<section class="bg-light result-bg">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8 col-md-8 col-12">
            <div class="branded-content">
               <!-- <h1 class="">Your Branded Content <span class="title-effect">Here</span></h1> -->
               @if($searchkeyword!='')
               <h1 class="">{{$searchkeyword}}</span></h1>
               @endif
            </div>
         </div>
      </div>
   </div>
</section>

<section class="pt-5 pb-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="Posts">
               <div class="new-keyword mb-4 d-flex justify-content-end">
                  @if($searchkeyword!='')
                  <a href="{{url('new_to_crypto/'.$searchkeyword)}}" class="theme-btn">
                  @else
                  <a href="{{route('new_to_crypto')}}" class="theme-btn new-key-btn-asd">
                  @endif
                  Ask a Question</a>
               </div>

               @if(isset($postdata_result) && !empty($postdata_result) && $totalrecord>0)
               @foreach($postdata_result as $key => $val)

               <div class="card">
                  <div class="card-header">
                     <div class="card-headings">
                        <button class="btn">{{$val->title}}</button>

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
                  </div>

                  <div class="social-propery">
                     <ul>
                        <li>
                           <a href="javascript:void(0);">
                              <i class="fa fa-comment" aria-hidden="true"></i>
                              <span>@if(isset($val->comment_data) && !empty($val->comment_data))
                                    {{count($val->comment_data)}}
                                    @else
                                 0
                                 @endif</span>
                              <p>Comments</p>
                           </a>
                        </li>

                        <li class="dropdown">
                           <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-share" aria-hidden="true"></i>
                              <p>Share</p>
                           </a>

                           <div class="share-inner-block dropdown-menu">
                              <a class="twitter-share-button dropdown-item" href="javascript:void(0);" onclick="copyLinkWhatsup('https://twitter.com/intent/tweet?text={{Request::fullUrl()}}')">Copy Url</a>

                              <a class="twitter-share-button dropdown-item" href="https://twitter.com/intent/tweet?text={{Request::fullUrl()}}" target="_blank">Share on twitter</a>
                           </div>
                        </li>
                     </ul>
                  </div>
               

                  <div id="" class="">
                     <div class="card-body">
                        <div class="row">
                           <div class="col-lg-12">
                              <div class="comment-description-block">

                                 <div class="create-comment">
                                    
                                    @if(!auth()->check())
                                    <a href="{{route('login')}}">Please login for Write a comment.</a>
                                    @else
                                    <form action="{{route('post-comment')}}" method="post">
                                       {{ csrf_field() }}
                                       @if(isset($searchkeyword) && $searchkeyword!='')
                                       <input type="hidden" name="searchkeyword" value="{{$searchkeyword}}">
                                       @endif
                                       <input type="hidden" name="post_id" value="{{$val->id}}">
                                       <!-- <textarea  class="descriptioncomment" name="descriptioncomment" cols="30" rows="5"></textarea> -->
                                       <textarea name="comment" class="ckeditor form-control" maxlength="500" required placeholder="Answer (500 characters)"></textarea>
                                       <div class="create-comment-submit-btn">
                                          <input type="submit" name="submit" value="submit" class="theme-btn">
                                       </div>
                                    </form>
                                    @endif
                                 </div>
                                    
                              
                                 @if(isset($val->comment_data) && !empty($val->comment_data))
                                    @foreach($val->comment_data as $cval)
                                    <div class="comment-block">
                                       

                                       <div class="comment-block-header">
                                          <h5 class="comment-title">{{$cval->name}}</h5>
                                          <!-- <p class="vote-countcomment comments-points">{{$cval->vote}} Points</p>&nbsp; - &nbsp; -->
                                          <h6 class="comment-timing">
                                             @php
                                             $bday = new DateTime($cval->created_at);
                                             $today = new Datetime(date('Y-m-d'));
                                             $diff = $today->diff($bday); 
                                             if($diff->d==0){
                                             echo 'today';
                                             }else{
                                             echo $diff->d.' day ago';
                                             }
                                             @endphp
                                          </h6>

                                          <div class="vote-updatecomment inner-vote-update ">
                                             @if(!auth()->check())
                                             <button onclick="window.location.href = '{{route("login")}}'">
                                             @else
                                             <button onclick="voting_comment(this,1,{{$val->id}},{{$cval->comment_id}})" class="active">
                                             @endif
                                             <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" viewBox="0 0 612 792" enable-background="new 0 0 612 792" xml:space="preserve" class="up-vote">
                                                <g>
                                                   <g>
                                                      <path fill="#888888" d="M569.643,348.866L314.627,93.722c-2.397-2.397-5.635-3.722-9.024-3.722s-6.628,1.352-9.024,3.747
                                                         L42.326,348.866c-3.646,3.646-4.716,9.125-2.753,13.893c1.988,4.767,6.628,7.852,11.777,7.852h140.203v318.644
                                                         c0,7.036,5.71,12.746,12.746,12.746h203.932c7.035,0,12.746-5.71,12.746-12.746V370.61h139.667c5.149,0,9.789-3.11,11.777-7.877
                                                         S573.288,352.512,569.643,348.866z"></path>
                                                   </g>
                                                </g>
                                             </svg>
                                          </button>
                                          <!-- <p class="vote-count">{{$val->vote}}</p> -->
                                          <p class="vote-countcomment comments-points">{{$cval->vote}}</p>
                                          @if(!auth()->check())
                                          <button onclick="window.location.href = '{{route("login")}}'">
                                          @else
                                          <button onclick="voting_comment(this,2,{{$val->id}},{{$cval->comment_id}})">
                                          @endif
                                          <!-- <button onclick="voting(this,2,16)" class=""> -->
                                                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="16px" viewBox="0 0 612 792" enable-background="new 0 0 612 792" xml:space="preserve" class="down-vote">
                                                <g>
                                                   <g>
                                                      <path fill="#888888" d="M572.418,429.266c-1.988-4.767-6.628-7.877-11.776-7.877H420.974V102.746
                                                         c0-7.036-5.71-12.746-12.746-12.746H204.295c-7.036,0-12.746,5.71-12.746,12.746V421.39H51.347c-5.149,0-9.789,3.11-11.777,7.853
                                                         c-1.963,4.767-0.893,10.247,2.753,13.893L296.6,698.254c2.396,2.396,5.634,3.747,9.024,3.747c3.391,0,6.628-1.352,9.024-3.722
                                                         L569.665,443.16C573.312,439.514,574.407,434.033,572.418,429.266z"></path>
                                                   </g>
                                                </g>
                                             </svg>
                                          </button>
                                       </div>
                                       </div>
                                       {!! $cval->comment !!}
                                    </div>

                                    
                                    <div class="social-propery">
                                       <ul>
                                          <li>
                                             <a href="javascript:void(0);">
                                                <i class="fa fa-comment" aria-hidden="true"></i>
                                                <span>@if(isset($val->comment_data) && !empty($val->comment_data))
                                                   {{count($val->comment_data)}}
                                                   @else
                                                0
                                                @endif</span>
                                                <p>Comments</p>
                                             </a>
                                          </li>

                                          <li class="dropdown">
                                             <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-share" aria-hidden="true"></i>
                                                <p>Share</p>
                                             </a>

                                             <div class="share-inner-block dropdown-menu">
                                                <a class="twitter-share-button dropdown-item" href="javascript:void(0);" onclick="copyLinkWhatsup('https://twitter.com/intent/tweet?text={{Request::fullUrl()}}')">Copy Url</a>

                                                <a class="twitter-share-button dropdown-item" href="https://twitter.com/intent/tweet?text={{Request::fullUrl()}}" target="_blank">Share on twitter</a>
                                             </div>
                                          </li>
                                       </ul>
                                    </div>
                                 @endforeach
                                 @endif
                              </div>
                              
                              <div class="social-propery" style="display: none;">
                                 <ul>
                                    <li>
                                       <a href="javascript:void(0);" data-toggle="collapse" data-target="#demo{{$val->id}}">
                                          <i class="fa fa-comment" aria-hidden="true"></i>
                                          <span>@if(isset($val->comment_data) && !empty($val->comment_data))
                                             {{count($val->comment_data)}}
                                             @else
                                          0
                                          @endif</span>
                                          <p>Comments</p>
                                       </a>
                                    </li>
                                    
                                    <li class="dropdown">
                                       <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
                                          <i class="fa fa-share" aria-hidden="true"></i>
                                          <p>Share</p>
                                       </a>

                                       <div class="share-inner-block dropdown-menu">
                                          <a class="twitter-share-button dropdown-item" href="javascript:void(0);" onclick="copyLinkWhatsup('https://twitter.com/intent/tweet?text={{Request::fullUrl()}}')">Copy Url</a>

                                          <a class="twitter-share-button dropdown-item" href="https://twitter.com/intent/tweet?text={{Request::fullUrl()}}" target="_blank">Share on twitter</a>
                                       </div>
                                    </li>
                                 </ul>
                              </div>
                                 
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               @endforeach
               
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
   function copyLinkWhatsup(url)
    {

        var dummy = document.createElement('input'),
          text = url;//window.location.href;
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
        
    }

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
         }
      })
   }

   function voting_comment(element,votingtype,postid,commentid){
      $('.vote-updatecomment button').removeAttr('disabled').removeClass('active');
      console.log(votingtype+','+postid);
      $(element).attr('disabled','disabled');
      $(element).addClass('active');
      // uservoting_onpost
      $.ajax({
         type: "POST",
         url: "{{route('uservoting-oncomment')}}",
         data: {'postid': postid, '_token': "{{csrf_token()}}","votingtype":votingtype,"commentid":commentid},
         success: function (res) {
           console.log(res);
           $(element).parent().find('p.vote-countcomment').text(res.resp);
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