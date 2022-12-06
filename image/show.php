<?php
$path = $_GET['image'];
if($path){
	$path = "uploads/$path";
	if(file_exists($path)){
		$info = getimagesize($path);
		$geshi = $info['mime'];
		$im = file_get_contents($path);
		header("Content-type: {$geshi}");
		echo($im);
	}else{
		header("Content-type: image/png");
		echo(file_get_contents("uploads/default_image.png"));
	}
}else{
	exit(0);
}