<?php
session_start();
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
}
?>