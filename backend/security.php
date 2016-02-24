<?php
	session_start();
	if(! isset($_SESSION['user'])){
		Header("Location:index.php");
	} 