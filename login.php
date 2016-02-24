<?php include_once "top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">Sign In</h1>
        <!-- <p class="lead blog-description">Lorem ipsum sit dolor u know the rest...</p> -->
      </div>
      <br>
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 blog-main">
          <form id="box-login">
            <div class="form-group">
              <label for="loginUsername" class="label">Username</label>
              <input type="text" class="form-control" id="loginUsername" placeholder="Username">
            </div>
            <div class="form-group">
              <label for="loginPassword" class="label">Password</label>
              <input type="password" class="form-control" id="loginPassword" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-success btn-lg">Login</button>
          </form>
          <br>
          <ul id="errors"></ul>
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
           var Registration = {
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
                    var me          = this;
                    var login       = $("#box-login");
                    var dataAlert   = $(".my-alert");

                    dataAlert.on("click", function(e){
                        $(this).parents(".my-alert-parent").fadeOut("slow");
                        e.preventDefault();
                    });

                    login.on("submit", function(e){
                        var username = $("#loginUsername").val();
                        var password = $("#loginPassword").val();
                        var form     = $(this);

                        $.ajax({
                            url     : "backend/process.php",
                            data    : {username : username, password : password, login : true},
                            type    : 'POST',
                            dataType : 'JSON',
                            success  : function(response){
                                console.log(response);
                                if(response.redirect != null){
                                    if(response.redirect == "Account is not yet verified"){
                                      var error = Array("Account is not yet verified.");
                                      me.__error(error);
                                    } else {
                                        window.location.href = response.redirect;
                                    }
                                    // $("#success").removeClass("hidden").fadeIn("slow");
                                } else {
                                    if(response.error.length > 0){
                                        me.__error(response.error);
                                    }    
                                }
                            },
                            error    : function(){
                                console.log("err");
                            }
                        });

                        e.preventDefault();
                    });
                }
            }

            Registration.__init();
        })(jQuery);
        </script>
  </body>
</html>
