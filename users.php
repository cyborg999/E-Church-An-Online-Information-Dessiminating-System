    <?php include_once "d-top.php"; ?>

      <div class="blog-header">
        <h1 class="blog-title">System Users</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 blog-main">
          <!-- other content goes here -->
          <?php $users = new Model(); $userList = $users->getAllUsers();?>
          <table class="table table-bordered table-hovered">
              <thead>
                  <tr>
                      <th>Active</th>
                      <th>Username</th>
                      <th>Photo</th>
                      <th>Email</th>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Gender</th>
                      <th>Address</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach($userList as $idx => $user): ?>
                      <tr style="opacity:<?= ($user['deleted'] == 1) ? ".3" : "1"; ?>;">
                          <td>
                              <a href="" data-id="<?= $user[0]; ?>" class="activate label btn"><?= ($user['deleted'] == 1) ? "inactive" : "active"; ?></a>
                          </td>
                          <td><?= $user['username']; ?></td>
                          <td>
                              <a href="edit_user.php?id=<?= $user['mainId'];?>">
                                  <img width="50" height="50" src="uploads/<?= ($user['photo'] == "") ? 'user.png': $user['photo'] ;?>"/>
                              </a>
                          </td>
                          <td><?= $user['email']; ?></td>
                          <td><?= $user['firstname']; ?></td>
                          <td><?= $user['lastname']; ?></td>
                          <td><?= $user['sex']; ?></td>
                          <td><?= $user['address']; ?></td>
                      </tr>
                  <?php endforeach ?>
                  <tr>
                      <td></td>
                  </tr>
              </tbody>
          </table>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->
        <div class="col-sm-1"></div>
      </div><!-- /.row -->

    </div><!-- /.container -->
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of th
    e document so the pages load faster -->
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
          var activate    = $(".activate");

          activate.on("click", function(e){
              var me          = $(this);
              var val         = me.html();
              var id          = me.data("id");
              var opposite    = "";

              if(val == "active"){
                  opposite = 1;

                  me.html("inactive");
                  me.parents("tr").css("opacity", .3);
              } else {
                  opposite = 0;

                  me.html("active");
                  me.parents("tr").css("opacity", 1);
              }

              $.ajax({
                  url     : "backend/process.php",
                  data    : {id:id,deleted:opposite, updatedDeleted:true},
                  type    : 'POST',
                  dataType    : 'JSON',
                  success     : function(response){
                      console.log(response);
                  },
                  error       : function(){
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
