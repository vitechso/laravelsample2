
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script> -->


<!-- ck edotor -->

<!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- jQuery UI -->
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
   
<script>
$(document).ready(function(){
  
  
  setTimeout(function(){ 
    $('.alert .close').trigger('click');
  }, 5000);
// Initialize 
var CSRF_TOKEN = '{{ csrf_token() }}';
$( ".searchbar" ).keyup(function(){
  console.log($(this).val().length);
  if($(this).val().length==0){
    $('input[name="selected_result_id"]').val('');
  }
});

$('body').on('click','.ui-menu-item',function(){
  // console.log('asdasd');
  $('#searchkeywordform').submit();
})
$( ".searchbar" ).autocomplete({
  source: function( request, response ) {
    // Fetch data
    $.ajax({
      url:"{{route('searchautocomplete')}}",
      type: 'post',
      dataType: "json",
      data: {
        _token: CSRF_TOKEN,
        search: request.term
      },
      success: function( data ) {
        response( data );
      }
    });
  },
  select: function (event, ui) {
    console.log(event);
    // Set selection
    $('.searchbar').val(ui.item.label); // display the selected text
    $('.employeeid').val(ui.item.value); // save selected id to input
    return false;
  }
});

});




  $(document).ready(function() {
$("#form1").validate({
  ignore: [],
  onfocusout: false,
  rules: {
    // simple rule, converted to {required:true}
    
    title: "required",
    description:"required",
    tags:"required",


  },
  errorPlacement: function(error, element) 
                {
                    if (element.attr("name") == "description") 
                   {
                    error.insertAfter(".ck-editor-block");
                    } else {
                    error.insertAfter(element);
                    }
                }
});


$("#form2").validate({
  ignore: [],
  rules: {
    // simple rule, converted to {required:true}
    
    title: "required",
    tags:"required",
    media_file:"required"
  },
  errorPlacement: function(error, element) 
                {
                    if (element.attr("name") == "media_file") 
                   {
                    error.insertAfter(".uploader");
                    } else {
                    error.insertAfter(element);
                    }
                }
});


  $(".theme-btn").mousedown(function(){
    for (var i in CKEDITOR.instances){
      CKEDITOR.instances[i].updateElement();
    }
  });
});

  /*CKEDITOR.replace('description', {

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

});*/

  



$("#title1").keyup(function(){

  //alert("The paragraph was clicked.");

  var title=$(this).val();

  $("#title2").val(title);

});



$("#title2").keyup(function(){

  //alert("The paragraph was clicked.");

  var title=$(this).val();

  $("#title1").val(title);

});



$("#tags1").keyup(function(){

  //alert("The paragraph was clicked.");

  var tags=$(this).val();

  $("#tags2").val(tags);

});



$("#tags2").keyup(function(){

  //alert("The paragraph was clicked.");

  var tags=$(this).val();

  $("#tags1").val(tags);

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