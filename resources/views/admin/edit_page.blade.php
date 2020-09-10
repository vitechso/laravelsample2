@extends('admin.layouts.admin')

@section('content')
    <!-- page content -->
    <!-- top tiles -->
  <?php //echo "<pre>"; print_r($keyword);die; ?>
    <div class="main-content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="page-heading">
            <h2><?php echo (isset($page_detail))?"Edit":"Add" ?> Page</h2>
          </div>
        </div>
      
        <!-- category form section -->
        <div class="col-lg-12 col-md-12 col-12 mt-3">
          <div class="category-form-block">
            {{ Form::open(['route'=>['admin.page-update'],'method' => 'post','class'=>'form-horizontal form-label-left','files'=>true]) }}
              <input type="hidden" class="form-control" name="id" placeholder="" id="id" value="{{$page_detail['id']}}" required>
              <div class="form-group">
                <label for="usr">Title</label>
                <input type="text" class="form-control" name="title" placeholder="" id="title" value="{{$page_detail['title']}}" required>
                @if($errors->has('title'))

                <ul class="parsley-errors-list filled">

                  @foreach($errors->get('title') as $error)

                  <li class="parsley-required">{{ $error }}</li>

                  @endforeach

                </ul>

                @endif
              </div>

              <div class="form-group">
                <label for="usr">Description</label>
                <textarea class="form-control description" name="description" placeholder="" id="description"required rows="10">{{$page_detail['description']}}</textarea>
                @if($errors->has('description'))

                <ul class="parsley-errors-list filled">

                  @foreach($errors->get('description') as $error)

                  <li class="parsley-required">{{ $error }}</li>

                  @endforeach

                </ul>

                @endif
                <script type="text/javascript">
                  CKEDITOR.replace( 'description' );
                  CKEDITOR.add            
                </script>
              </div>

            <div class="form-group mt-2">
              <button type="submit" class="btn custom-btn"><?php echo (isset($page_detail))?"Update":"Submit" ?></button>
            </div>
            {{ Form::close() }}
          </div>
        </div>
      </div>
    </div>
    <!-- /top tiles -->

<script type="text/javascript">
 




  <?php
  if(isset($keyword_detail) && !empty($keyword_detail))
  {

     foreach ($keyword_detail as $key => $value) {
         ?>
         $("#<?php echo $key; ?>").val('<?php echo $value ?>');
         <?php
     } 
       

   }

  ?>
</script>

<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

    

@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/dashboard.js')) }}
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/dashboard.css')) }}
@endsection