<?php
session_start();
	require_once 'sqlmanager.php';
	require_once 'defines.php';
	
	class House{
		protected $tablename,$POD_NO,$obligee,$region,$address,$roomcount,$hallcount,$toiletcount;
		protected $floor,$floorcount,$fitment,$price,$AOB,$linkman,$phone,$time,$area,$publisher;
		protected $db;

		function getPOD_NO(){
			return $this->POD_NO;
		}
		
		function getObligee(){
			return $this->obligee;
		}
		
		function getRegion(){
			return $this->region;
		}
		
		function getAddress(){
			return $this->address;
		}
		
		function getRoomCount(){
			return $this->roomcount;
		}
		
		function getHallCount(){
			return $this->hallcount;
		}
		
		function getToiletCount(){
			return $this->toiletcount;
		}
		
		function getFloor(){
			return $this->floor;
		}
		
		function getFloorCount(){
			return $this->floorcount;
		}
		
		function getFitment(){
			return $this->fitment;
		}
		
		function getPrice(){
			return $this->price;
		}
		
		function getAOB(){
			return $this->AOB;
		}
		
		function getLinkman(){
			return $this->linkman;
		}
		
		function getPhone(){
			return $this->phone;
		}
		
		function getTime(){
			return $this->time;
		}
		
		function getArea(){
			return $this->area;
		}
		
		function getPublisher(){
			return $this->publisher;
		}
		
		function deleteHouse(){
			$ret=$this->db->deleteRecord($this->tablename, "POD_NO=\"$this->POD_NO\"");
			if($ret)
				return true;
			return false;
		}
				
		static function getHouse($POD_NO){
			global $checkedHouseSourcesTable;
			$db=new SQL_conn();
			$st=$db->getRecord($checkedHouseSourcesTable, "POD_NO", $POD_NO);
			return $st;
		}
		
		static function getWaittingtHouse($POD_NO){
			global $waittingHouseSourcesTable;
			$db=new SQL_conn();
			$st=$db->getRecord($waittingHouseSourcesTable, "POD_NO", $POD_NO);
			return $st;
		}
		
		static function getnotPassedHouse($id){
			global $notPassedHouseSourcesTable;
			$db=new SQL_conn();
			$st=$db->getRecord($notPassedHouseSourcesTable, "id", $id);
			return $st;
		}
		
		static function getTradedHouse($id){
			global $tradedHouseSourcesTable;
			$db=new SQL_conn();
			$st=$db->getRecord($tradedHouseSourcesTable, "id", $id);
			return $st;
		}
		
		static function getHouseTablebyPublisher($id,$start=0,$count=0){
			global $checkedHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			return $db->getTableSortbyTime($checkedHouseSourcesTable,$condition,$start,$count);
		}
		
		static function getHouseTableCountbyPublisher($id){
			global $checkedHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			return $db->getTableCount($checkedHouseSourcesTable,$condition);
		}
		
		
		
		static function getWaittingHousebyPublisher($id,$start=0,$count=0){
			global $waittingHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			$st=$db->getTableSortbyTime($waittingHouseSourcesTable,$condition,$start,$count);
			return $st;
		}
		
		static function getWaittingHouseCountbyPublisher($id){
			global $waittingHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			return $db->getTableCount($waittingHouseSourcesTablee,$condition);
		}
		
		static function getnotPassedHousebyPublisher($id,$start=0,$count=0){
			global $notPassedHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			$st=$db->getTableSortbyTime($notPassedHouseSourcesTable,$condition,$start,$count);
			return $st;
		}
		
		static function getnotPassedHouseCountbyPublisher($id){
			global $notPassedHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			return $db->getTableCount($notPassedHouseSourcesTable,$condition);
		}
		
		static function getTradingHousebyPublisher($id,$start=0,$count=0){
			global $tradingHouseSourcesTable;
			$conditoin=" publisher = $id";
			$db=new SQL_conn();
			$st=$db->getTableSortbyTime($tradingHouseSourcesTable,$conditoin,$start,$count);
			return $st;
		}
		
		static function getTradingHouseCountbyPublisher($id){
			global $tradingHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			return $db->getTableCount($tradingHouseSourcesTable,$condition);
		}
		
		static function getTradedHousebyPublisher($id,$start=0,$count=0){
			global $tradedHouseSourcesTable;
			$conditoin=" publisher = $id";
			$db=new SQL_conn();
			$st=$db->getTableSortbyTime($tradedHouseSourcesTable,$conditoin,$start,$count);
			return $st;
		}
		
		static function getTradedHouseCountbyPublisher($id){
			global $tradedHouseSourcesTable;
			$condition=" publisher = $id";
			$db=new SQL_conn();
			return $db->getTableCount($tradednHouseSourcesTable,$condition);
		}
		
		static function getTradingHousebyBuyer($id,$start=0,$count=0){
			global $tradingHouseSourcesTable;
			$conditoin=" buyer = $id";
			$db=new SQL_conn();
			$st=$db->getTableSortbyTime($tradingHouseSourcesTable,$conditoin,$start,$count);
			return $st;
		}
		
		static function getTradingHouseCountbyBuyer($id){
			global $tradingHouseSourcesTable;
			$condition=" buyer = $id";
			$db=new SQL_conn();
			$st=$db->getTableCount($tradingHouseSourcesTable,$condition);
			return $st;
		}
		
		static function getTradedHousebyBuyer($id,$start=0,$count=0){
			global $tradedHouseSourcesTable;
			$conditoin=" buyer = $id";
			$db=new SQL_conn();
			$st=$db->getTableSortbyTime($tradedHouseSourcesTable,$conditoin,$start,$count);
			return $st;
		}
		
		static function getTradedHouseCountbyBuyer($id){
			global $tradedHouseSourcesTable;
			$condition=" buyer = $id";
			$db=new SQL_conn();
			$st=$db->getTableCount($tradedHouseSourcesTable,$condition);
			return $st;
		}
	}
	
	class waittingHouse extends House{
		function __construct($POD_NO){
			global $waittingHouseSourcesTable;
			$this->tablename=$waittingHouseSourcesTable;
			$this->db=new SQL_conn();
			$st=$this->db->getRecord($this->tablename, "POD_NO", $POD_NO);
			$this->POD_NO=$st[0][0];
			$this->obligee=$st[0][1];
			$this->region=$st[0][2];
			$this->address=$st[0][3];
			$this->roomcount=$st[0][4];
			$this->hallcount=$st[0][5];
			$this->toiletcount=$st[0][6];
			$this->floor=$st[0][7];
			$this->floor_count=$st[0][8];
			$this->fitment=$st[0][9];
			$this->price=$st[0][10];
			$this->AOB=$st[0][11];
			$this->linkman=$st[0][12];
			$this->phone=$st[0][13];
			$this->time=$st[0][14];
			$this->area=$st[0][15];
			$this->publisher=$st[0][16];
		}
	
		function setChecked($assessor){
			global $checkedHouseSourcesTable;
			$this->db->begin();
			if($this->deleteHouse()){
				if($this->db->insertRecord($checkedHouseSourcesTable, array(
					"POD_NO"=>$this->PDO_NO,
					"obligee"=>$this->obligee,
					"region"=>$this->region,
					"address"=>$this->address,
					"roomcount"=>$this->roomcount,
					"hallcount"=>$this->hallcount,
					"toiletcount"=>$this->toiletcount,
					"floor"=>$this->floor,
					"floor_count"=>$this->floor_count,
					"fitment"=>$this->fitment,
					"price"=>$this->price,
					"AOB"=>$this->AOB,
					"linkman"=>$this->linkman,
					"phone"=>$this->phone,
					"time"=>$this->time,
					"area"=>$this->area,
					"publisher"=>$this->publisher,
					"assessor"=>$assessor
				))){
					$this->db->commit();
					return true;
				}	
			}
			$this->db->rollBack();
			return false;
		}

		
		function setnotPassed($assessor,$reason){
				global $notPassedHouseSourcesTable;
				$this->db->begin();
				if($this->deleteHouse()){
					if($this->db->insertRecord($notPassedHouseSourcesTable, array(
						"POD_NO"=>$this->PDO_NO,
						"obligee"=>$this->obligee,
						"region"=>$this->region,
						"address"=>$this->address,
						"roomcount"=>$this->roomcount,
						"hallcount"=>$this->hallcount,
						"toiletcount"=>$this->toiletcount,
						"floor"=>$this->floor,
						"floor_count"=>$this->floor_count,
						"fitment"=>$this->fitment,
						"price"=>$this->price,
						"AOB"=>$this->AOB,
						"linkman"=>$this->linkman,
						"phone"=>$this->phone,
						"time"=>$this->time,
						"area"=>$this->area,
						"publisher"=>$this->publisher,
						"assessor"=>$assessor,
						"reason"=>$reason
					))){
						$this->db->commit();
						return true;
					}	
				}
				$this->db->rollBack();
				return false;
			}
			
			
	}
	
	class checkedHouse extends House{
		private $assessor;
		function __construct($POD_NO){
			global $checkedHouseSourcesTable;
			$this->tablename=$checkedHouseSourcesTable;
			$this->db=new SQL_conn();
			$st=$this->db->getRecord($this->tablename, "POD_NO", $POD_NO);
			$this->POD_NO=$st[0][0];
			$this->obligee=$st[0][1];
			$this->region=$st[0][2];
			$this->address=$st[0][3];
			$this->roomcount=$st[0][4];
			$this->hallcount=$st[0][5];
			$this->toiletcount=$st[0][6];
			$this->floor=$st[0][7];
			$this->floor_count=$st[0][8];
			$this->fitment=$st[0][9];
			$this->price=$st[0][10];
			$this->AOB=$st[0][11];
			$this->linkman=$st[0][12];
			$this->phone=$st[0][13];
			$this->time=$st[0][14];
			$this->area=$st[0][15];
			$this->publisher=$st[0][16];
			$this->assessor=$st[0][17];
		}
		
		function setTrading($buyer){
			global $tradingHouseSourcesTable;
			$this->db->begin();
			if($this->deleteHouse()){
				if($this->db->insertRecord($tradingHouseSourcesTable, array(
						"POD_NO"=>$this->PDO_NO,
						"obligee"=>$this->obligee,
						"region"=>$this->region,
						"address"=>$this->address,
						"roomcount"=>$this->roomcount,
						"hallcount"=>$this->hallcount,
						"toiletcount"=>$this->toiletcount,
						"floor"=>$this->floor,
						"floor_count"=>$this->floor_count,
						"fitment"=>$this->fitment,
						"price"=>$this->price,
						"AOB"=>$this->AOB,
						"linkman"=>$this->linkman,
						"phone"=>$this->phone,
						"time"=>$this->time,
						"area"=>$this->area,
						"publisher"=>$this->publisher,
						"buyer"=>$buyer,
						"assessor"=>$this->assessor
				))){
					$this->db->commit();
					return true;
				}
			}
			$this->db->rollBack();
			return false;
		}
		
		static function getHouseTable($start,$count,$condition=""){
			global $checkedHouseSourcesTable;
			$db=new SQL_conn();
			return $db->getTableLimit($checkedHouseSourcesTable, $start, $count);
		}
		
	}
	
	class notPassedHouse extends House{
		private $reason,$id,$assessor;
		function __construct($id){
			global $checkedHouseSourcesTable;
			$this->tablename=$checkedHouseSourcesTable;
			$this->db=new SQL_conn();
			$st=$this->db->getRecord($this->tablename, "id", $id);
			$this->POD_NO=$st[0][0];
			$this->obligee=$st[0][1];
			$this->region=$st[0][2];
			$this->address=$st[0][3];
			$this->roomcount=$st[0][4];
			$this->hallcount=$st[0][5];
			$this->toiletcount=$st[0][6];
			$this->floor=$st[0][7];
			$this->floor_count=$st[0][8];
			$this->fitment=$st[0][9];
			$this->price=$st[0][10];
			$this->AOB=$st[0][11];
			$this->linkman=$st[0][12];
			$this->phone=$st[0][13];
			$this->time=$st[0][14];
			$this->area=$st[0][15];
			$this->publisher=$st[0][16];
			$this->assessor=$st[0][17];
			$this->id=$st[0][18];
			$this->reason=$st[0][19];
		}
		
		function getReason(){
			return $this->reason;
		}
	}
	
	class tradingHouse extends House{
		private $buyer,$assessor,$id;
		function __construct($POD_NO){
			global $tradingHouseSourcesTable;
			$this->tablename=$tradingHouseSourcesTable;
			$this->db=new SQL_conn();
			$st=$this->db->getRecord($this->tablename, "POD_NO", $POD_NO);
			$this->POD_NO=$st[0][0];
			$this->obligee=$st[0][1];
			$this->region=$st[0][2];
			$this->address=$st[0][3];
			$this->roomcount=$st[0][4];
			$this->hallcount=$st[0][5];
			$this->toiletcount=$st[0][6];
			$this->floor=$st[0][7];
			$this->floor_count=$st[0][8];
			$this->fitment=$st[0][9];
			$this->price=$st[0][10];
			$this->AOB=$st[0][11];
			$this->linkman=$st[0][12];
			$this->phone=$st[0][13];
			$this->time=$st[0][14];
			$this->area=$st[0][15];
			$this->publisher=$st[0][16];
			$this->buyer=$st[0][17];
			$this->assessor=$st[0][18];
			$this->id=$st[0][19];
		}
	
		function getBuyer(){
			return $this->buyer;
		}
		
		function setTraded(){
				global $tradedHouseSourcesTable;
				$this->db->begin();
				if($this->deleteHouse()){
					if($this->db->insertRecord($tradedHouseSourcesTable, array(
						"POD_NO"=>$this->PDO_NO,
						"obligee"=>$this->obligee,
						"region"=>$this->region,
						"address"=>$this->address,
						"roomcount"=>$this->roomcount,
						"hallcount"=>$this->hallcount,
						"toiletcount"=>$this->toiletcount,
						"floor"=>$this->floor,
						"floor_count"=>$this->floor_count,
						"fitment"=>$this->fitment,
						"price"=>$this->price,
						"AOB"=>$this->AOB,
						"linkman"=>$this->linkman,
						"phone"=>$this->phone,
						"time"=>$this->time,
						"area"=>$this->area,
						"publisher"=>$this->publisher,
						"buyer"=>$this->buyer,
						"assessor"=>$this->assessor
					))){
						$this->db->commit();
						return $this->db->getMaxID($tradedHouseSourcesTable);
					}	
				}
				$this->db->rollBack();
				return false;
			}
		
		function setChecked(){
			global $checkedHouseSourcesTable;
			$this->db->begin();
			if($this->deleteHouse()){
				if($this->db->insertRecord($checkedHouseSourcesTable, array(
						"POD_NO"=>$this->PDO_NO,
						"obligee"=>$this->obligee,
						"region"=>$this->region,
						"address"=>$this->address,
						"roomcount"=>$this->roomcount,
						"hallcount"=>$this->hallcount,
						"toiletcount"=>$this->toiletcount,
						"floor"=>$this->floor,
						"floor_count"=>$this->floor_count,
						"fitment"=>$this->fitment,
						"price"=>$this->price,
						"AOB"=>$this->AOB,
						"linkman"=>$this->linkman,
						"phone"=>$this->phone,
						"time"=>$this->time,
						"area"=>$this->area,
						"publisher"=>$this->publisher,
						"assessor"=>$assessor
				))){
					$this->db->commit();
					return true;
				}
			}
			$this->db->rollBack();
			return false;
		}
	}
	
	class tradedHouse extends House{
		private $buyer,$id;
		function __construct($id){
			global $tradedHouseSourcesTable;
			$this->tablename=$tradedHouseSourcesTable;
			$this->db=new SQL_conn();
			$st=$this->db->getRecord($this->tablename, "id", $id);
			$this->POD_NO=$st[0][0];
			$this->obligee=$st[0][1];
			$this->region=$st[0][2];
			$this->address=$st[0][3];
			$this->roomcount=$st[0][4];
			$this->hallcount=$st[0][5];
			$this->toiletcount=$st[0][6];
			$this->floor=$st[0][7];
			$this->floor_count=$st[0][8];
			$this->fitment=$st[0][9];
			$this->price=$st[0][10];
			$this->AOB=$st[0][11];
			$this->linkman=$st[0][12];
			$this->phone=$st[0][13];
			$this->time=$st[0][14];
			$this->area=$st[0][15];
			$this->publisher=$st[0][16];
			$this->buyer=$st[0][17];
			$this->assessor=$st[0][18];
			$this->id=$st[0][19];
		}
	
		function getBuyer(){
			return $this->buyer;
		}
	}
	
	class HouseDataAnalyser{
		protected  $POD_NO,$obligee,$region,$address,$roomcount,$hallcount,$toiletcount;
		protected  $floor,$floorcount,$fitment,$price,$AOB,$linkman,$phone,$time,$area,$publisher;
		
		function __construct($row){
			$this->POD_NO=$row[0];
			$this->obligee=$row[1];
			$this->region=$row[2];
			$this->address=$row[3];
			$this->roomcount=$row[4];
			$this->hallcount=$row[5];
			$this->toiletcount=$row[6];
			$this->floor=$row[7];
			$this->floor_count=$row[8];
			$this->fitment=$row[9];
			$this->price=$row[10];
			$this->AOB=$row[11];
			$this->linkman=$row[12];
			$this->phone=$row[13];
			$this->time=$row[14];
			$this->area=$row[15];
			$this->publisher=$row[16];
		}
		
		function getPOD_NO(){
			return $this->POD_NO;
		}
		
		function getObligee(){
			return $this->obligee;
		}
		
		function getRegion(){
			return $this->region;
		}
		
		function getAddress(){
			return $this->address;
		}
		
		function getRoomCount(){
			return $this->roomcount;
		}
		
		function getHallCount(){
			return $this->hallcount;
		}
		
		function getToiletCount(){
			return $this->toiletcount;
		}
		
		function getFloor(){
			return $this->floor;
		}
		
		function getFloorCount(){
			return $this->floorcount;
		}
		
		function getFitment(){
			return $this->fitment;
		}
		
		function getPrice(){
			return $this->price;
		}
		
		function getAOB(){
			return $this->AOB;
		}
		
		function getLinkman(){
			return $this->linkman;
		}
		
		function getPhone(){
			return $this->phone;
		}
		
		function getTime(){
			return $this->time;
		}
		
		function getArea(){
			return $this->area;
		}
		
		function getPublisher(){
			return $this->publisher;
		}
	}
	
	class checkedHouseDataAnalyser extends HouseDataAnalyser{
		private $assessor;
		function __construct($row){
			parent::__construct($row);
			$this->assessor=$row[17];
		}
		
		function getAssessor(){
			return $this->assessor;
		}
	}
	
	class notPassedHouseDataAnalyser extends HouseDataAnalyser{
		private $assessor,$id,$reason;
		function __construct($row){
			parent::__construct($row);
			$this->assessor=$row[17];
			$this->id=$row[18];
			$this->reason=$row[19];
		}
		
		function getAssessor(){
			return $this->assessor;
		}
		
		function getID(){
			return $this->id;
		}
		
		function getReason(){
			return $this->reason;
		}
	}
	
	class tradingHouseDataAnalyer extends HouseDataAnalyser{
		private $buyer,$assessor;
		function __construct($row){
			parent::__construct($row);
			$this->buyer=$row[17];
			$this->assessor=$row[18];
		}
		
		function getBuyer(){
			return $this->buyer;
		}
		
		function getAssessor(){
			return $this->assessor;
		}
	}
	
	class tradedHouseDataAnalyser extends HouseDataAnalyser{
		private $buyer,$assessor,$id;
		function __construct($row){
			parent::__construct($row);
			$this->buyer=$row[17];
			$this->assessor=$row[18];
			$this->id=$row[19];
		}
		
		function getBuyer(){
			return $this->buyer;
		}
		
		function getAssessor(){
			return $this->assessor;
		}
		
		function getID(){
			return $this->id;
		}
	}
	
	class waittingHouseDataAnalyser extends HouseDataAnalyser{
		function __construct($row){
			parent::__construct($row);
		}
	}
	
?>