<!DOCTYPE html>
<html lang="en">
<head>
   <title>Reddit | Edit Crypto</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

   <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/style.css">
   <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/responsive.css">

</head>

<body>

<header>
   <nav class="navbar nav-bar navbar-expand-md">
      <a class="navbar-brand Brand-logo" href="index.html">
         <h1 class="title-logo">Edit <span class="title-effect">Crypto</span></h1>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
         <span class="navbar-toggler-icon">
            <i class="fa fa-bars" aria-hidden="true"></i>
         </span>
      </button>

        <!-- <div class="top-right links">
                    <a href="{{ route('protection.membership') }}">{{ __('views.welcome.member_area') }}</a>

                    @if (Route::has('login'))
                        @if (!Auth::check())
                            @if(config('auth.users.registration'))
                                <a href="{{ url('/register') }}">{{ __('views.welcome.register') }}</a>
                            @endif
                            <a href="{{ url('/login') }}">{{ __('views.welcome.login') }}</a>
                        @else
                            @if(auth()->user()->hasRole('administrator'))
                                <a href="{{ url('/admin') }}">{{ __('views.welcome.admin') }}</a>
                            @endif
                            <a href="{{ url('/logout') }}">{{ __('views.welcome.logout') }}</a>
                        @endif
                    @endif
                </div> -->

      <div class="collapse navbar-collapse" id="collapsibleNavbar">
         <ul class="navbar-nav top-nav ml-auto">

            <li class="nav-item d-none d-md-block">
               <div class="search-block">
                  <input class="form-control" type="text" title="Search" placeholder="Search Crypto ex, What is Bitcoin?">
                  <i class="fa fa-search" aria-hidden="true"></i>
               </div>
            </li>

            <li class="nav-item">
               <a class="nav-link" href="#">New to Crypto?</a>
            </li>
         @if (Route::has('login'))
              @if (!Auth::check())
            <li class="nav-item">
               <a class="nav-link" href="{{ url('/login') }}">Sign In/Create Account</a>
            </li>   
            @else
              <li class="nav-item">
               <a href="{{ url('/logout') }}">{{ __('views.welcome.logout') }}</a>
            </li> 
           @endif
           @endif
         </ul>
      </div>  
   </nav>

   
   <!-- for mobile -->
   <div class="search-block d-md-none">
      <input class="form-control" type="text" title="Search" placeholder="Search Crypto ex, What is Bitcoin?">
      <i class="fa fa-search" aria-hidden="true"></i>
   </div>
   <!-- for mobile -->
      
</header>
@if (Route::has('login'))
          @if (!Auth::check())

       @else
         <section class="bnner-bg">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-lg-8 col-md-8 col-12">
            <div class="branded-content">
               <h1 class="">Create a <span class="title-effect">Post</span></h1>
            </div>
         </div>
      </div>
   </div>
</section>

<section class="pt-5 pb-5 bg-light">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="create-post-block">

               <!-- Nav tabs -->

               <ul class="nav nav-tabs">
                  <li class="nav-item">
                     <a class="nav-link corner-radius active" data-toggle="tab" href="#home">
                        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>Post</a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link" data-toggle="tab" href="#menu1">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>Images & Video</a>
                  </li>
               </ul>

               <!-- Tab panes -->

               <div class="tab-content">
                   <form method="post">
                       <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                  <div id="home" class="tab-pane active">
                     <div class="row">
                        <div class="col-lg-12">
                           <div class="post-input-block">
                              <input type="text" placeholder="Title" name="" class="form-control">
                           </div>


                           <div class="ck-editor-block mt-3">
                              <textarea name="" id="editor" cols="30" rows="10"></textarea>
                           </div>

                           <div class="post-btns">
                              <button type="submit" class="theme-btn2">Cancel</button>
                              <button type="submit" class="theme-btn">Post</button>
                           </div>
                        </div>
                     </div>
                  </div>

                  <div id="menu1" class="tab-pane fade">
                     <div class="row">
                        <div class="col-lg-12">
                          
                           <div class="post-input-block">
                              <input type="text" placeholder="Title" name="" class="form-control">
                           </div>


                           <div class="uploaded-img-block mt-3">
                              <!-- Upload  -->
                              <form id="file-upload-form" class="uploader">
                                 <input id="file-upload" type="file" name="fileUpload" accept="image/*" />

                                 <label for="file-upload" id="file-drag">
                                    <img id="file-image" src="#" alt="Preview" class="hidden">
                                    <div id="start">
                                       <i class="fa fa-download" aria-hidden="true"></i>
                                       <p>Select a file or drag here</p>
                                       <div id="notimage" class="hidden">Please select an image</div>
                                       <span id="file-upload-btn" class="btn theme-btn">Upload</span>
                                    </div>

                                    <div id="response" class="hidden">
                                       <div id="messages"></div>
                                       <progress class="progress" id="file-progress" value="0">
                                          <span>0</span>%
                                       </progress>
                                    </div>
                                 </label>
                              
                           </div>

                           <div class="post-btns">
                              <button type="submit" class="theme-btn2">Cancel</button>
                              <button type="submit" class="theme-btn">Post</button>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
              </div>
            </div>
         </div>
      </div>
   </div>
