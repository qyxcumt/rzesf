<?php
	require_once 'sqlmanager.php';
	require_once 'defines.php';
	
	class notification{
		static function getNotification(){
			global $NotificationTable;
			$db=new SQL_conn();
			$st=$db->getTableSortbyTime($NotificationTable);
			return $st;
		}
		
		static function getNotificationbyID($id){
			global $NotificationTable;
			$db=new SQL_conn();
			$st=$db->getRecord($NotificationTable, "id", $id);
			return $st;
		}
		
		static function getNotificationCount(){
			global $NotificationTable;
			$db=new SQL_conn();
			$st=$db->getTableCount($NotificationTable);
			return $st[0][0];
		}
		
		static function getNotificationLimit($start,$count){
			global $NotificationTable;
			$db=new SQL_conn();
			$st=$db->getTableLimit($NotificationTable, $start, $count);
			return $st;
		}
	}
?>