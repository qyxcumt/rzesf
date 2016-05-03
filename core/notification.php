<?php
	require_once 'sqlmanager.php';
	require_once 'defines.php';
	
	class notification{
		static function getNotification(){
			global $NotificationTable;
			$db=new SQL_conn();
			$st=$db->getTable($NotificationTable);
			return $st;
		}
		
		static function getNotificationbyID($id){
			global $NotificationTable;
			$db=new SQL_conn();
			$st=$db->getRecord($NotificationTable, "id", $id);
			return $st;
		}
	}
?>