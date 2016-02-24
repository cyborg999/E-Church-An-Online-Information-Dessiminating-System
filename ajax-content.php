<?php
  include_once "backend/process.php";

  $nature = $model->getNatureById($_GET['id']);
?>
<div class="col-sm-8 col-sm-offset-1 blog-main">
  <div class="blog-post">
    <h2 class="blog-post-title"><?= $nature['name']?></h2>
    <br>
    <p class="blog-post-meta">Requirements:</p>
    <?php $req = explode(",", $nature['requirements']); ?>
    <ol>
      <?php foreach($req as $idx => $r): ?>
        <?php if($r != ""):?>
          <li><?= $r;?></li>
        <?php endif ?>
      <?php endforeach ?>
    </ol>
  </div>
</div>