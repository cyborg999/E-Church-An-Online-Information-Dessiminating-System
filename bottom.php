 </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script> 
    <script src="js/masonry.js"></script>

    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    (function($){
      var Page = {
        __init  : function(){
          this.__masonry();
          this.__listen();
        },
        __masonry : function(){
          $('.grid').masonry({
              itemSelector: '.grid-item'
            });
        },
        __listen : function(){
          var grid = $(".grid-item");

          $(".previewServiceIframe").on("click", function(){
              var id = $(this).data("id");
              console.log(id);
              $("#previewFrame").attr("src", "preview_service.php?id="+id);
          });

          $(".info").hide();
          grid.hover(function(){
            var me = $(this);

            me.find(".info").removeClass("hidden");
            me.find("img").stop().animate({
              "opacity" : 1
            }, function(){
              me.find(".info").stop().fadeIn("slow");
            });

          }, function(){
            $(this).find("img").stop().animate({
              "opacity" : .7
            });
              $(this).find(".info").stop().fadeOut("slow");

          });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
