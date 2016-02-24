      <div class="row banner">
        <div id="myCarousel"  class="carousel slide" style="height:100%;">
          <?php  $slideshow = $model->getSlideshows(); ?>
          <ol class="carousel-indicators">
              <?php foreach($slideshow as $idx => $slide): ?>
              <li data-target="#myCarousel" data-slide-to="<?= $idx; ?>" class="<?= ($idx == 0) ? 'active' :''; ?>"></li>
              <?php endforeach ?>
          </ol>
          <div class="carousel-inner" style="height:100%;">
              <?php foreach($slideshow as $idx => $slide): ?>
                  <div class="item  <?= ($idx == 0) ? 'active':'' ;?>" style="height:100%;">
                      <div class="slide" style="height:100%;">
                          <img style="width:100%;height:100%;" src="<?= $slide['cover'];?>">
                      </div>
                      <div class="carousel-caption">
                          <h1 style="color:white;"><?= $slide['title']; ?></h1>
                          <p><?= $slide['desc']; ?></p>
                          <a href="registration.php" class="btn">Sign Up Now</a>
                      </div>
                  </div>
              <?php endforeach ?>
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="icon-prev"></span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="icon-next"></span>
              </a>
            </div>
        </div>
      </div>

      <!-- Start Services -->
      <?php $services = $model->getAllServices(); ?>
      <div class="row grid">
        <?php foreach($services as $s){ ?>
            <div class="grid-item">
              <div class="info hidden">
                <h5><?= $s['title'];?></h5>
                <p><?= $s['description'];?></p>
                <a href="" data-toggle="modal" data-id="<?= $s['id'];?>" class="btn previewServiceIframe" data-target="#servicePreview">View</a>
              </div>
              <?php $preview = $model->getPreviewByServiceId($s['id']); ?>
              <img src="<?= $preview[0]['filename'];?>" alt="...">
            </div>
        <?php } ?>
      </div>
      <!-- End Services -->

      <?php $setting = $model->getSetting(); ?>
      <!-- Start About -->
      <div class="row about">
        <div class="col-sm-12">
          <br>
          <br>
          <br>
          <h3>About eChurch</h3>
          <br>
          <p><?= $setting['about'];?></p>
          <p><?= $setting['slogan'];?></p>
          <br>
          <br>
          <br>
          <a href="services.php" class="btn">View Services</a>
        </div>
      </div>
      <!-- End About -->

      <!-- Start Footer -->
      <div class="row footer">
        <div class="col-sm-12">
          <ul>
            <li><a href=""><span class="glyphicon glyphicon-envelope"></span> <?= $setting['email'];?></a></li>
            <li><a href=""><span class="glyphicon glyphicon-phone-alt"></span> <?= $setting['phone'];?></a></li>
            <li><a href=""><span class="glyphicon glyphicon-phone"></span> <?= $setting['mobile'];?></a></li>
          </ul>
        </div>
      </div>
      <!-- End Footer -->
      
      <!-- Modals -->
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
        <div class="modal fade" id="newsPreview">
           <div class="modal-dialog">
                <div class="modal-content">
                     <div class="modal-header" style="border:0px;">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                     </div>
                     <div class="modal-body ">
                     </div>
                </div>
           </div>
        </div>
      <!-- End Modal -->