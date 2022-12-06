<?php
echo '<hr><a href="upload.php" width=100% style="text-decoration: none;color: black;text-align:center;display:block;">>> upload_file <<</a><hr>';
/*
// 获取当前文件的上级目录
$con = dirname(__FILE__);
// 扫描$con目录下的所有文件
$filename = scandir($con);
// 定义一个数组接收文件名
$needfile = array('images.php','upload.php','smalls','.','..');
*/
$filename = scandir("cache");
unset($filename[0]);
unset($filename[1]);
foreach($filename as $key=>$value){
	echo '<a href="show.php?image='.$value.'"" style="width:20%;height:22%;margin:0 auto;display:block;float:left;"><img src="cache/'.$value.'" style="width:100%;height:100%;"></a>';
}
