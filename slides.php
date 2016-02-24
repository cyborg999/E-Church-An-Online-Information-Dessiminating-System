    <?php include_once "d-top.php"; ?>
      <div class="blog-header">
        <h1 class="blog-title">Add Slideshow</h1>
        <!-- <p class="lead blog-description">The official example template of creating a blog with Bootstrap.</p> -->
      </div>

      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6 blog-main">
          <!-- other content goes here -->
          <form id="upload" action="upload.php" method="POST" enctype="multipart/form-data">
              <fieldset>
                  <input type="hidden" id="MAX_FILE_SIZE" />
                  <div>
                      <label for="fileselect" class="gender">Files to upload:</label>
                      <input type="file" id="fileselect" name="fileselect[]" multiple="multiple" />
                      <div id="filedrag">or drop files here</div>
                  </div>
                  <div id="submitbutton">
                      <button class="btn btn-lg btn-success" type="submit">Upload Files</button>
                  </div>
              </fieldset>
          </form>
          <div id="messages">
              <p>Status Messages</p>
          </div>
          <button class="btn btn-save btn-lg btn-success" id="saveSlides">Save</button>
          <ul id="errors"></ul>
        </div><!-- /.blog-main -->
        <div class="col-sm-3"></div>
      </div><!-- /.row -->
    </div><!-- /.container -->
    <script type="text/html" id="slide">
        <div class="row add-slide">
            <div class="columns col-lg-12">
                <a href="" class="close remove-slide">x</a>
                <img class="cover" src="uploads/[FILENAME]" />
                <br>
                <label class="label">Slide Title:
                    <input type="text" class="form-control title" placeholder="Slide Title..."/>
                </label>
                <br>
                <label class="label">Slide Description:
                    <textarea class="form-control desc" placeholder="Slide Description..."></textarea>
                </label>
            </div>
        </div>
    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script> <!-- jQuery Library -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    (function($){
      function $id(id) {
            return document.getElementById(id);
        }


        // output information
        function Output(msg) {
            var m = $id("messages");
            m.innerHTML = msg + m.innerHTML;
        }


        // file drag hover
        function FileDragHover(e) {
            e.stopPropagation();
            e.preventDefault();
            e.target.className = (e.type == "dragover" ? "hover" : "");
        }


        // file selection
        function FileSelectHandler(e) {

            // cancel event and hover styling
            FileDragHover(e);

            // fetch FileList object
            var files = e.target.files || e.dataTransfer.files;

            // process all File objects
            for (var i = 0, f; f = files[i]; i++) {
                ParseFile(f);
                // UploadFile(f);
            }

        }


        // output file information
        function ParseFile(file) {
            var found   = false;

            // display an image
            if (file.type.indexOf("image") == 0) {
                found = true;
            }

            if(found != true){
                console.log("Invalid File Format");
                console.log(file);
            } else {
                UploadFile(file);
            }
        }


        function UploadFile(file) {

            var xhr = new XMLHttpRequest();
            if (xhr.upload ) {

                // // create progress bar
                // var o = $id("progress");
                // var progress = o.appendChild(document.createElement("p"));
                // progress.appendChild(document.createTextNode("upload " + file.name));


                // // progress bar
                // xhr.upload.addEventListener("progress", function(e) {
                //     var pc = parseInt(100 - (e.loaded / e.total * 100));
                //     progress.style.backgroundPosition = pc + "% 0";
                // }, false);

                // file received/failed
                xhr.onreadystatechange = function(e) {
                    if (xhr.readyState == 4) {
                        var reader = new FileReader();
                        var slide   = $("#slide").html();

                        reader.onload = function(e) {
                            slide = slide.replace("[FILENAME]", file.name);
                            Output(slide);
                        }

                        reader.readAsDataURL(file);

                //         progress.className = (xhr.status == 200 ? "success" : "failure");
                    }
                };
                // start upload
                xhr.open("POST", $id("upload").action, true);
                xhr.setRequestHeader("X-FILENAME", file.name);
                xhr.send(file);

            }

        }


        // initialize
        function Init() {

            var fileselect = $id("fileselect"),
                filedrag = $id("filedrag"),
                submitbutton = $id("submitbutton");

            // file select
            fileselect.addEventListener("change", FileSelectHandler, false);
            // is XHR2 available?
            var xhr = new XMLHttpRequest();
            if (xhr.upload) {   
                // file drop
                filedrag.addEventListener("dragover", FileDragHover, false);
                filedrag.addEventListener("dragleave", FileDragHover, false);
                filedrag.addEventListener("drop", FileSelectHandler, false);
                filedrag.style.display = "block";

                // remove submit button
                submitbutton.style.display = "none";
            }

        }

        // call initialization file
        if (window.File && window.FileList && window.FileReader) {
            Init();
        }
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
          var save = $("#saveSlides");

          save.on("click", function(){
              var slides = Array();

              $(".add-slide").each(function(){
                  var me      = $(this);
                  var title   = me.find(".title").val();
                  var desc    = me.find(".desc").val();
                  var cover   = me.find(".cover").attr("src");

                  slides.push(Array(cover,title,desc));
              });

              if(slides.length > 0){
                  $.ajax({
                      url     : "backend/process.php",
                      data    : {addSlide : true, slides:slides},
                      type    : 'POST',
                      dataType    : 'JSON',
                      success     : function(response){
                          console.log(response);
                          alert("Slideshow is succesfully saved.");

                      },
                      error       : function(){
                          console.log("err");
                      }
                  });
              }
          });
        }
      }

      Page.__init();
    })(jQuery);
    </script>
  </body>
</html>
