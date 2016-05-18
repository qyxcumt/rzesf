<?php
require_once '../core/House.php';

$house;
switch($_GET['type']){
	case "checked":
		$house=new checkedHouse($_GET['POD']);
		break;
	case "waitting":
		$house=new waittingHouse($_GET['POD']);
		break;
}

if($house->deleteHouse()){
	;//成功，添加成功后执行的代码
}else{
;//失败添加失败后执行的代码
}
?>