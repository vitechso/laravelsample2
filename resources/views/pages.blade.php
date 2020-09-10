@include("layouts.header")
<style type="text/css">
   .active svg {
   fill: #f30000;
   }
</style>

@if(isset($page) && !empty($page))
<section class="bg-light">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8 col-md-8 col-12">
            <div class="branded-content">
               <h1 class="">{{$page->title}}</span></h1>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="pt-5 pb-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="about-description">
               <p>{!! $page->description !!}</p>
            </div>
         </div>
      </div>
   </div>
   <!--   <form action="uservoting-onpost" method="post">
      <input type="text" name="_token" value="{{csrf_token()}}">
      <input type="submit" name="submit" value="sen">
      
      </form> -->
</section>
@endif

@include("layouts.footer")