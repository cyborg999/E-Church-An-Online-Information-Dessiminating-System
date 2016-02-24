
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Marelco</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/blog.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <?php include_once "header.php"; ?>

    <div class="container">

      <div class="blog-header">
        <h1 class="blog-title">Edit Nature of Request/Complaint</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
          <?php $nature = $model->getNatureById($_GET['id']); ?>
            <form id="editNature" class="form-horizontal">
                <input type="hidden" name="editNature" value="true">
                <input type="hidden" name="id" value="<?= $nature['id'];?>">
                 <label class="labsel">Name:
                    <input type="text" name="name" class="form-control" value="<?= $nature['name'];?>"> 
                </label>
                <br>
                <label>Level of Emergency:</label>
                <select name="emergency_level" class="form-control">
                    <option <?= ($nature['emergency_level'] == "Low") ? "selected" : ""; ?> value="Low">Low</option>
                    <option  <?= ($nature['emergency_level'] == "Medium") ? "selected" : ""; ?> value="Medium">Medium</option>
                    <option <?= ($nature['emergency_level'] == "High") ? "selected" : ""; ?>  value="High">High</option>
                </select>
                <br>
                 <label>Type:</label>
                <div class="checkbox m-b-5">
                    <label>
                        <input type="radio" <?= ($nature['type'] == "request") ? "checked" : ""; ?>  name="nature"  value="request">
                        Request
                    </label>
                </div>
                <div class="checkbox m-b-5">
                    <label>
                        <input type="radio" <?= ($nature['type'] == "complaint") ? "checked" : ""; ?>  name="nature" checked value="complaint">
                        Complaint
                    </label>
                </div>
               
                <br>
                <label>Requirements:</label>
                <input type="hidden" name="requirements" id="allRequirements">
                <ul id="requirements">
                  <?php $req = explode(",", $nature['requirements']); ?>

                  <?php foreach($req as $idx => $r): ?>
                    <li data-content="<?= $r; ?>"><?= $r; ?>
                      <a href=""><span class="remove glyphicon glyphicon-remove"></span></a>
                    </li>
                  <?php endforeach ?>
                   
                  <li class="last">
                    <input type="text" class=" pull-lesft form-controsl add-requirement-text"  width="200" placeholder="add requirement.."/>
                    <button class="btn add-requirement"><span class="glyphicon glyphicon-plus"></span> </button>
                  </li>
                </ul>
                <br>
                <input  type="submit" id="Save" class="btn btn-success btn-lg" value="Save"/>
            </form>
          <br>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->

        
      </div><!-- /.row -->

    </div><!-- /.container -->
   
    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
    <script type="text/html" id="tpl">
      <li data-content="[CONTENT]">[VAL]
        <a href=""><span class="remove glyphicon glyphicon-remove"></span></a>
      </li>
    </script>

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
           __defaultListener : function(){
          $(".remove").on("click", function(e){
            $(this).parents("li").remove();
            e.preventDefault();
          });
        },
        __listen : function(){
          var saveNature = $("#Save");
          var me = this;

          me.__defaultListener();

          $(".add-requirement").on("click", function(e){
            var val = $(".add-requirement-text").val();

            if(val !=""){
              var tpl = $("#tpl").html();
              tpl = tpl.replace("[VAL]", val).
                replace("[CONTENT]", val);
              $("#requirements .last").before(tpl);
              me.__defaultListener();
            }

            e.preventDefault();
          });

          saveNature.on("click", function(e){
            var req = Array();

              $("#requirements li:not(.last)").each(function(){
                var txt = $(this).data("content");
                if($(this).parent("ul").attr("id") != null){
                  req.push(txt);
                  console.log($(this).parent("ul").attr("id"));
                }
              });

              req = req.join(",");

              $("#allRequirements").val(req);

              $.ajax({
                  url     : "backend/process.php",
                  data    : $("#editNature").serialize(),
                  type    : 'POST',
                  dataType    : 'JSON',
                  success     : function(response){
                      console.log(response);
                      alert("Record is sucesfully updated.");
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