</section>
       @endif
@endif
</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>

<!-- ck edotor -->
<script>
   CKEDITOR.replace('editor', {
  skin: 'moono',
  enterMode: CKEDITOR.ENTER_BR,
  shiftEnterMode:CKEDITOR.ENTER_P,
  toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
             { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
});

</script>

<!-- images upload  -->

<script>
   // File Upload
// 
function ekUpload(){
  function Init() {

    console.log("Upload Initialised");

    var fileSelect    = document.getElementById('file-upload'),
        fileDrag      = document.getElementById('file-drag'),
        submitButton  = document.getElementById('submit-button');

    fileSelect.addEventListener('change', fileSelectHandler, false);

    // Is XHR2 available?
    var xhr = new XMLHttpRequest();
    if (xhr.upload) {
      // File Drop
      fileDrag.addEventListener('dragover', fileDragHover, false);
      fileDrag.addEventListener('dragleave', fileDragHover, false);
      fileDrag.addEventListener('drop', fileSelectHandler, false);
    }
  }

  function fileDragHover(e) {
    var fileDrag = document.getElementById('file-drag');

    e.stopPropagation();
    e.preventDefault();

    fileDrag.className = (e.type === 'dragover' ? 'hover' : 'modal-body file-upload');
  }

  function fileSelectHandler(e) {
    // Fetch FileList object
    var files = e.target.files || e.dataTransfer.files;

    // Cancel event and hover styling
    fileDragHover(e);

    // Process all File objects
    for (var i = 0, f; f = files[i]; i++) {
      parseFile(f);
      uploadFile(f);
    }
  }

  // Output
  function output(msg) {
    // Response
    var m = document.getElementById('messages');
    m.innerHTML = msg;
  }

  function parseFile(file) {

    console.log(file.name);
    output(
      '<strong>' + encodeURI(file.name) + '</strong>'
    );
    
    // var fileType = file.type;
    // console.log(fileType);
    var imageName = file.name;

    var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
    if (isGood) {
      document.getElementById('start').classList.add("hidden");
      document.getElementById('response').classList.remove("hidden");
      document.getElementById('notimage').classList.add("hidden");
      // Thumbnail Preview
      document.getElementById('file-image').classList.remove("hidden");
      document.getElementById('file-image').src = URL.createObjectURL(file);
    }
    else {
      document.getElementById('file-image').classList.add("hidden");
      document.getElementById('notimage').classList.remove("hidden");
      document.getElementById('start').classList.remove("hidden");
      document.getElementById('response').classList.add("hidden");
      document.getElementById("file-upload-form").reset();
    }
  }

  function setProgressMaxValue(e) {
    var pBar = document.getElementById('file-progress');

    if (e.lengthComputable) {
      pBar.max = e.total;
    }
  }

  function updateFileProgress(e) {
    var pBar = document.getElementById('file-progress');

    if (e.lengthComputable) {
      pBar.value = e.loaded;
    }
  }

  function uploadFile(file) {

    var xhr = new XMLHttpRequest(),
      fileInput = document.getElementById('class-roster-file'),
      pBar = document.getElementById('file-progress'),
      fileSizeLimit = 1024; // In MB
    if (xhr.upload) {
      // Check if file is less than x MB
      if (file.size <= fileSizeLimit * 1024 * 1024) {
        // Progress bar
        pBar.style.display = 'inline';
        xhr.upload.addEventListener('loadstart', setProgressMaxValue, false);
        xhr.upload.addEventListener('progress', updateFileProgress, false);

        // File received / failed
        xhr.onreadystatechange = function(e) {
          if (xhr.readyState == 4) {
            // Everything is good!

            // progress.className = (xhr.status == 200 ? "success" : "failure");
            // document.location.reload(true);
          }
        };

        // Start upload
        xhr.open('POST', document.getElementById('file-upload-form').action, true);
        xhr.setRequestHeader('X-File-Name', file.name);
        xhr.setRequestHeader('X-File-Size', file.size);
        xhr.setRequestHeader('Content-Type', 'multipart/form-data');
        xhr.send(file);
      } else {
        output('Please upload a smaller file (< ' + fileSizeLimit + ' MB).');
      }
    }
  }

  // Check for the various File API support.
  if (window.File && window.FileList && window.FileReader) {
    Init();
  } else {
    document.getElementById('file-drag').style.display = 'none';
  }
}
ekUpload();
</script>
</body>
</html>
