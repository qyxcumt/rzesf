<?php
//session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/says.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/security.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/house.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/deal.php';

$housecount=house::getWaittingHouseCount();
$dealcount=deal::getAllWattingDealCount();
?>