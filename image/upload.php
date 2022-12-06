<?php
header("Content-Type: text/html; charset=UTF-8");
echo '<hr><a href="images.php" width=100% style="text-decoration: none;color: black;text-align:center;display:block">>> image_file <<</a><hr>';
echo'
<form action="upload.php" enctype="multipart/form-data" method="post" >
    请选择上传文件：
	<input type="file" name="file">
    <input type="submit">
</form>';
if($_SERVER['REQUEST_METHOD']=="POST"){
	@uploadFileControl();
}
function uploadFileControl(){
	$shangchuan = $_FILES['file'];
	if(substr($shangchuan['name'],0,8) == 'QQ截图'){
		$shangchuan['name'] = str_replace('QQ截图','qqscr-',$shangchuan['name']);
	}else{
		$shangchuan['name'] = "image-".date(YmdHisz).".png";
	}
	if(move_uploaded_file($shangchuan['tmp_name'],"uploads/".$shangchuan['name'])){echo '上传成功';}else{echo '上传失败';}
	//$thepng = imagecreatefrompng("uploads/".$shangchuan['name']);
	//imagejpeg($thepng,'smalls/'.$shangchuan['name'],9);
	imagedestroy($thepng);
	include_once 'setting.php';
	setImageControl("uploads/".$shangchuan['name']);
}