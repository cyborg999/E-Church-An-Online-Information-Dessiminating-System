    <?php include_once "d-top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">All Schedule Information</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10 blog-main">
          <!-- other content goes here -->
          <?php $list = $model->getScheduleList(true);
          ?>
          <table class="table table-bordered table-hovered">
              <thead>
                  <tr>
                      <th>
                        <label class="btn">Send All
                          <input type="checkbox" id="checkAll" value="true">
                        </label>
                      </th>
                      <th>Event Name</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                      <th>Contact Number</th>
                      <th>Firstname</th>
                      <th>Lastname</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody id="applicants">
                  <?php foreach($list as $idx => $user): ?>
                      <tr  data-id="<?= $user['id'];?>" style="opacity:<?= ($user['deleted'] == 1) ? ".3" : "1"; ?>;">
                          <td>
                            <input type="checkbox" value="<?= $user['id']; ?>" name="smsId">
                          </td>
                          <td><?= $user['title'];?></td>
                          <td><?= $user['startdate'];?></td>
                          <td><?= $user['enddate'];?></td>
                          <td><?= $user['contact_number'];?></td>
                          <td><?= $user['firstname'];?></td>
                          <td><?= $user['lastname'];?></td>
                          <td>
                            <a data-contact="<?= $user['contact_number'];?>" data-title="<?= $user['title'];?>" href="" class="approve btn  btn-success">
                              <?= ($user['approved'] == 1) ? "Disapprove" : "Approve";?>
                            </a>
                            <a href="" class="btn pull-right delete">
                              <span class="glyphicon glyphicon-trash"></span>
                            </a>
                          </td>
                      </tr>
                  <?php endforeach ?>
                  <tr>
                      <td>
                        <input type="submit" id="prepareSms" class="btn btn-sm btn-primary" value="Send SMS">
                      </td>
                  </tr>
              </tbody>
          </table>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->
        <div class="col-sm-1"></div>
      </div><!-- /.row -->

    </div><!-- /.container -->
    <script type="text/html" id="req-tpl">
        <li><label><input type="checkbox" style="opacity:1;" /> <span class="req-name">[NAME]</span></label></li>
    </script>
    <!-- Modal Resize alert -->
    <div class="modal fade" id="sendSms">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Recipients</h4>
                        <select id="recipients" data-placeholder="Recipients" style="width:350px;" multiple class="chosen-select" tabindex="8">
                          <option value=""></option>
                          <?php foreach($list as $idx => $u): ?>
                            <option data-id="<?= $u['id'];?>" value="<?= $u['contact_number'];?>"><?= $u['contact_number'];?></option>
                          <?php endforeach ?>                          
                        </select>
                   </div>
                   <div class="modal-body">
                        <textarea class="form-control" placeholder="message" id="message"></textarea>
                   </div>
                   
                   <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-sm" id="saveSms" >Okay</button>
                        <button type="button" class="btn btn-info btn-sm" id="cancelSms" data-dismiss="modal">Cancel</button>
                   </div>
              </div>
         </div>
    </div>
    <div class="modal fade" id="updateRequirement">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Update User Requirement</h4>
                   </div>
                   <div class="modal-body">
                        <div id="my-residential-requirements">
                            <h5>Residential Membership Requirements</h5>
                            <ul style="list-style-type:none;" id="residential-requirement-edit">
                                <?php $requirements = $model->getAllRequirementsByType("residential"); ?>
                                <?php foreach($requirements as $idx => $r): ?>
                                    <li><label><input type="checkbox" style="opacity:1;" /> <span class="req-name"><?= $r['name'];?></span></label></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <div id="my-commercial-requirements">
                            <h5>Commercial Membership Requirements</h5>
                            <ul style="list-style-type:none;" id="commercial-requirement-edit">
                                <?php $requirements = $model->getAllRequirementsByType("commercial"); ?>
                                <?php foreach($requirements as $idx => $r): ?>
                                    <li><label><input type="checkbox" style="opacity:1;" /> <span class="req-name"><?= $r['name'];?></span></label></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                   </div>
                   
                   <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-sm" id="saveMyRequirement" >Okay</button>
                        <button type="button" class="btn btn-info btn-sm" id="editMyCancel" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-info btn-sm pull-right hidden" id="complete" >Mark as Complete</button>
                   </div>
              </div>
         </div>
    </div>
    <div class="modal fade" id="addRequirements">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">Edit Requirement</h4>
                   </div>
                   <div class="modal-body">
                    <div class="row">
                        <div class="columns col-lg-3 col-md-3 col-sm-3">
                            <input type="text" id="newRequirement" class="form-control" placeholder="new.."/>
                        </div>
                        <div class="columns col-lg-3 col-md-3 col-sm-3">
                            <label>Membership Type</label>
                            <label>Residential
                                <input type="radio" value="residential" class="rdaio" style="opacity:1;" checked name="membership_type">
                            </label>
                            <label>Commercial
                                <input type="radio" value="commercial"  class="radsio" style="opacity:1;"  name="membership_type">
                            </label>
                        </div>
                        <div class="columns col-lg-3 col-md-3 col-sm-3">
                            <input type="submit" value="add new requirement" id="addNewRequirement" class="btn "/>
                        </div>
                    </div>
                    <br>
                    <h5>Residential Membership type Requirements</h5>
                        <ul style="list-style-type:none;" id="residential-requirement">
                            <?php $requirements = $model->getAllRequirementsByType("residential"); ?>
                            <?php foreach($requirements as $idx => $r): ?>
                                <li><label><input type="checkbox" style="opacity:1;" <?= ($r['checked'] == 1) ? 'checked' : '';?>/> <span class="req-name"><?= $r['name'];?></span></label></li>
                            <?php endforeach ?>
                        </ul>
                         <h5>Commercial Membership type Requirements</h5>
                        <ul style="list-style-type:none;" id="commercial-requirement">
                            <?php $requirements = $model->getAllRequirementsByType("commercial"); ?>
                            <?php foreach($requirements as $idx => $r): ?>
                                <li><label><input type="checkbox" style="opacity:1;" <?= ($r['checked'] == 1) ? 'checked' : '';?>/> <span class="req-name"><?= $r['name'];?></span></label></li>
                            <?php endforeach ?>
                        </ul>
                   </div>
                   
                   <div class="modal-footer">
                        <button type="button" class="btn btn-info btn-sm" id="saveRequirement" >Okay</button>
                        <button type="button" class="btn btn-info btn-sm" id="editCancel" data-dismiss="modal">Cancel</button>
                   </div>
              </div>
         </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/chosen.jquery.min.js" type="text/javascript"></script>
    <script src="js/prism.js" type="text/javascript" charset="utf-8"></script>

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
          var me      = this;
          var save    = $("#add-announcement");
          var logout  = $(".logout");
          var activate    = $(".activate");
          var config      = {' .chosen-select' : {}};
          var prepare     = $("#prepareSms");
          var recipients  = $("#recipients");
          var checkAll    = $("#checkAll");
          var sendSms     = $("#saveSms");
          var approve = $(".approve");
          var deleteEvent = $(".delete");

          deleteEvent.on("click", function(e){
            var me = $(this);
            var target = me.parents("tr");
            var id = target.data("id");

            $.ajax({
              url   : "backend/process.php",
              data  : {deleteSpecificEvent:true,id:id},
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
                target.remove();
              },
              error   : function(){
                console.log("err");
              }
            });

            e.preventDefault();
          });

          approve.on("click", function(e){
            e.preventDefault();
            var me = $(this);
            var id = me.parents("tr").data("id");
            var status = 0;
            var message = "The event "+ me.data("title") +" is now approved by the system.";
            if(me.html()=="Disapprove"){
              message = "The event "+ me.data("title") +" is now set to disapproved by the system.";
            } else {
              status = 1;
            }
              me.html((status == 1) ? "Disapprove" : "Approve");

            $.ajax({
              url  : "backend/process.php",
              data  : {approveEvent:true,id:id, status:status,contact_number: me.data("contact"), message:message},
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
                console.log(response);
              },
              error   : function(){
                console.log("err");
              }
            });
          });

          sendSms.on("click", function(e){
            var selected  = $(".chosen-select").val();
            var message   = $("#message").val();

            $("#sendSms").modal("hide");
            
            $.ajax({
              url   : "backend/process.php",
              data  : {sendSms : true, recipients : selected, message : message},
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
              },
              error     : function(){
                console.log("err");
              }
            });
            console.log(selected);
            e.preventDefault();
          });

          checkAll.on("click", function(e){
            var checked = checkAll.is(":checked");
            var target  = $("input[name='smsId']");

            if(checked == true){
              target.prop("checked", true); 
            } else {
              target.removeAttr("checked");
            }
          });

          prepare.on("click", function(e){
            var ids = $("input[name='smsId']:checked");

            recipients.find("option:selected").removeAttr("selected");

            ids.each(function(){
              recipients.find("option[data-id='"+ $(this).val() +"']").attr("selected", "selected").trigger('chosen:updated');;
            });

            for (var selector in config) {
              $(selector).chosen(config[selector]);
            }

            $(".chosen-container").css("width", "100%");
            $("#sendSms").modal("show");

            e.preventDefault();
          });



          $("#saveMyRequirement").on("click", function(e){
              e.preventDefault();
               var id     = $(this).data("id");
              var req     = $(this).data("req");
              var data    = Array();
              var orientation = false;
              var active      = $(this).data("active");

              $(active).each(function(){
                  var check = $(this).find("input[type='checkbox']").is(":checked");
                  var req = $(this).find(".req-name").html();
                  if(check == true){
                      data.push(req);
                  }
              });

              if($(active).length == data.length){
                  orientation = true;
              }


              if(data.length > 0){
                  $.ajax({
                      url     : "backend/process.php",
                      data    : {updateMyRequirements:true, data:data, id:id, orientation : orientation},
                      type    : 'POST',
                      dataType    : 'JSON',
                      success     : function(response){
                          $("#editMyCancel").trigger("click");
                      },
                      error   : function(){
                          console.log("err");
                      }
                  });
              }
          });

          $(".update-this-user").on("click", function(e){
              e.preventDefault();
              var id      = $(this).data("id");
              var req     = ""+$(this).data("req")+"";
              var type    = $(this).data("membership");
              var found   = req.indexOf(",");
              var active  = null;
              var activeTxt = "";

              if(type == "Residential"){
                  $("#my-commercial-requirements").addClass("hidden");
                  $("#my-residential-requirements").removeClass("hidden");

                  active = $("#residential-requirement-edit li");
                  activeTxt = "#residential-requirement-edit li";
              } else {
                  $("#my-commercial-requirements").removeClass("hidden");
                  $("#my-residential-requirements").addClass("hidden");

                  active = $("#commercial-requirement-edit li");
                  activeTxt = "#commercial-requirement-edit li";
              }

              var counter  = 0;

              if( found> -1){
                  var data = req.split(",");

                  active.each(function(){
                      var check = $(this).find("input[type='checkbox']");
                      var req = $(this).find(".req-name").html();

                      if(data.indexOf(req) > -1){
                          check.attr("checked", "checked");
                          counter++;
                      } else {
                          check.removeAttr("checked");
                      }
                  });    
              } else {
                  active.each(function(){
                      var check = $(this).find("input[type='checkbox']");

                          check.removeAttr("checked");
                  }); 
              }

              if(counter == active.length){
                  $("#complete").removeClass("hidden");
                  $("#complete").attr("data-id", id);
              } else {
                  $("#complete").addClass("hidden");
                  $("#complete").attr("data-id", "null");
              }

              $("#saveMyRequirement").attr("data-active", activeTxt);
              $("#saveMyRequirement").attr("data-id", id);
              $("#saveMyRequirement").attr("data-req", req);
              $("#updateRequirement").modal("show");
          });

          $("#saveRequirement").on("click", function(){
              var data = Array();

              $("#residential-requirement li").each(function(){
                  var check = $(this).find("input[type='checkbox']").is(":checked");
                  var req = $(this).find(".req-name").html();
                  check = (check == true) ? 1 : 0;

                  data.push(Array(check, req, "residential"));
              });

               $("#commercial-requirement li").each(function(){
                  var check = $(this).find("input[type='checkbox']").is(":checked");
                  var req = $(this).find(".req-name").html();
                  check = (check == true) ? 1 : 0;

                  data.push(Array(check, req, "commercial"));
              });

              if(data.length > 0){
                  $.ajax({
                      url     : "backend/process.php",
                      data    : {updateRequirements:true, data:data},
                      type    : 'POST',
                      dataType    : 'JSON',
                      success     : function(response){
                          console.log(response);
                          $("#addRequirements").modal("hide");
                      },
                      error   : function(){
                          console.log("err");
                      }
                  });
              }
          });

          $("#complete").on("click", function(e){
              var id = $(this).data("id");
                $.ajax({
                      url     : "backend/process.php",
                      data    : {completeRequirement:true, id:id},
                      type    : 'POST',
                      dataType    : 'JSON',
                      success     : function(response){
                          console.log(response);
                          $("#addRequirements").modal("hide");
                      },
                      error   : function(){
                          console.log("err");
                      }
                  });
              e.preventDefault();
          });

          $("#addNewRequirement").on("click", function(){
              var name = $("#newRequirement").val();
              var tpl  = $("#req-tpl").html();
              var type = $("input[name='membership_type']:checked").val();

              if(name.length == 0){
                  alert("Enter a requirement name first.");
                  return false;
              }
              
              tpl = tpl.replace("[NAME]", name);

              if(type == "residential"){
                  $("#residential-requirement").append(tpl);
              } else {
                  $("#commercial-requirement").append(tpl);
              }
          });

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
