    <?php include_once "top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">News</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-3 blog-main">
          <!-- other content goes here -->
            <?php $announcement = new Model(); $announcement = $announcement->getAllAnnouncement(); ?>
            <ul id="news">
            <?php foreach($announcement as $idx => $a): ?>
              <li>
                <a class="getNews" data-toggle="modal" data-target="#newsPreview" href="news.php?id=<?= $a['id']; ?>"><?= $a['title']?></a>
                <p class="verdana" style="display:block;height:30px;overflow:hidden;"><?= $a['description']?></p>
              </li>
              <?php endforeach ?>
            </ul>
        </div><!-- /.blog-main -->
        <div class="col-sm-9" style="border-left:1px solid silver;">
          <iframe src="" frameborder="0" style="width:100%;min-height:400px;"></iframe>
        </div>
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
            var news = $("#news");
            var getNews = $(".getNews");
            var iframe = $("iframe").first();

            getNews.on("click", function(e){
              var href = $(this).attr("href");

              iframe.attr("src", href);
              e.preventDefault();
            });

            if(news.find("li").length > 0){
              var href = news.find("li a").first().attr("href");

              iframe.attr("src", href);
            }
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
