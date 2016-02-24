<?php include_once "d-top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">Update Service</h1>
      </div>
      <div class="row">
        <div class="col-sm-12 blog-main">
          <?php $service = $model->getServiceById($_GET['id']);
            $requirements = $model->getRequirementsByServiceId($_GET['id']);
          ?>
          <table class="table" id="editService" data-id="<?= $_GET['id'];?>">
            <tbody>
              <tr>
                <td>
                  <label class="label">Title</label>
                </td>
                <td>
                  <input type="text" id="title" value="<?= $service['title'];?>" placeholder="title..." class="form-control"/>
                </td>
              </tr>
               <tr>
                <td>
                  <label  class="label">Description</label>
                </td>
                <td>
                  <textarea class="form-control" style="min-height:200px;" placeholder="description..." id="description"><?= $service['description'];?></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label  class="label">Requirements</label>
                </td>
                <td>
                  <input class="form-control pull-left" id="newRequirement"  style="width:500px;" placeholder="Type New Requirement here.."/>
                  <a href="" style="margin-left:10px;" id="addRequirement" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-plus"></span></a>
                  <br>
                  <br>
                  <ul id="requirement" class="clearfix">
                    <?php foreach($requirements as $idx => $req) { ?>
                      <li><i><?= $req['title']; ?></i><a class='remove-requirement'><span class='glyphicon glyphicon-remove'></span></a></li>
                      <?php }?>
                  </ul>
                </td>
              </tr>
              <tr>
                <td>
                  <label  class="label">Preview</label>
                </td>
                <td> 
                    <?php $images = $model->getPreviewByServiceId($_GET['id']); 
                    ?>
                    <?php foreach($images as $img){ ?>

                    <div class='img-container' style="width:200px;margin:5px 0px 5px;position:relative;min-height:50px;float:left;">
                        <a href=""class="remove-preview" data-id="<?= $img['id'];?>" style="position:absolute;top:10px;right:10px;">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                        <img width="200" src="<?= $img['filename'];?>">
                    </div>
                    <?php  } ?>
                    <div class="clearfix">
                    </div>
                  <!-- The fileinput-button span is used to style the file input field as button -->
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Add files...</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="files[]" multiple>
                    </span>
                    <br>
                    <br>
                    <!-- The global progress bar -->
                    <div id="progress" class="progress">
                        <div class="progress-bar progress-bar-success"></div>
                    </div>
                    <!-- The container for the uploaded files -->
                    <div id="files" class="files"></div>
                </td>
              </tr>
              <tr>
                <td></td>
                <td>
                  <input type="submit" id="saveService" class="pull-right btn-lg btn btn-success" value="update">
                </td>
              </tr>
            </tbody>
          </table>
        </div><!-- /.blog-main -->
      </div><!-- /.row -->
    </div><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.js"></script>
