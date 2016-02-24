
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
        <h1 class="blog-title">Material Requisition</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
          <table class="table table-bordered" id="supplies">
              <tbody>
                  <tr>
                      <td colspan="4">
                          <label>Requesting Department:
                              <input id="requesting_department" class="form-control" name="requesting_department" />
                          </label>
                      </td>
                      <td>
                          <label>Date:
                              <input id="date" class="form-control" name="date"/>
                          </label>
                      </td>
                  </tr>
                  <tr>
                      <td colspan="4">
                          <label>Purpose:
                              <input id="purpose" class="form-control" name="purpose" />
                          </label>
                      </td>
                      <td>
                          <label>Work Order Ref No:
                              <input id="work_order_ref_no" class="form-control" name="work_order_ref_no"/>
                          </label>
                      </td>
                  </tr>
                  <tr>
                      <td>Class Code No.</td>
                      <td>Description</td>
                      <td>Quantity</td>
                      <td>Unit</td>
                      <td>Remarks</td>
                  </tr>
                  <?php $defaultMaterials = $model->getDefaultMaterial();?>
                  <?php foreach($defaultMaterials as $idx => $m): ?>
                   <tr class="data default">
                      <td><input class="form-control" value="<?= $m['class_code'];?>" name="class_code_no"/></td>
                      <td><input class="form-control" value="<?= $m['description'];?>" name="description"/></td>
                      <td><input class="form-control" value="<?= $m['quantity'];?>" name="quantity"/></td>
                      <td><input class="form-control" value="<?= $m['unit'];?>" name="unit"/></td>
                      <td><input class="form-control" value="<?= $m['remarks'];?>" name="remarks"/></td>
                      <td><button class="btn remove-supply"><span class="glyphicon glyphicon-remove"></span></button></td>
                  </tr>
                  <?php endforeach ?>
                  <tr>
                      <td><input class="form-control" name="class_code_no"/></td>
                      <td><input class="form-control" name="description"/></td>
                      <td><input class="form-control" name="quantity"/></td>
                      <td><input class="form-control" name="unit"/></td>
                      <td><input class="form-control" name="remarks"/></td>
                      <td><button class="btn btn-primary add-supply"><span class="glyphicon glyphicon-plus"></span></button></td>
                  </tr>
              </tbody>
              <tfoot>
                  <tr>
                      <td colspan="2"><label>Requested By:<input class="form-control" id="requestedBy" name="requested_by"/></label></td>
                      <td colspan="2"><label>Approved By:<input class="form-control" id="approvedBy" name="approved_by"/></label></td>
                      <td><label>MRV No:<input class="form-control" id="mrvNo" name="mrv_no"/></label></td>
                  </tr>
                  <tr><td colspan="5"><button id="save" class="btn btn-lg btn-success">Save</button></td></tr>
              </tfoot>
          </table>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->

        
      </div><!-- /.row -->

    </div><!-- /.container -->
   
    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>
    <script type="text/html" id="tr">
        <tr class="data">
            <td><input class="form-control" value="[CLASS_CODE]" name="class_code_no"/></td>
            <td><input class="form-control" value="[DESCRIPTION]" name="description"/></td>
            <td><input class="form-control" value="[QUANTITY]" name="quantity"/></td>
            <td><input class="form-control" value="[UNIT]" name="unit"/></td>
            <td><input class="form-control" value="[REMARKS]" name="remarks"/></td>
            <td><button class="btn btn-primary remove-supply">x</button></td>
        </tr>
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    (function($){
        var Supply = {
          __init  : function(){
              this.__listen();
              this.initListener();
          },
          __listen    : function(){
              var me = this;
              var addSupply       = $(".add-supply").first();
              var saveSupply      = $("#save");
              var target          = addSupply.parents("tr");
              
              saveSupply.on("click", function(){
                  var data = Array();
                  var r_dept      = $("#requesting_department").val();
                  var date        = $("#date").val();
                  var purpose     = $("#purpose").val();
                  var refNo       = $("#work_order_ref_no").val();
                  var requestedBy = $("#requestedBy").val();
                  var approvedBy  = $("#approvedBy").val();
                  var mrvNo       = $("#mrvNo").val();
                  
                  if(refNo == ""){
                      alert("Work Order Ref No. is required");
                      return false;
                  }

                  $("#supplies tbody").find("tr.data").each(function(){
                      var me          = $(this);
                      var classCode   = me.find("input[name='class_code_no']").val();
                      var description = me.find("input[name='description']").val();
                      var quantity    = me.find("input[name='quantity']").val();
                      var unit        = me.find("input[name='unit']").val();
                      var remarks     = me.find("input[name='remarks']").val();

                      if(classCode != ""){
                          if(description != ""){
                              if(quantity != ""){
                                  data.push(Array(classCode,description,quantity,unit,remarks));
                              }
                          }
                      }
                  });

                  console.log(data);
                  if(data.length > 0){
                      $.ajax({
                          url     : "backend/process.php",
                          data    : {
                              r_dept      : r_dept,
                              date        : date,
                              purpose     : purpose,
                              ref_no      : refNo,
                              requestedBy : requestedBy,
                              approvedBy  : approvedBy,
                              mrvNo       : mrvNo,
                              materials   : data,
                              addSupply   : true
                          },
                          type    : 'POST',
                          dataType    : 'JSON',
                          success     : function(response){
                             alert("Record is sucesfully added.");
                              console.log(response);
                              $("tr.data:not(.default)").remove();
                              $("#supplies .data:not(.default) input").val("");
                          },
                          error       : function(){
                              console.log("err");
                          }
                      });
                  }
              });

              addSupply.on("click", function(){
                  var classCode   = target.find("input[name='class_code_no']").val();
                  var description = target.find("input[name='description']").val();
                  var quantity    = target.find("input[name='quantity']").val();
                  var unit        = target.find("input[name='unit']").val();
                  var remarks     = target.find("input[name='remarks']").val();
                  var tr          = $("#tr").html();

                  tr = tr.replace("[CLASS_CODE]", classCode).
                      replace("[DESCRIPTION]", description).
                      replace("[QUANTITY]", quantity).
                      replace("[UNIT]", unit).
                      replace("[REMARKS]", remarks);

                  target.before(tr);
                  me.initListener();
              });
          },
          initListener    : function(){
              var removeSupply    = $(".remove-supply");

              removeSupply.off().on("click", function(){
                  $(this).parents("tr").remove();
              });

          }
      }

      Supply.__init();

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

        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
