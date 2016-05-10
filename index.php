<?php 
require_once 'browser.php';
require_once 'core/defines.php';
require_once 'core/House.php';
require_once 'core/notification.php';
require_once 'core/rule.php';

if(isset($_POST['fun'])){
	$fun=$_POST['fun'];
	switch($fun){
		case 'getInfo':
			getInfo(); 
			break;
		case 'getHouse':
			getHouse();
	}
}

function getInfo(){
	echo "<table style='min-width:250px;width:100%;' border=0 rules=none >
		<tr><td style=\"font-size:40px;color:#eb6100;width:55%;\">最新通知
			<a class=\"more\" href=\"info.html?type=notification\" title=\"更多通知\">···</a></td>
		</tr>";
			$noti=new Notification();
			$noticount=$noti->getNotificationCount();
			if($noticount!=0){
				$st=$noti->getNotificationLimit(0,5);
				for($counter=0;$counter<count($st);$counter++){
					echo "
						<tr>
							<td><a class='tablelinktext'  href=\"info.html?type=notification&id=".$st[$counter][0]."\">".$st[$counter][4]."</a></td>
						</tr>";
				}
			}else echo "<tr><td class=\"tablenolinktext\">暂无通知</td></tr>";
		echo "
		<tr>
			<td><hr/></td>
		</tr>
		<tr><td  style=\"font-size:40px;color:#eb6100\">相关政策
			<a class=\"more\" href=\"info.html?type=rule\" title=\"更多政策\">···</a></td>";
			$rule=new rule();
			$noticount=$rule->getRuleCount();
			if($noticount!=0){
				$st=$rule->getRuleLimit(0,10);
				for($counter=0;$counter<count($st);$counter++){
					echo "
						<tr>
							<td><a class='tablelinktext' href=\"info.html?type=rule&id=".$st[$counter][0]."\">".$st[$counter][4]."</a></td>
						</tr>";
				}
			}else echo "<tr><td class=\"tablenolinktext\">暂无数据</td></tr>";
		echo "
		</tr>
	</table>";
}

function getHouse(){
	$st=checkedHouse::getHouseTable(0, 10);
// 	echo count($st);
// 	die();
	if(0==count($st))
		echo "<p style=\"text-align:center;font-size:40px;color:#eb6100;\">对不起，暂无通过审核的房源</p>";
	else{
		echo "
					<table id='HouseTable'>
								<tr style='height:20px'>
								<td style='width:15%'>
									<div class='houselist'>
										<div style='font-size:16px;'>户型</div>
				   					</div>
								</td>
								<td style='width:10%'>
									<div class='houselist'>
										<div style='font-size:16px;'>面积</div>
									</div>
								</td>
								<td style='width:10%'>
									<div class='houselist'>
				 						<div style='font-size:16px;'>价格(万)</div>
									</div>
						 		</td>
								<td style='width:15%x'>
									<div class='houselist'>
										<div style='font-size:16px;'>电话</div>
									</div>
								</td>
								<td style='width:15%'>
									<div class='houselist'>
										<div style='font-size:16px;'>联系人</div>
									</div>
								</td>
								<td  style='width:17%'>
									<div class='houselist'>
										<div style='font-size:16px;'>地址</div>
									</div>
								</td>
								<td  style='width:18%'>
									<div class='houselist'>
										<div style='font-size:16px;'>发布时间</div>
				 					</div>
								</td>
							</tr>
					";
		for($counter=0;$counter<count($st);$counter++){
			$house=new HouseDataAnalyser($st[$counter]);
			echo "
						<tr onclick=\"javascript:window.location.href='house.html?POD=".$house->getPOD_NO()."style='height:0px'>
							<td style='width:15%'>
								<div class='houselistdata'>
									<div style='font-size:16px;height:20px'>".(string)($house->getRoomCount())."室".$house->getHallCount()."厅".$house->getToiletCount()."卫"."</div>
								</div>
							</td>
							<td style='width:10%'>
								<div class='houselistdata'>
									<div style='font-size:16px;height:20px'>".$house->getArea()."</div>
								</div>
							</td>
							<td style='width:10%'>
								<div class='houselistdata'>
									<div style='font-size:16px;height:20px'>".$house->getPrice()."</div>
								</div>
							</td>
							<td style='width:15%'>
								<div class='houselistdata'>
									<div style='font-size:16px;height:20px'>".$house->getPhone()."</div>
								</div>
							</td>
							<td style='width:15%'>
								<div class='houselistdata'>
									<div style='font-size:16px;height:20px'>".$house->getLinkman()."</div>
								</div>
							</td>
							<td style='width:17%'>
								<div class='houselistdata'>
									<div style='font-size:16px;height:20px'>".$house->getAddress()."</div>
								</div>
							</td>
							<td style='width:18%'>
								<div class='houselistdata'>
									<div style='font-size:16px;height:20px'>".$house->getTime()."</div>
								</div>
							</td>
						</tr>";
		
		}
	}
}

?>