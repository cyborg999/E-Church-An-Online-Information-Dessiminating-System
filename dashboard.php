<?php include_once "d-top.php"; ?>
      <br>
      <br>
      <br>
        <?php
          $profile = $model->getProfile();
        ?>
      <div class="row">

        <div class="col-sm-2 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <a href="edit_user.php?id=<?= $_SESSION['user']['id'];?>">
              <img width="100%" src="<?= isset($profile['photo']) ? $profile['photo'] : 'img/user.png';?>">
            </a>
            <br>
            <br>
            <label class="gender"><?= (isset($profile['firstname']) ? $profile['firstname'] : "")." ". (isset($profile['middlename']) ? $profile['middlename'] :"")." ".(isset($profile['lastname']) ? $profile['lastname'] :"");?> </label>
            <p><?= isset($profile['address']) ? $profile['address'] : ""?></p>
            <p><span class="glyphicon glyphicon-phone"></span> <span style=""><?= isset($profile['contact_number']) ? $profile['contact_number'] : "";?></span></p>
            <?php $msgCount = $model->getMessagesCount();?>
           <!--  <p style="<?= ($msgCount > 0) ? 'color:red;':'' ;?>"  id="viewMsg" >
              <span class="glyphicon glyphicon-envelope" ></span>
              messages(<span id="allCount"><?= $msgCount;?></span>)
            </p> -->
          </div>
        </div><!-- /.blog-sidebar -->

        <div class="col-sm-8 col-sm-offset-1 hidden blog-main">
            <form id="sendMsg" style="background: rgba(241, 241, 241, 0.5); border-radius: 5px; padding: 35px;">
              <div class="form-group">
                <label>Title:
                </label>
                  <input type="text"  class="form-control" placeholder="title..." id="title" required/>
              </div>
              <div class="form-group">
                <label>Recipient:
                </label>
              <?php $userList = $model->getAllRecipients();
              ?>
                <select required id="recipients" data-placeholder="Recipients"  multiple class="chosen-select form-control">
                  <option value=""></option>
                  <?php foreach($userList as $idx => $u): ?>
                    <option data-id="<?= $u['id'];?>" value="<?= $u['id'];?>"><?= $u['username'];?></option>
                  <?php endforeach ?>                          
                </select>
              </div>
              <div class="form-group">
                <label>Message:
                </label>
                  <textarea class="form-control" id="message" required></textarea>
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-md btn-success" value="Send Message"/>
              </div>
            </form>
            <br>
            <table class="table table-hovered" id="allMessages">
            
            </table>

        </div><!-- /.blog-main -->
      </div><!-- /.row -->
    </div><!-- /.container -->
    <script type="text/html" id="tpl">
      <tr>
        <td>
          <h5>title: <b>[TITLE]</b></h5>
          <p>from:<i>[FROM]</i></p>
          <blockquote>
            [MESSAGE]
          </blockquote>
          <hr>
        </td>
      </tr>
    </script>
<?php include_once "d-bottom.php"; ?>
