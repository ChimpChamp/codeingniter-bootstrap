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
            <h2>Add Coupons</h2>
            <div id="output"></div>
            <div id="msg"></div>
            <div class="well" id="Uploadbox">
              <h5>Upload Coupons</h5>
              <form class="form-inline" method="post" name="frmCsv" id="frmCsv" action="<?php echo $action; ?>" enctype="multipart/form-data">
                <span class="btn btn-file">Upload<input type="file"  id="uploadFile" name="mFile" /></span>
                <input type="hidden" id="HiddenPath" name="filepath" value="">
                <button type="submit" class="btn" id="uploadCsv">Upload</button>
              </form>  
            </div>
          </div>
          
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