<?php
require_once 'sqlmanager.php';
require_once 'defines.php';
class user{
	private $id,$user,$name,$ID_NO,$mail,$phone,$qq,$time;
	function __construct($user){
		global $UserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($UserTable, "user", $user);
		$this->id=$st[0][0];
		$this->user=$st[0][1];
		$this->name=$st[0][3];
		$this->ID_NO=$st[0][4];
		$this->mail=$st[0][5];
		$this->phone=$st[0][6];
		$this->qq=$st[0][7];
		$this->time=$st[0][8];
	}
	
	function getID(){
		return $this->id;
	}
	
	function getUser(){
		return $this->user;
	}
	
	function getName(){
		return $this->name;
	}
	
	function getID_NO(){
		return $this->ID_NO;
	}
	
	function getMail(){
		return $this->mail;
	}
	
	function getPhone(){
		return $this->phone;
	}
	
	function getQQ(){
		return $this->qq;
	}
	
	function getTime(){
		return $this->time;
	}
	
	function updateInfo($param){
		global $UserTable;
		$db=new SQL_conn();
		if(!$db->updateRecord($UserTable, $param, "id=$this->id"))
			return true;
		return false;
	}
	
	static function getUserName($id){
		global $UserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($UserTable, "id", $id);
		return $st[0][3];
	}
	
	static function verifyUser($user,$passwd){
		global $UserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($UserTable, "user", $user);
		if(count($st)==0)
			return false;
		if($passwd==$st[0][2])
			return true;
		return false;
	}
	
	static function checkUserName($user){
		global $UserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($UserTable, "user", $user);
		if(count($st)==0)
			return true;
		return false;
	}
	
	static function checkID_NO($id){
		global $UserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($UserTable, "ID_NO", $id);
		if(count($st)==0)
			return true;
		return false;
	}
	
	static function adduser($param){
		global $UserTable;
		$db=new SQL_conn();
		if($db->insertRecord($UserTable, $param))
			return true;
		return false;
	}
	
}

class zgUser{
	private $id,$user,$name;
	function __construct($user){
		global $zgUserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($zgUserTable, "user", $user);
		$this->id=$st[0][0];
		$this->user=$st[0][1];
		$this->name=$st[0][3];
	}
	
	function getID(){
		return $this->id;
	}
	
	function getUser(){
		return $this->user;
	}
	
	function getName(){
		return $this->name;
	}
	
	static function verifyUser($user,$passwd){
		global $zgUserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($zgUserTable, "user", $user);
		if(count($st)==0){
			return false;
		}
		if($passwd==$st[0][2])
			return true;
		return false;
	}
	
	static function checkUserName($user){
		global $zgUserTable;
		$db=new SQL_conn();
		$st=$db->getRecord($zgUserTable, "user", $user);
		if(count($st)==0)
			return true;
		return false;
	}
}

class admin{
	private $id,$user;
	
	function __construct($user){
		global $AdminTable;
		$db=new SQL_conn();
		$st=$db->getRecord($AdminTable, "user", $user);
		$this->id=$st[0][0];
		$this->user=$st[0][1];
	}
	
	function getID(){
		return $this->id;
	}
	
	function getUser(){
		return $this->user;
	}
	
	static function verifyUser($user,$passwd){
		global $AdminTable;
		$db=new SQL_conn();
		$st=$db->getRecord($AdminTable, "user", $user);
		if($count($st)==0){
			return false;
		}
		if($passwd==$st[0][2])
			return true;
			return false;
	}
	
	static function checkUserName($user){
		global $AdminTable;
		$db=new SQL_conn();
		$st=$db->getRecord($AdminTable, "user", $user);
		if(count($st)==0)
			return true;
		return false;
	}
}
?>