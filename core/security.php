<?php
class security{
	static function checkUserPrivilege(){
		if(isset($_SESSION['user'])&&$_SESSION['privilege']==1)
			return true;
		return false;
	}
	
	static function checkzgUserPrivilege(){
		if(isset($_SESSION['user'])&&$_SESSION['privilege']==2)
			return true;
			return false;
	}
	
	static function checkAdminPrivilege(){
		if(isset($_SESSION['user'])&&$_SESSION['privilege']==0)
			return true;
			return false;
	}
	
	static function checkLogin(){
		if(empty($_SESSION['user']))
			return false;
		return true;
	}
	
	static function checkzgLogin(){
		if(empty($_SESSION['zguser']))
			return false;
		return true;
	}
	
	static function noLoginReLocation(){
		echo  "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
		echo "<script>top.location.href='/';</script>";
		exit();
	}
}
?>