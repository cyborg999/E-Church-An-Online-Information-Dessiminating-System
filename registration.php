<?php include_once "top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title" style="text-align:center;">Register an account</h1>
      </div>
      <br>
      <div class="row">
        <form id="frmUpdate">
        <input type="hidden" name="addApplication" value="true"/>
        <input type="hidden" name="photo" id="photo" class="form-control" placeholder="photo..."/>
        <div class="col-sm-7">
          <table class="table">
            <thead>
              <tr>
                <th><h3>Personal</h3></th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>  <label class="gender" for="firstname">Firstname</label> </td>
                <td>
                  <input class="form-control" type="text" id="firstname" value="" name="firstname" placeholder="firstname...">
                </td>
              </tr>
              <tr>
                <td> <label class="gender" for="lastname">Lastname</label></td>
                <td>  <input class="form-control" type="text" id="lastname" value=""  name="lastname" placeholder="lastname..."></td>
              </tr>
              <tr>
                <td><label class="gender" for="middlename">Middlename</label></td>
                <td><input class="form-control" type="text" id="middlename" value="" name="middlename" placeholder="middlename..."></td>
              </tr>
              <tr>
                <td><label class="label" for="contact_number">Contact Number</label></td>
                <td><input class="form-control" type="text" id="contact_number" required value="" name="contact_number" placeholder="contact number..."></td>
              </tr>
              <tr>
                <td colspan="2">
                  <hr>
                </td>
              </tr>
              <tr>
                <td><label class="gender" for="address">Address</label></td>
                <td><input class="form-control" type="text" value=""  id="address" name="address" placeholder="address..."></td>
              </tr>
              <tr>
                <td> <label class="gender" for="civil_status">Civil Status</label></td>
                <td><select class="form-control" name="civil_status" id="civil_status">
                    <option value="Single">Single</option>
                    <option value="Married">Married</option>
                    <option value="Separated">Separated</option>
                    <option value="Divorced">Divorced</option>
                    <option value="Widowed">Widowed</option>
                  </select></td>
              </tr>
              <tr>
                <td><label class="gender" for="dob">Date of Birth</label></td>
                <td><input class="form-control" type="text" value=""  id="dob" name="dob" placeholder="Date of Birth..."></td>
              </tr>
              <tr>
                <td><label class="gender" for="pob">Place of Birth</label></td>
                <td> <input class="form-control" type="text" value=""  id="pob" name="pob" placeholder="Place of Birth..."></td>
              </tr>
              <tr>
                <td><label class="gender" for="age">Age</label></td>
                <td><input class="form-control" readonly type="text" id="age" name="age" value=""  placeholder="age..."></td>
              </tr>
              <tr>
                <td><label class="gender" for="gender">Gender</label></td>
                <td>
                  <div class="radio-inline">
                    <label class="gender"> <input type="radio" name="gender" id="male" checked value="male">Male</label>
                  </div>
                  <div class="radio-inline">
                    <label class="gender">
                        <input type="radio" name="gender"  id="female" value="female">Female
                    </label>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-sm-5">
          <!-- other information -->
          <table class="table">
            <thead>
              <tr>
                <th colspan="2">
                  <h3>Account Information</h3>
                </th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><label class="label">Username</label></td>
                <td> <input type="text" name="username"  required class="form-control m-b-10" placeholder="Username"></td>
              </tr>
              <tr>
                <td><label class="label">Email</label></td>
                <td><input type="email" name="email" required class="form-control m-b-10" placeholder="Email Address"> </td>
              </tr>
              <tr>
                <td><label class="label">Password</label></td>
                <td><input type="password" required name="password" class="form-control m-b-10" placeholder="Password"></td>
              </tr>
              <tr>
                <td><label class="label">Password</label></td>
                <td>
              <input name="type" type="hidden" value="applicant"/>
                  <input type="password" required name="password2" class="form-control m-b-20" placeholder="Confirm Password"></td>
              </tr>
              <tr>
                <td>
                  <input type="submit" value="register" class="btn btn-lg btn-success"/>
                </td>
              </tr>
              <tr>
                <td>
                  <ul id="errors"></ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
          <br>
          <br>
        </form>
      </div>

    </div><!-- /.container -->
    <script type="text/html" id="tpl">
      <tr>
        <td><input type="text" name="c-name[]" class="children-name form-control" placeholder="Name"/></td>
        <td><input type="text" name="c-dob[]" class="children-dob form-control" placeholder="Birthdate"/></td>
        <td>
          <a href="" class="btn delete-child"><span class="glyphicon glyphicon-remove"></span></a>
        </td>
      </tr>
    </script>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/jquery-ui.min.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
     <script type="text/javascript">
        (function($){
            var Dashboard = {
                __init : function(){
                    this.__listen();
                },
                __error : function(error){
                    for(var i in error){
                      $("#errors").append("<li>"+error[i]+"</li>");
                    }
                },
                __listen : function(){
                    var me      = this;
                    
                    $("#dob").datepicker();
                    $("#dob").on("change", function(){
                      var date = $(this).val();
                      var dob = new Date(date);
                      var today = new Date();
                      var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));

                      $("#age").val(age);
                    });

                    $("#frmUpdate").on("submit", function(e){
                        e.preventDefault();
                        $.ajax({
                          url : 'backend/process.php',
                          data  : $(this).serialize(),
                          type  : 'POST',
                          dataType :'JSON',
                          success: function(response){
                            $("#errors").html("");
                            console.log(response);
                            if(response.status != null){
                                alert("Record is succesfully Added.");

                                    // $("#success").removeClass("hidden").fadeIn("slow");
                            } else {
                                if(response.error.length > 0){
                                    me.__error(response.error);
                                }    
                            }
                            
                            // $("#info").modal("show");
                          },
                          error   : function(){
                            console.log("Oops, something went wrong");
                          }
                        });

                      });

                }   
              
            }

            Dashboard.__init();
        })(jQuery);
        </script>
  </body>
</html>
