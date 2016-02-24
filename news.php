<link rel="stylesheet" type="text/css" href="css/style.css">
<?php if(isset($_GET['id'])): ?>
	<?php
	  include_once "backend/process.php";

	  $news = $model->getAnnouncementById($_GET['id']);
	?>
	<?php foreach($news as $idx => $a): ?>
		<div class="blog-post">
		<h2 class="verdana blog-post-title"> <?= $a['title']?></h2>
		<p class="verdana blog-post-meta"><?= $a['dateadded']?> by <a href="#"><?= $a['username']?></a></p>
		<p class="verdana"><?= $a['description']?></p>
		</div><!-- /.blog-post -->
	<?php endforeach ?>
<?php endif ?>