@extends('admin.layouts.admin')

@section('content')
    <!-- page content -->
    <!-- top tiles -->
  <?php //echo "<pre>"; print_r($keyword);die; ?>
    <div class="main-content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="page-heading">
            <h2><?php echo (isset($keyword_detail))?"Edit":"Add" ?> Keyword</h2>
          </div>
        </div>
      
        <!-- category form section -->
        <div class="col-lg-8 col-md-8 col-12 mt-3">
          <div class="category-form-block">
           
          

          @if(isset($keyword_detail) && !empty($keyword_detail))                
                 {{ Form::open(['route'=>['admin.keywords'],'method' => 'post','class'=>'form-horizontal form-label-left','files'=>true]) }}
              <input type="hidden" class="form-control" name="id" placeholder="" id="id" value="{{$keyword_detail['id']}}" required>
        @else
        {{ Form::open(['route'=>['admin.keywords'],'method' => 'post','class'=>'form-horizontal form-label-left','files'=>'true']) }}
          @endif




            <div class="form-group">
              <label for="usr">Name</label>
              <input type="text" class="form-control" name="name" placeholder="" id="name" value="{{$keyword_detail['name']}}" required>
              @if($errors->has('name'))

              <ul class="parsley-errors-list filled">

                @foreach($errors->get('name') as $error)

                <li class="parsley-required">{{ $error }}</li>

                @endforeach

              </ul>

              @endif
            </div>

          

              

            <div class="form-group mt-2">
              <button type="submit" class="btn custom-btn"><?php echo (isset($keyword_detail))?"Update":"Submit" ?></button>
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

