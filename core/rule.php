<?php
require_once 'sqlmanager.php';
require_once 'defines.php';
class rule{
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
		$count=$db->getTableCount($RuleTable);
		return $count;
	}
	
	static function getRuleLimit($start,$count){
		global $RuleTable;
		$db=new SQL_conn();
		$st=$db->getTableLimit($RuleTable, $start, $count);
		return $st;
	}
	
}
?>