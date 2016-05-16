<?php
require_once '../defines';
require_once '../connclient.class.php';
	class user{
		private $id,$user,$name,$ID_NO,$mail,$phone,$qq,$time;
		function __construct(){
			global $UserTable;
			$db=new conn($UserTable);
			$st=$db->getDataDetail('user', $_SESSION['user']);
			$id=$st[0][0];
			$user=$st[0][1];
			$name=$st[0][3];
			$ID_NO=$st[0][4];
			$mail=$st[0][5];
			$phone=$st[0][6];
			$qq=$st[0][8];
			$time=$st[0][9];
		}
		
		function getId(){
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
		
		function getQq(){
			return $this->qq;
		}
		
		function getTime(){
			return $this->time;
		}
	}
?>