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
            <h2>Admin</h2>
            <!-- mailchimp form -->
            <div class="well">
              <fieldset>
              <legend>MailChimp API</legend>
              <?php if($MCkey){ ?>
                <p class="alert alert-success" ><b>Key:</b> <i><?php echo $MCkey; ?></i><br>
                  <b>List:</b> <i><?php echo $McList; ?></i><a class="pull-right" id="changeMC">Change</a></p>
              <?php }elseif($MCkey == ''){ ?>
                <script>
                 $(document).ready(function() {
                    $('.MCkeyform').show();
                  });
                </script>
              <?php } ?>
              <div class="MCkeyform">
                <form class="form-inline" name="frm_MC" id="frm_MC" method="post" action="<?php echo $actionMC; ?>">
                  <input type="hidden" name="type" value="MC">
                   <input type="text" class="input-large" id="key" name="key" placeholder="MailChimp Api Key">
                   <input type="button" class="btn btn-mini btn-primary" id="get_list" value="Get List">
                   <select name="MC_lsit" id="MClists">
                      <option value="0">Select a List</option>
                    </select>
                   <button type="submit" class="btn">Submit</button>
                   <span id="closeMcFrm" class="icon-remove pull-right">&nbsp;</span>
                </form>

              </div>
            </fieldset>
            </div>
            <!-- shopify form -->
            <div class="well">
              <fieldset>
              <legend>Download</legend>
              <form method="post" id="csvDownload" action="index.php/common/settings/downloadCSV" name="csvDownload">
                <!-- <label>Label name</label> -->
                <input type="text" name="MF" placeholder="Enter MF File Name"><br>
                <button class="btn btn-large btn-primary" type="submit" id="download">Download Contacts CSV</button>
              </form>
            </fieldset>
              <div class="shopifyFrm">
               
            </div>
            </div>
          </div>
          
        </div><!--/span-->
      </div><!--/row-->
      <?php if($getShop){?>
      <script>
        $(document).ready(function() {
            $('.show').show();
            $('.edit').hide();
        });
      </script>
       <?php }else{ ?>
        <script>
        $(document).ready(function() {
            $('.show').hide();
            $('.edit').show();
        });
      </script>
       <?php } ?>
       <script>
       $('#editShopify').click(function(){
          $('.show').hide();
            $('.edit').show();
        });
       </script>