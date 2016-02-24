    <?php include_once "d-top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">Add Announcement</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 blog-main">
          <!-- other content goes here -->
          <form  id="addAnnouncement" class="form form-label-left">
              <input type="hidden" name="inhabitantAdd" value="true"/>
                  <label class="label">Title</label>
                  <input type="text" class="form-control" required id="title" placeholder="Title...">
                  <label class="label">Description</label>
                  <textarea id="description" class="form-control" required placeholder="Description..." rowspan="30"></textarea>
              <br>              
              <br>              
              <button type="button" id="add-announcement" class="btn btn-success btn-lg">Save</button>
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
          var save    = $("#add-announcement");

          save.on("click", function(e){
                var title   = $("#title").val();
                var desc    = $("#description").val();

                $("#errors").html("");

                if(title != ""){
                  if(desc !=""){
                      $.ajax({
                        url     : "backend/process.php",
                        data    : {title: title, description:desc, announcement:true},
                        type    : 'POST',
                        dataType : 'JSON',
                        success     : function(response){
                            console.log(response);
                            alert("Record is sucesfully saved.");
                        },
                        error   : function(){
                            console.log("err");
                        }
                    });
                  } else {
                    me.__error(Array("Description is required."));
                    return false;
                  }
                } else {
                    me.__error(Array("Title is required."));
                    console.log(desc);

                  return false;
                }

                

                e.preventDefault(); 
            }); 
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
