<?php
//session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/says.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/security.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/house.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/deal.php';
	$user=new user($_SESSION['user']);
	$userid=$user->getId();
	
	$wattinghousecount=house::getWaittingHouseCountbyPublisher($userid);
	$checkedhousecount=house::getHouseTableCountbyPublisher($userid);
	$notpasshousecount=house::getnotPassedHouseCountbyPublisher($userid);
	$tradinghousecount=house::getTradingHouseCountbyPublisher($userid)+house::getTradingHouseCountbyBuyer($userid);
	$tradedhousecount=house::getTradedHouseCountbyPublisher($userid)+house::getTradedHouseCountbyBuyer($userid);
	
	$wattingdealcount=deal::getWattingDealCountbyBuyer($userid)+deal::getWattingDealCountbySeller($userid);
	$checkeddealcount=deal::getDealCountbyBuyer($userid)+deal::getDealCountbySeller($userid);
	$notpassdealcount=deal::getnotPassedDealCountbyBuyer($userid)+deal::getnotPassedDealCountbySeller($userid);
	
?>