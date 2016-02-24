
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
        <h1 class="blog-title">Add/Edit Supply</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-12 blog-main">
          <!-- other content goes here -->
          <table class="table table-bordered" id="supplies">
            <thead>
                <tr>
                    <th>Default</th>
                    <th>Class Code No.</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Unit</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr class="first">
                    <td>
                        <input type="checkbox" id="is_default" name="is_default"/>
                    </td>
                    <td><input class="form-control" name="class_code_no"/></td>
                    <td><input class="form-control" name="description"/></td>
                    <td><input class="form-control" name="quantity"/></td>
                    <td><input class="form-control" name="unit"/></td>
                    <td><input class="form-control" name="remarks"/></td>
                    <td><button class="btn btn-primary add-supply"><span class="glyphicon glyphicon-plus"></span></button></td>
                </tr>
                <?php $materials = $model->getAllMaterial(); ?>
                <?php foreach($materials as $idx => $m): ?>
                <tr data-id="<?= $m['id'];?>">
                    <td>
                        <input type="checkbox" readonly name="is_default" <?= ($m['is_default'] == 1) ? "checked" : "";?>/>
                    </td>
                    <td><input class="form-control" readonly name="class_code_no" value="<?= $m['class_code'];?>" /></td>
                    <td><input class="form-control" readonly name="description" value="<?= $m['description'];?>"/></td>
                    <td><input class="form-control" readonly name="quantity" value="<?= $m['quantity'];?>"/></td>
                    <td><input class="form-control" readonly name="unit" value="<?= $m['unit'];?>"/></td>
                    <td><input class="form-control" readonly name="remarks" value="<?= $m['remarks'];?>"/></td>
                    <td width="200">
                        <button class="btn pull-left edit-supply"><span class="glyphicon glyphicon-pencil"></span></button>
                        <button class="btn hidden pull-left save-supply"><span class="glyphicon glyphicon-ok"></span></button>
                        <button style="margin-left:2px;" class="btn hidden pull-left close-supply"><span class="glyphicon glyphicon-remove"></span></button>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
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
      <tr class="data" data-id=[ID]>
          <td>
              <input type="checkbox" readonly style="opacity:1;" readonly name="is_default" [CHECKED]/>
          </td>
          <td><input class="form-control" readonly value="[CLASS_CODE]" name="class_code_no"/></td>
          <td><input class="form-control" readonly value="[DESCRIPTION]" name="description"/></td>
          <td><input class="form-control" readonly value="[QUANTITY]" name="quantity"/></td>
          <td><input class="form-control" readonly value="[UNIT]" name="unit"/></td>
          <td><input class="form-control" readonly value="[REMARKS]" name="remarks"/></td>
          <td width="200">
              <button class="btn pull-left edit-supply"><span class="glyphicon glyphicon-pencil"></span></button>
              <button class="btn hidden pull-left save-supply"><span class="glyphicon glyphicon-ok"></span></button>
              <button style="margin-left:2px;" class="btn hidden pull-left close-supply"><span class="glyphicon glyphicon-remove"></span></button>
          </td>
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
                    var target          = $("#supplies tbody");
                    

                    $(".main-search").off().on("keyup", function(){
                        var txt = $(this).val();
                        var target = $("#supplies tbody");
                        var all = (txt.length == 0) ? true : false;
                        target.find("tr:not(.first)").remove();

                        var target = $("#supplies tbody");
                        $.ajax({
                            url     : "backend/process.php",
                            data    : {searchMaterial:true, txt:txt, all:all},
                            type    : 'POST',
                            dataType    : 'JSON',
                            success     : function(response){
                                if(response.materials.length == 0){
                                    return false;
                                }
                                
                                var tpl = $("#tr").html();

                                for(var i in response.materials){
                                      tpl = tpl.replace("[CLASS_CODE]", response.materials[i].class_code).
                                        replace("[DESCRIPTION]", response.materials[i].description).
                                        replace("[CHECKED]", (response.materials[i].is_default == 1) ? "checked" : "").
                                        replace("[QUANTITY]", response.materials[i].quantity).
                                        replace("[UNIT]", response.materials[i].unit).
                                        replace("[ID]", response.materials[i].id).
                                        replace("[REMARKS]", response.materials[i].remarks);

                                    target.find("tr").last().after(tpl);
                                }
                                
                                me.initListener();
                            },
                            error   : function(){
                                console.log("err");
                            }
                        });
                    });

                    addSupply.on("click", function(){
                        var checked     = $(this).parents("tr").find("input[name='is_default']").is(":checked");
                        // var checked     = target.find("input[name='is_default']");
                        var classCode   = target.find("input[name='class_code_no']").val();
                        var description = target.find("input[name='description']").val();
                        var quantity    = target.find("input[name='quantity']").val();
                        var unit        = target.find("input[name='unit']").val();
                        var remarks     = target.find("input[name='remarks']").val();
                        var tr          = $("#tr").html();

                        if(description == ""){
                            alert("Description is required.");
                            return false;
                        }

                        tr = tr.replace("[CLASS_CODE]", classCode).
                            replace("[DESCRIPTION]", description).
                            replace("[CHECKED]", (checked == true) ? "checked" : "").
                            replace("[QUANTITY]", quantity).
                            replace("[UNIT]", unit).
                            replace("[REMARKS]", remarks);

                        $.ajax({
                            url     : "backend/process.php",
                            data    : {
                                addMaterial     : true,
                                checked         : checked,
                                classCode       : classCode,
                                description     : description,
                                quantity        : quantity,
                                unit            : unit,
                                remarks         : remarks
                            },
                            type    : 'POST',
                            dataType    : 'JSON',
                            success     : function(response){
                                target.append(tr);
                                me.initListener();
                            },
                            error       : function(){
                                console.log("err");
                            }
                        });

                    });
                },
                initListener    : function(){
                    var removeSupply    = $(".remove-supply");
                    var editSupply      = $(".edit-supply");
                    var cancelSupply    = $(".close-supply");
                    var saveSupply      = $(".save-supply");

                    removeSupply.off().on("click", function(){
                        $(this).parents("tr").remove();
                    });

                    saveSupply.on("click", function(){
                        var target      = $(this).parents("tr");
                        var id          = target.data("id");
                        var checked     = $(this).parents("tr").find("input[name='is_default']").is(":checked");
                        var classCode   = target.find("input[name='class_code_no']").val();
                        var description = target.find("input[name='description']").val();
                        var quantity    = target.find("input[name='quantity']").val();
                        var unit        = target.find("input[name='unit']").val();
                        var remarks     = target.find("input[name='remarks']").val(); 

                        $(this).addClass("hidden");
                        $(this).parents("td").find(".close-supply").addClass("hidden");
                        $(this).parents("td").find(".edit-supply").removeClass("hidden");
                        $(this).parents("tr").find("input").attr("readonly","readonly");

                         $.ajax({
                            url     : "backend/process.php",
                            data    : {
                                updateMaterial     : true,
                                id              : id,
                                checked         : checked,
                                classCode       : classCode,
                                description     : description,
                                quantity        : quantity,
                                unit            : unit,
                                remarks         : remarks
                            },
                            type    : 'POST',
                            dataType    : 'JSON',
                            success     : function(response){
                                console.log("success");
                            },
                            error       : function(){
                                console.log("err");
                            }
                        });
                    });

                    editSupply.on("click", function(){
                        $(this).addClass("hidden");
                        $(this).parents("td").find(".save-supply, .close-supply").removeClass("hidden");
                        $(this).parents("tr").find("input").removeAttr("readonly");
                    });

                    cancelSupply.on("click", function(){
                        $(this).addClass("hidden");
                        $(this).parents("td").find(".save-supply").addClass("hidden");
                        $(this).parents("td").find(".edit-supply").removeClass("hidden");
                        $(this).parents("tr").find("input").attr("readonly","readonly");
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
