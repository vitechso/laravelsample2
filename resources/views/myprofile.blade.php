@include("layouts.header")

<section class="bg-light">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8 col-md-8 col-12">
            <div class="branded-content">
               <h1>Hello {{ucwords(\Auth::user()->name)}}</h1>
            </div>
         </div>
      </div>
   </div>
</section>


<section class="pt-5 pb-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">

            <div class="create-post-block my-profile-block">

               <!-- Nav tabs -->

               <ul class="nav nav-tabs">
                  <li class="nav-item">
                     <a class="nav-link corner-radius active" data-toggle="tab" href="#Keywords">Keywords</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#Questions">Questions</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#Answers">Answers</a>
                  </li>
               </ul>

               <!-- Tab panes -->

               <div class="tab-content">
                  <div id="Keywords" class="tab-pane active">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="myprofile-list table-responsive">
                              <table class="table keywords-tbl table-bordered">
                                 <thead>
                                    <tr>
                                       <!-- <th>S.No</th> -->
                                       <th>Keyword</th>
                                    </tr>
                                 </thead>

                                 <tbody>
                                    @foreach($keywords as $key=> $keyword)
                                    <tr>
                                       <!-- <td>{{$key+1}}</td> -->
                                       <td>{{$keyword->name}}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div id="Questions" class="tab-pane fade">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="myprofile-list table-responsive">
                              <table class="table questions-tbl table-bordered">
                                 <thead>
                                    <tr>
                                       <!-- <th>S.No</th> -->
                                       <th>Title</th>
                                       <th>Keyword</th>
                                       <th>Tags</th>
                                    </tr>
                                 </thead>

                                 <tbody>
                                    @foreach($posts as $key=> $post)
                                    <tr>
                                       <!-- <td>{{$key+1}}</td> -->
                                       <td>{{$post->title}}</td>
                                       <td>{{$post->name}}</td>
                                       <td>{{$post->tags}}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div id="Answers" class="tab-pane fade">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="myprofile-list table-responsive">
                              <table class="table answers-tbl table-bordered">
                                 <thead>
                                    <tr>
                                       <!-- <th>S.No</th> -->
                                       <th>Post Title</th>
                                       <th>Comment</th>
                                    </tr>
                                 </thead>

                                 <tbody>
                                    @foreach($comments as $key=> $comment)
                                    <tr>
                                       <!-- <td>{{$key+1}}</td> -->
                                       <td>{{$comment->post_title}}</td>
                                       <td>{{$comment->comment}}</td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
   </div>
</section>

@include("layouts.footer")