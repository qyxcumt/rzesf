<?php 
session_start();
	require_once 'defines.php';
	class SQL_conn{
		private $db;
		function __construct(){
			try{
				global $db_server;
				global $db_hostname;
				global $db_database;
				global $db_username;
				global $db_password;
				global $db_charset;
				$this->db = new PDO("$db_server:host=$db_hostname;dbname=$db_database;charset=$db_charset;", $db_username, $db_password);
				$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			}
			catch (PDOException $e) {
    			print "Error!: " . $e->getMessage() . "";
    			die();
			}
		}
				
		function getTable($table,$condition=""){
			$str="select * from $table ";
			if($condition!="")
				$str.=" where".$condition;
			//echo $str;
			//die();
			$st=$this->db->query($str);
			if(!$st)
				return false;
			$rs=$st->fetchAll();
			return $rs;
		}
		
		function getTableSortbyTime($table,$condition=""){
			$str="select * from $table ";
			if($condition!="")
				$str.=" where".$condition;
// 				echo $str;
// 				die();
			$str.=" order by time desc";
			$st=$this->db->query($str);
			if(!$st)
				return false;
				$rs=$st->fetchAll();
				return $rs;
		}
		
		function getTableCount($table,$condition=""){
			$str="select count(*) from $table";
			if($condition!="")
				$str.=" where".$condition;
			//echo "<script>alert($str)</script>";
			//die();
			$st=$this->db->query($str);
			if(!$st)
				return false;
			$rs=$st->fetchAll();
			return $rs[0][0];
		}
		
		function getTableLimitCondition($table,$start,$count,$condition=""){
			$str="select * from $table ";
			if($condition!="")
				$str.=" where".$condition;
			$str.=" limit $start,$count";
			//echo "<script>alert($str)</script>";
			//die();
			$st=$this->db->query($str);
			if(!$st)
				return false;
			$rs=$st->fetchAll();
			return $rs;
		}
		
		function getRecord($table,$field,$data){
			$str="select * from $table where $field=?";
			$stmt=$this->db->prepare($str);
			$exeres = $stmt->execute(array($data));
			if($exeres){
				$st=$stmt->fetchAll();
				if(!$st)
					return false;
				return $st;
			}
			return false;
		}
		
		function getRecordLock($table,$field,$data){
			$str="select * from $table where $field=$data lock in share mode";
			$st=$this->db->query($str);
			if(!$st)
				return false;
			$rs=$st->fetchAll();
			return $rs;
		}
		
		function updateRecord($table,$param,$condition){
			$str="updata $table set ";
			foreach($param as $item=>$value){
				$str.="$item = $valuse";
			}
			$str.="where";
			foreach($condition as $item=>$value){
				$str.="$item=$value";
			}
			$st=$this->db->query($str);
			if(!$st)
				return false;
			return true;
		}
		
		function getUpdateLock($table,$field,$data){
			$str="select * from $table where $field = $data for update";
			$st=$this->db->query($str);
			if(!$st)
				return false;
			return $st;
		}
		
		function insertRecord($table,$param){
			$str="insert into $table(";
			foreach($param as $item=>$value){
				$str.="$item,";
			}
			$str=substr($str,0,strlen($str)-1);
			$str.=") values(";
			foreach($param as $item=>$value)
				$str.="'$value',";
			$str=substr($str,0,strlen($str)-1);
			$str.=")";
			$st=$this->db->query($str);
			if(!$st)
				return false;
			return true;
		}
		
		function deleteRecord($table,$condition){
			$str="delete form $table where $condition";
			$st=$this->db->query($str);
			if(!$st)
				return false;
			return true;
		}
		
		function getMaxID($table){
			$srt="select max(id) from $table";
			$st=$this->db->query($str);
			if(!st)
				return false;
			return $st[0][0];
		}
		
		function begin(){
			$this->db->beginTransaction();
		}
		
		function commit(){
			$this->db->commit();
		}
		
		function rollBack(){
			$this->db->rollBack();
		}
	}
	
?>