<?php
//strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 9.0")||strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 8.0")||strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 7.0")||
if (strpos($_SERVER["HTTP_USER_AGENT"],"MSIE 6.0")){
		echo  "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
		echo "<script>alert('您的浏览器内核过于老旧，无法正常访问本站，请更换其他浏览器！');top.location.href='/bgonly.php';</script>";
    exit();
}

?>