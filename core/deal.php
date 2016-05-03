<?php
require_once 'sqlmanager.php';
require_once 'defines.php';
require_once 'House.php';

class deal{
	protected $seller,$buyer,$time,$POD_NO;
	protected $db,$tablename;
	
	function getSeller(){
		return $this->seller;
	}
	
	function getBuyer(){
		return $this->buyer;
	}
	
	function getTime(){
		return $this->time;
	}
	
	function getPOD_NO(){
		return $this->POD_NO;
	}
}

class waittingDeal extends deal{
	function __construct($POD_NO){
		global $waittingDealTable;
		$this->tablename=$waittingDealTable;
		$this->db=new SQL_conn();
		$st=$this->db->getRecord($this->tablename, "POD_NO", $POD_NO);
		$this->POD_NO=$st[0][0];
		$this->seller=$st[0][1];
		$this->buyer=$st[0][2];
		$this->time=$st[0][3];
	}
	
	function setChecked($assessor){
		global $checkedDealTable;
		$house=new tradingHouse($this->POD_NO);
		$this->db->begin();
		if(!$this->db->deleteRecord($this->tablename, " POD_NO=\"$this->POD_NO\" ")){
			$this->db->rollBack();
			return false;
		}
		$houseid=$house->setTraded();
		if(!houseid){
			$this->db->rollBack();
			return false;
		}
		if(!$this->db->insertRecord($checkedDealTable, array(
			'seller'=>$this->seller,
			'buyer'=>$this->buyer,
			'POD_NO'=>$this->POD_NO,
			'assessor'=>$assessor,
			'houseid'=>$houseid
		))){
			$this->db->rollBack();
			return false;
		}
		$this->db->commit();
		return true;		
	}
	
	function setnotPassed($assessor,$reason){
		global $notPassedDealTable;
		$house=new tradingHouse($this->POD_NO);
		$this->db->begin();
		if(!$this->db->deleteRecord($this->tablename, " POD_NO=\"$this->POD_NO\" ")){
			$this->db->rollBack();
			return false;
		}
		if(!$house->setChecked()){
			$this->db->rollBack();
			return false;
		}
		if(!$this->db->insertRecord($notPassedDealTable, array(
				'seller'=>$this->seller,
				'buyer'=>$this->buyer,
				'POD_NP'=>$this->POD_NO,
				'assessor'=>$assessor
		))){
			$this->db->rollBack();
			return false;
		}
		$this->db->commit();
		return true;
	}
	
	static function addDeal($seller,$buyer,$POD_NO){
		global $waittingDealTable;
		$db=new SQL_conn();
		$db->insertRecord($waittingDealTable, array(
				'POD_NO'=>$POD_NO,
				'seller'=>$seller,
				'buyer'=>$buyer
		));
	}
	
	static function getWattingDeal($id){
		global $waittingDealTable;
		$db=new SQL_conn();
		$st=$db->getTable($waittingDealTable," seller=$id or buyer=$id");
		return $st;
	}
}

class waittingDealAnalysor{
	private $POD_NO,$seller,$buyer,$time;
	function __construct($row){
		$this->POD_NO=$row[0][0];
		$this->seller=$row[0][1];
		$this->buyer=$row[0][2];
		$this->time=$row[0][3];
	}
	
	function getPOD_NO(){
		return $this->POD_NO;
	}
	
	function getSeller(){
		return $this->seller;
	}
	
	function getBuyer(){
		return $this->buyer;
	}
	
	function getTime(){
		return $this->time;
	}
}

class checkedDeal extends deal{
	private $houseid,$assessor,$id;
	function __construct($id){
		global $checkedDealTable;
		$this->tablename=$checkedDealTable;
		$st=$this->db=new SQL_conn();
		$this->seller=$st[0][0];
		$this->buyer=$st[0][1];
		$this->assessor=$st[0][2];
		$this->time=$st[0][3];
		$this->id=$st[0][4];
		$this->houseid=$st[0][5];
	}
	
	function getID(){
		return $this->id;
	}
	
	function getHouseID(){
		return $this->houseid;
	}
	
	static function getCheckedDeal($id){
		global $checkedDealTable;
		$db=new SQL_conn();
		$st=$db->getTable($checkedDealTable," seller=$id or buyer=$id");
		return $st;
	}
	
}

class checkedDealAnalysor{
	private $seller,$buyer,$assessor,$time,$id,$houseid;
	function __construct($row){
		$this->seller=$row[0][0];
		$this->buyer=$row[0][1];
		$this->assessor=$row[0][2];
		$this->time=$row[0][3];
		$this->id=$row[0][4];
		$this->houseid=$row[0][5];
	}

	function getSeller(){
		return $this->seller;
	}

	function getBuyer(){
		return $this->buyer;
	}

	function getTime(){
		return $this->time;
	}
	
	function getID(){
		return $this->id;
	}
	
	function getHouseID(){
		return $this->houseid;
	}
}

class notPasseddDeal extends deal{
	private $reason,$assessor,$id;
	function __construct($id){
		global $checkedDealTable;
		$this->tablename=$checkedDealTable;
		$st=$this->db=new SQL_conn();
		$this->POD_NO=$st[0][0];
		$this->seller=$st[0][0];
		$this->buyer=$st[0][1];
		$this->assessor=$st[0][2];
		$this->time=$st[0][3];
		$this->id=$st[0][4];
		$this->reason=$st[0][5];
	}
	
	function getID(){
		return $this->id;
	}
	
	function getReason(){
		return $this->reason;
	}
	
	static function getnotPassedDeal($id){
		global $notPassedDealTable;
		$db=new SQL_conn();
		$st=$db->getTable($notPassedDealTable," seller=$id or buyer=$id");
		return $st;
	}
	
} 

class notPassedDealAnalysor{
	private $POD_NO,$seller,$buyer,$assessor,$time,$id,$reason;
	function __construct($row){
		$this->POD_NO=$row[0][0];
		$this->seller=$row[0][1];
		$this->buyer=$row[0][2];
		$this->assessor=$row[0][3];
		$this->time=$row[0][4];
		$this->id=$row[0][5];
		$this->reason=$row[0][6];
	}

	function getSeller(){
		return $this->seller;
	}

	function getBuyer(){
		return $this->buyer;
	}

	function getTime(){
		return $this->time;
	}

	function getID(){
		return $this->id;
	}

	function getReason(){
		return $this->reason;
	}
}
?>