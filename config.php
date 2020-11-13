<?php
	mysqli_connect("localhost", "root", "", "ketosin2020");
	// mysqli_select_db("ketosin2020");

	$type = array('jpg','png','gif','jpeg','JPG','PNG','GIF','JPEG');

	define("BASEURL", "http://". $_SERVER['HTTP_HOST']."/". basename(__DIR__)."/");
?>