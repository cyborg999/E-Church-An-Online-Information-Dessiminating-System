<?php include_once "top.php"; ?>
    <br>  
    <br>  
    <br>  
    <br>  
    <br>  
    <br>  
    <br>  
    <?php $services = $model->getAllServices(); ?>
    <div class="row all-services w0">
      <?php foreach($services as $s){ ?>
      <div class="col-sm-3 grid-item" style="font-size:12px;">
         <div class="thumbnail">
          <?php $preview = $model->getPreviewByServiceId($s['id']); 
          ?>
          <img src="<?= $preview[0]['filename'];?>" alt="...">
          <div class="caption">
            <h3><?= $s['title'];?></h3>
            <p style="max-height:200px;overflow:hidden;"><?= $s['description'];?></p>
            <a href="" data-toggle="modal" data-id="<?= $s['id'];?>" class="previewServiceIframe" data-target="#servicePreview">see more</a>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
    </div><!-- /.container -->
      <div class="modal fade" id="servicePreview">
         <div class="modal-dialog">
              <div class="modal-content">
                   <div class="modal-header" style="border:0px;">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                   </div>
                   <div class="modal-body">
                    <iframe id="previewFrame" src="" style="width:100%;height:700px;" frameborder="0"></iframe>
                   </div>
              </div>
         </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/masonry.js"></script>
    <script type="text/javascript">
      (function($){
        var Page = {
          __init : function(){

            this.__listen();

            $(".w0").removeClass("w0");
            $('.all-services').masonry({
              itemSelector: '.grid-item'
            });
          },
          __listen : function(){
            $(".previewServiceIframe").on("click", function(){
              var id = $(this).data("id");
              $("#previewFrame").attr("src", "preview_service.php?id="+id);
            });

            $(".getContent").on("click", function(e){
              var id = $(this).data("id");
              var target = $(".blog-main");

              target.html("");

              $.ajax({
                url   : "ajax-content.php?id="+id,
                type  : 'GET',
                dataType  :"html",
                success   : function(response){
                  target.html(response);
                },
                error     : function(){
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
