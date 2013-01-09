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
            <h2>Settings</h2>
            <!-- mailchimp form -->
            <div class="well">
              <h5>MailChimp API</h5>
              <?php if($MCkey){ ?>
                <p class="alert alert-success" ><?php echo $MCkey; ?><a class="pull-right" id="changeMC">Change</a></p>
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
                   <input type="text" class="input-large" name="key" placeholder="MailChimp Api Key">
                   <button type="submit" class="btn">Submit</button>
                   <a id="closeMcFrm" class="pull-right">X</a>
                </form>

              </div>
            </div>
            <!-- shopify form -->
            <div class="well">
              <h5>Shopify</h5>
             <!--  <?php if($shopifyData){?>

              <?php } ?> -->
              <div class="shopifyFrm">
                <form class="form-horizontal" name="frm_shopify" id="frm_shopify" method="post" action="<?php echo $actionShopify;?>">
                  <input type="hidden" name="shopify" value="SH">
                  <div class="control-group">
                    <label class="control-label" for="shopName">Shop Name</label>
                    <div class="controls">
                      <label class="control-label show" for="API"><i><?php echo $getShop;?></i></label>
                      <input type="text" id="shopName" class="edit" value="<?php echo $getShop;?>" name="shopName" placeholder="Shop Name">
                    </div>
                  </div>
                  <div class="control-group">
                    <label class="control-label" for="API">API</label>
                    <div class="controls">
                      <label class="control-label show" for="API"><i><?php echo $getApi;?></i></label>
                      <input type="text" id="shopifyApi" class="edit" value="<?php echo $getApi;?>" name="shopifyApi" placeholder="API">
                    </div>
                  </div>
                  <div class="control-group">
                  <div class="controls">
                    <a class="show" id="editShopify">Edit</a>
                  <button type="submit" class="btn edit">Authenticate</button>
                  </div>
                  </div>
                </form>
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