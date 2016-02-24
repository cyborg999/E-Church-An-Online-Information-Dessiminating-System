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
          var me = this;
          var config      = {' .chosen-select' : {}};
          var sendMsg   = $("#sendMsg");
          var viewMsg   = $("#viewMsg");

          viewMsg.on("click", function(){

            $(this).removeAttr("style");
            $(this).find("#allCount").html(0);

            $.ajax({
              url   : "backend/process.php",
              data  : {viewMsg:true},
              type  : 'POST',
              dataType  : 'JSON',
              success   : function(response){
                var target = $("#allMessages");
                for(var i in response){
                  // console.log(response[i].title);
                  var tpl = $("#tpl").html();

                  tpl = tpl.replace("[TITLE]",response[i].title).
                    replace("[FROM]", response[i].sender).
                    replace("[MESSAGE]", response[i].message);

                    target.append(tpl);
                }
              },
              error     : function(){
                console.log("err");
              }
            });

          });

          for (var selector in config) {
              $(selector).chosen(config[selector]);
          }

          $(".chosen-container").css("width", "100%");

          sendMsg.on("submit", function(e){
            var selected  = $(".chosen-select").val();
            var message   = $("#message").val();
            var title     = $("#title").val();

            $.ajax({
              url   : "backend/process.php",
              data  : {sendMsg : true, recipients : selected, message : message, title:title},
              type  : "POST",
              dataType  : "JSON",
              success   : function(response){
                console.log(response);
                alert("Message Sent!");
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
