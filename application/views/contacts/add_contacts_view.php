<div class="row-fluid">
        <!-- <div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">Sidebar</li>
              <li class="active"><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li class="nav-header">Sidebar</li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
              <li><a href="#">Link</a></li>
            </ul>
          </div>
        </div> -->
        <div class="span9">
          <div class="hero-unit">
            <h2>Add Contacts</h2>
            <div id="output"></div>
            <div id="msg"></div>
            <div class="well" id="Uploadbox">
              <h5>Upload Contacts CSV</h5>
              <form class="form-inline" method="post" name="frmCsv" id="frmCsv" action="<?php echo $action; ?>" enctype="multipart/form-data">
                <span class="btn btn-file">Upload<input type="file"  id="uploadFile" name="mFile" /></span>
                <input type="hidden" id="HiddenPath" name="filepath" value="">
                <button type="submit" class="btn" id="uploadCsv">Upload</button>
              </form>  
            </div>
          </div>

          <!-- ---------------JQUERY UPLOADER STARTS HERE---------------- -->
         <!--  <div id="progress">
              <div class="bar" style="width: 0%;"></div>
          </div>
          <input id="fileupload" type="file" name="mFile" data-url="<?php echo $action; ?>" >
          <div id ="helloworld"> </div> -->
          <script src="assets/js/vendor/jquery.ui.widget.js"></script>
          <script src="assets/js/jquery.iframe-transport.js"></script>
          <script src="assets/js/jquery.fileupload.js"></script>
          <script src="assets/js/tmpl.min.js"></script>
          <script>
          // $(function() {
          //   return $('#fileupload').fileupload({
          //     dataType: "script",
          //     add: function(e, data) {
          //       var allowed_size, file, types;
          //       types = /(\.|\/)(csv)$/i;
          //       allowed_size = 2000;
          //       allowed_size = allowed_size * 1024 * 1024;
          //       file = data.files[0];
          //       if ((types.test(file.type) || types.test(file.name)) && (file.size < allowed_size)) {
          //         data.context = $(tmpl("template-upload", file));
          //         $('#helloworld').append(data.context);
          //         return data.submit();
          //       } else if (file.size > allowed_size) {
          //         return alert("Failed to upload " + file.name + ": File is too big (should be at most " + allowed_size + " MB)");
          //       } else {
          //         return alert("Failed to upload " + file.name + ": File is not a supported file type");
          //       }
          //     },
          //     progress: function(e, data) {
          //       var progress;
          //       if (data.context) {
          //         progress = parseInt(data.loaded / data.total * 100, 10);
          //         return data.context.find('.bar').css('width', progress + '%');
          //       }
          //     },
          //     done: function(e, data) {
                
          //     }
          //   });
          // });
          </script>

          <!-- -----------------JQUERY UPLOADER ENDS HERE---------------- -->


        </div><!--/span-->
      </div><!--/row-->

<script>
$(document).ready(function()
{
    $('#frmCsv').on('submit', function(e)
    {
        e.preventDefault();
        $('#uploadCsv').attr('disabled', ''); // disable upload button
        $("#output").html('<p>Please Wait..!</p><img src="assets/img/ajax-loader.gif">');
         $('#Uploadbox').css({ opacity: 0.2 });
        //show uploading message
        $(this).ajaxSubmit({
          //target: '#output',
          success: function(data) {
            $("#output").empty();
            if(data == 1){
              $("#msg").html('<div class="alert alert-success"><button class="close" data-dismiss="alert" type="button">×</button>Upload Completed</div>');
             
            }else if(data == 2){
               $("#msg").html('<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>Error Uploading file.</div>');
            }else if(data == 3){
               $("#msg").html('<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>Please upload file with .csv extension.</div>');
            }else if(data == 4){
               $("#msg").html('<div class="alert alert-error"><button class="close" data-dismiss="alert" type="button">×</button>No upload directory exist.</div>');
            }
            $('#frmCsv').resetForm();
            $('#Uploadbox').css({ opacity: 1.0 });
             $('#uploadCsv').removeAttr('disabled');
          }
        });
    });
});
 
function afterSuccess()
{
    $('#frmCsv').resetForm();  // reset form
    $('#uploadCsv').removeAttr('disabled'); //enable submit button
}
</script>
<script id="template-upload" type="text/x-tmpl">
<div class="upload">
  {%=o.name%}
  <div class="progress"><div class="bar" style="width: 0%"></div></div>
</div>
</script>