@include("layouts.header")



<section>

   <div class="container">

      <div class="row justify-content-center vertical-middle">

         <div class="col-lg-8 col-md-8 col-12">

            <div class="get-search">

               <form method="post" action="searchkeyword" id="searchkeywordform">

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

               <div class="logo">

                  <h1 class="title">Edit <span class="title-effect">Crypto</span></h1>
                  <p>"I don't understand Bitcoin. Please explain it to me." -- JK Rowling</p>

               </div>



               <div class="bar">

                  <input class="searchbar" id="searchbar" name="searchword" type="text" title="Search" placeholder="Search Crypto ex, What is Bitcoin?" required>
                  <input type="hidden" class="employeeid" readonly name="selected_result_id">

                  <i class="fa fa-search search-icon" aria-hidden="true"></i>

               </div>



               <div class="buttons">

                  <!-- <button class="button" name="searchbtn" type="submit">Alpha</button> -->
                  <a href="{{route('glossary')}}" class="theme-btn">Glossary</a>

                  <!-- <button class="button" type="button">Most Active Topic</button> -->

               </div>

               </form>



               

            </div>

         </div>

      </div>

   </div>
<!--    <form action="{{route('searchautocomplete')}}" method="post">
      <input type="text" name="_token" value="{{csrf_token()}}">
      <input type="text" name="search" value="what">
      <input type="submit" name="val" value="send">
   </form> -->
</section>

@include("layouts.footer")

