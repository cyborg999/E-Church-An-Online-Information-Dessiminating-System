    <?php include_once "d-top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">Add System User</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 blog-main">
          <!-- other content goes here -->
          <form  style="display:block;" class="box animated tile" id="box-register">
            <div class="form-group">
              <input type="text" id="username" class="form-control m-b-10" placeholder="Username">
            </div>
            <div class="form-group">
              <input type="email" id="email" class="form-control m-b-10" placeholder="Email Address">    
            </div>
  
            <div class="form-group">
              <input type="password" id="password1" class="form-control m-b-10" placeholder="Password">
            </div>
            <div class="form-group">
              <input type="password" id="password2" class="form-control m-b-20" placeholder="Confirm password">
            </div>
              <div class="form-group">
              <input type="number" required id="contact_number" class="form-control m-b-10" placeholder="Contact Number">
            </div>
            <div class="form-group">
              <select id="type"  class="form-control select">
                    <option value="secretary">Secretary</option>
                    <option value="parish_priest">Parish Priest</option>
                </select>
            </div>
            <div class="form-group hidden">
              <?php $branches = $model->getAllBranches(); ?>
              <select id="branch"  class="form-control select">
                <?php foreach($branches as $idx => $b): ?>
                  <option data-municipality="<?= $b['municipality']; ?>" value="<?= $b['id']; ?>"><?= $b['name']; ?></option>
                <?php endforeach ?>    
              </select>
            </div>

            <br>
            <button class="btn btn-lg btn-success">Register</button>
            <br>
            <br>
            <ul id="errors"></ul>
            <!-- <small><a class="box-switcher" data-switch="box-login" href="">Already have an Account?</a></small> -->
        </form>
        </div><!-- /.blog-main -->
        <div class="col-sm-3"></div>
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
            for(var i in error){
              $("#errors").append("<li>"+error[i]+"</li>");
            }
        },
        __listen : function(){
          var register    = $("#box-register");
          var me = this;

          register.on("submit", function(e){
              var username    = $("#username").val();
              var password    = $("#password1").val();
              var password2   = $("#password2").val();
              var email       = $("#email").val();
              var type        = $("#type").val();
              var branch      = $("#branch").val();
              var form        = $(this);
            
              $("#errors").html("");

              $.ajax({
                  url     : "backend/process.php",
                  data    : { registration : true,username :username, password:password, 
                      branch : branch, password2:password2, contact_number:$("#contact_number").val(),email:email, type:type,status:true },
                  type    : 'POST',
                  dataType : 'JSON',
                  success  : function(response){
                      console.log(response.added);
                      if(response.status != null){
                        alert("User is sucesfully added.");
                      } else {

                          console.log("err");
                          if(response.error.length > 0){
                              me.__error(response.error);
                          }    
                      }
                  },
                  error   : function(){
                      console.log("err");
                  }
              });
              e.preventDefault();
          });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
