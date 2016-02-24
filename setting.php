    <?php include_once "d-top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">System Setting</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
          <?php $setting = new Model(); $setting = $setting->getSetting(); ?>
          <input type="hidden" value="<?= ($setting == null) ? 'null' : $setting['id']; ?>" id="settingId" />
          <br>
          <label class="label">Mission
              
          </label>
<textarea id="about"  class="form-control" rows="10" cols="300" placeholder="about...">
<?= ($setting == null) ? '' : $setting['about']; ?>
</textarea>
          <br>

          <label class="label">Vision
              
          </label>
<textarea id="slogan" class="form-control" rows="10" cols="300" placeholder="slogan text...">
<?= ($setting == null) ? '' : $setting['slogan']; ?>
</textarea>
          <br>
          <label class="label">Mobile:
          </label>            
            <input type="text" id="mobile" class="form-control" placeholder="mobile..." value="<?= ($setting == null) ? '' : $setting['mobile']; ?>"/>
          <br>
          <label class="label">Phone:
          </label>
          <input type="text" id="phone" class="form-control" placeholder="phone..." value="<?= ($setting == null) ? '' : $setting['phone']; ?>"/>
          <br>
          <label class="label">Fax:
          </label>
          <input type="text" id="fax" class="form-control" placeholder="fax..." value="<?= ($setting == null) ? '' : $setting['fax']; ?>"/>
          <br>
          <label class="label">Email:
          </label>
            <input type="text" id="email" class="form-control" placeholder="email..." value="<?= ($setting == null) ? '' : $setting['email']; ?>"/>

          <br>
          <input type="submit" class="btn btn-lg btn-success" id="updateSetting" value="update"/>
      </div>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->
      </div><!-- /.row -->
    </div><!-- /.container -->
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    (function($){
      var Page = {
        __init : function(){
          this.__listen();
        },
        __error : function(error){
            $("#errors").html("");
            for(var i in error){
              $("#errors").append("<li>"+error[i]+"</li>");
            }
        },
        __listen : function(){
          var me = this;
          var update = $("#updateSetting");

          update.on("click", function(){
              var about   = $("#about").val();
              var mobile  = $("#mobile").val();
              var id      = $("#settingId").val();
              var phone   = $("#phone").val();
              var fax     = $("#fax").val();
              var email   = $("#email").val();
              var slogan  = $("#slogan").val();

              $.ajax({
                  url     : "backend/process.php",
                  data    : {
                      updateSetting   : true,
                      id              : id,
                      slogan          : slogan,
                      about           : about,
                      mobile          : mobile,
                      phone           : phone,
                      fax             : fax,
                      email           : email
                  },
                  type        : 'POST',
                  dataType    : 'JSON',
                  success     : function(response){
                      console.log(response);
                      alert("Record is sucesfully updated");
                  },
                  error       : function(){
                      console.log("err");
                  }
              });
          });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
