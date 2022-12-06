<?php
set_time_limit(0);
function setImageZoom($imageSrc,$flag){
	//380*290
	$name = basename($imageSrc);
	$src = imagecreatefromstring(file_get_contents($imageSrc));
	if($flag[0] > $flag[1]){
		$new_width = 380;
		$new_height = round(380 / $flag[0] * $flag[1]);
	}else{
		$new_width = round(290 / $flag[1] * $flag[0]);
		$new_height = 290;
	}
	$new_image = imagecreatetruecolor($new_width,$new_height);
	imagecopyresampled($new_image,$src, 0, 0, 0, 0, $new_width, $new_height, $flag[0], $flag[1]);
	imagejpeg($new_image,'cache/'.$name);
	imagedestroy($src);
	imagedestroy($new_image);
}
function setImageSplit($imageSrc,$flag){
	$name = basename($imageSrc);
	$image_Src = imagecreatefromstring(file_get_contents($imageSrc));
	$imageSrc_info = getimagesize($imageSrc);
	if($flag == 'w'){
		$width = 1 / 2 * $imageSrc_info[0];
		$height = 2 * $imageSrc_info[1];
		$new_image = imagecreatetruecolor($width,$height);
		imagecopyresampled($new_image,$image_Src,0,0,0,0,$width,$height/2,$width,$height/2);
		imagecopyresampled($new_image,$image_Src,0,$height/2,$width,0,$width,$height/2,$width,$height/2);
	}else{
		$width = 2 * $imageSrc_info[0];
		$height = 1 / 2 * $imageSrc_info[1];
		$new_image = imagecreatetruecolor($width,$height);
		imagecopyresampled($new_image,$image_Src,0,0,0,0,$width/2,$height,$width/2,$height);
		imagecopyresampled($new_image,$image_Src,$width/2,0,0,$height,$width/2,$height,$width/2,$height);
	}
	imagejpeg($new_image,"cache/".$name);
	imagedestroy($image_Src);
	imagedestroy($new_image);
	//setImageControl("cache/".$name);
}
function setImageControl($imageSrc){
	
	$info = getimagesize($imageSrc);
	print_r($info);
	if($info[0] / $info[1] > 3){
		echo 'wwww';
		setImageSplit($imageSrc,'w');
	}elseif($info[1] / $info[0] > 3){
		echo 'hhhhh';
		setImageSplit($imageSrc,'h');
	}else{
		echo 'zzzzz';
		setImageZoom($imageSrc,$info);
	}
}

$filename = scandir("uploads");
unset($filename[0]);
unset($filename[1]);
foreach($filename as $key=>$value){
	//echo '<a href="uploads/'.$value.'"" style="width:20%;height:26%;margin: 0 auto;vertical-align: middle;display: table-cell;"><img src="cache/'.$value.'" ></a>';
	setImageControl("uploads/".$value);
}

/*

$dst = "a.png";

//得到原始图片信息
$dst_im = imagecreatefrompng($dst);
$dst_info = getimagesize($dst);

//水印图像
$src = "b.png";
$src_im = imagecreatefrompng($src);
$src_info = getimagesize($src);	


$new_image = imagecreatetruecolor($dst_info[0]+$src_info[0],$dst_info[1]+$src_info[1]);
//水印透明度
$alpha = 30;

//合并水印图片
imagecopymerge($new_image,$dst_im,0,0,0,0,$dst_info[0],$dst_info[1],100);
imagecopymerge($new_image,$src_im,$dst_info[0],$dst_info[1],0,0,$src_info[0],$src_info[1],100);
//输出合并后水印图片
imagejpeg($new_image,'c.png');
imagedestroy($dst_im);
imagedestroy($src_im);
*/