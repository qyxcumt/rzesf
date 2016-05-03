<?php
require_once 'sqlmanager.php';
require_once 'defines.php';

class notification{
	static function getRule(){
		global $RuleTable;
		$db=new SQL_conn();
		$st=$db->getTable($RuleTable);
		return $st;
	}

	static function getRulebyID($id){
		global $RuleTable;
		$db=new SQL_conn();
		$st=$db->getRecord($RuleTable, "id", $id);
		return $st;
	}
}
?>