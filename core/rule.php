<?php
require_once 'sqlmanager.php';
require_once 'defines.php';
class notification{
	static function getRule(){
		global $RuleTable;
		$db=new SQL_conn();
		$st=$db->getTableSortbyTime($RuleTable);
		return $st;
	}

	static function getRulebyID($id){
		global $RuleTable;
		$db=new SQL_conn();
		$st=$db->getRecord($RuleTable, "id", $id);
		return $st;
	}
	
	static function getRuleCount(){
		global $RuleTable;
		$db=new SQL_conn();
		$st=$db->getTableCount($RuleTable;);
		return $st[0][0];
	}
	
	static function getRuleLimit($start,$count){
		global $RuleTable;
		$db=new SQL_conn();
		$st=$db->getTableLimit($RuleTable;, $start, $count);
		return $st;
	}
	
}
?>