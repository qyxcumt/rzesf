<?php
require_once 'defines.php';
require_once 'connclient.class.php';

class message{
	static function getMessageByUser($userid){
		global $MessageMapTable;
		global $MessageTable;
		$condition=" ID=( select ID from $MessageMapTable where user = $userid )";
		$db=new conn($MessageTable);
		$st=$db->GetDataCondition($condition);
		return $st;
	}
	
}
?>