<script src="js/jquery.ui.widget.js"></script>
<script src="js/load-image.all.min.js"></script>
<script src="js/canvas-to-blob.min.js"></script>
<script src="js/jquery.iframe-transport.js"></script>
<script src="js/jquery.fileupload.js"></script>
<script src="js/jquery.fileupload-process.js"></script>
<script src="js/jquery.fileupload-image.js"></script>

    <script type="text/javascript">
    (function($){
      var Page = {
        __init : function(){
          this.__listen();
          this.__defaultListener();
          this.__uploader();
        },
        __uploader : function(){
            var url =  'server/php/',
                uploadButton = $('<button/>')
                    .addClass('btn btn-primary')
                    .prop('disabled', true)
                    .text('Processing...')
                    .on('click', function () {
                        var $this = $(this),
                            data = $this.data();
                        $this
                            .off('click')
                            .text('Abort')
                            .on('click', function () {
                                $this.remove();
                                data.abort();
                            });
                        data.submit().always(function () {
                            $this.remove();
                        });
                    });
            $('#fileupload').fileupload({
                url: url,
                dataType: 'json',
                autoUpload: false,
                acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                maxFileSize: 999000,
                // Enable image resizing, except for Android and Opera,
                // which actually support image resizing, but fail to
                // send Blob objects via XHR requests:
                disableImageResize: /Android(?!.*Chrome)|Opera/
                    .test(window.navigator.userAgent),
                previewMaxWidth: 100,
                previewMaxHeight: 100,
                previewCrop: true
            }).on('fileuploadadd', function (e, data) {
                data.context = $('<div/>').appendTo('#files');
                $.each(data.files, function (index, file) {
                    var node = $('<p/>')
                            .append($('<span/>').text(file.name));
                    if (!index) {
                        node
                            .append('<br>')
                            .append(uploadButton.clone(true).data(data));
                    }
                    node.appendTo(data.context);
                });
            }).on('fileuploadprocessalways', function (e, data) {
                var index = data.index,
                    file = data.files[index],
                    node = $(data.context.children()[index]);
                if (file.preview) {
                    node
                        .prepend('<br>')
                        .prepend(file.preview);
                }
                if (file.error) {
                    node
                        .append('<br>')
                        .append($('<span class="text-danger"/>').text(file.error));
                }
                if (index + 1 === data.files.length) {
                    data.context.find('button')
                        .text('Upload')
                        .prop('disabled', !!data.files.error);
                }
            }).on('fileuploadprogressall', function (e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }).on('fileuploaddone', function (e, data) {
                $.each(data.result.files, function (index, file) {
                    if (file.url) {
                        var link = $('<a>')
                            .attr('target', '_blank')
                            .prop('href', file.url);
                        $(data.context.children()[index])
                            .wrap(link);

                        //add to files here
                        $.ajax({
                            url     : "backend/process.php",
                            data    : {uploadImage:true,link:file.url,id:$("#editService").data("id")},
                            type    : "POST",
                            dataType    : "JSON",
                            success     : function(response){
                                console.log(response);
                                $("#saveService").removeClass("hidden");
                            },
                            error       : function(){
                                console.log("err");
                            }
                        });

                    } else if (file.error) {
                        var error = $('<span class="text-danger"/>').text(file.error);
                        $(data.context.children()[index])
                            .append('<br>')
                            .append(error);
                    }
                });
            }).on('fileuploadfail', function (e, data) {
                $.each(data.files, function (index) {
                    var error = $('<span class="text-danger"/>').text('File upload failed.');
                    $(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                });
            }).prop('disabled', !$.support.fileInput)
                .parent().addClass($.support.fileInput ? undefined : 'disabled');
        },
        __defaultListener : function(){
          $(".remove-requirement").off().on("click", function(e){
            e.preventDefault();

            $(this).parents("li").remove();
          });
        },
        __error : function(error){
            $("#errors").html("");
            for(var i in error){
              $("#errors").append("<li>"+error[i]+"</li>");
            }
        },
        __listen : function(){
          var me = this;

            $(".remove-preview").on("click", function(e){
                e.preventDefault();
                var target = $(this);
                var id = target.data("id");

                $.ajax({
                    url     : "backend/process.php",
                    data    : {removePreview:true, id:id},
                    type    : 'POST',
                    dataType    : 'JSON',
                    success     : function(response){
                        console.log(response);

                        target.parents(".img-container").remove();
                    },
                    error       : function(){
                        console.log("err");
                    }
                });
            });

           $('#fileupload').fileupload({
                dataType: 'json',
                done: function (e, data) {
                    $.each(data.result.files, function (index, file) {
                        $('<p/>').text(file.name).appendTo(document.body);
                    });
                }
            });
           
          $("#addRequirement").on("click", function(e){
            var newRequirement = $("#newRequirement").val();
            var target = $("#requirement");
            
            if(newRequirement.trim().length == 0){
              return false;
            }

            target.append("<li><i>"+newRequirement+" </i><a class='remove-requirement'><span class='glyphicon glyphicon-remove'></span></a></li>");
            me.__defaultListener();
            
            $("#newRequirement").val("");
            
            e.preventDefault();
          });

          $("#saveService").on("click", function(e){
            e.preventDefault();
            var id = $("#editService").data("id");
            var title = $("#title").val();
            var desc = $("#description").val();
            var req = Array();
            var ul = $("#requirement li");
            
            for(var i =0;i< ul.length;i++){
              var li = ul.eq(i).find("i").html();

              req.push(li);
            }

            $.ajax({
              url   : "backend/process.php",
              data  : {updateService:true,id:id,title:title,description:desc,requirement:req},
              type  : 'POST',
              dataType : 'JSON',
              success   : function(response){
                console.log(response);
                alert("Record is sucesfully updated.");
              },
              error   : function(){
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
