@extends('admin.layouts.admin')

@section('content')
    <!-- page content -->
    <!-- top tiles -->
  <?php //echo "<pre>"; print_r($posts) ?>
    <div class="main-content">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-12">
          <div class="page-heading">
            <h2>All Pages</h2>
          </div>
        </div>

        <div class="col-lg-12 col-md-12 col-12 mt-3">
          <div class="category-list-block">
            <table id="example" class="table table-striped table-bordered category-tbl">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Title</th>
                  <th>Slug</th>
                  <th>Description</th>
                 
                  <th>Action</th>
                </tr>
              </thead>

              <tbody>
                @foreach($pagelist as $key=>$value)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $value->title }}</td>
                  <td>{{ $value->slug }}</td>
                  <td>{!! $value->description !!}</td>
               
                  <td>

                    
                    <a href="{{ route('admin.page-edit',[$value->id]) }}" class='action-btn'><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
              @endforeach
              
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /top tiles -->



    


@endsection

@section('scripts')
    @parent
    {{ Html::script(mix('assets/admin/js/dashboard.js')) }}
@endsection

@section('styles')
    @parent
    {{ Html::style(mix('assets/admin/css/dashboard.css')) }}
@endsection

<script type="text/javascript">
      
      function add_pakage_type(id)
      {
         //alert(id);
         $("#id").val(id);

      }
    </script>