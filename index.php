<?php 
require_once 'browser.php';
session_start();
require_once 'defines.php';

require_once 'Information.class.php';
require_once 'HouseSources.class.php';
if(isset($_POST['fun'])){
	$fun=$_POST['fun'];
	switch($fun){
		case 'getHouseDiv':
			index::getHouseDiv();
			break;
		case 'getNotificationDiv':
			index::getNotificationDiv();
			break;
		case 'getNotificationTable':
			index::getNotificationTable();
			break;
		case 'getIndex':
			index::getHouseDiv();
			index::getNotificationDiv();
			break;
		case 'getHouse':
			index::getHouse();
	}
}


	function getNotificationDiv(){
		index::getNotificationDiv();
	}
	
	function getNotificationTable(){
		index::getNotificationTable();
	}
	
	class index{
		static function getHouseDiv(){
			echo "<div id=\"HouseDiv\" style=\"float:left; width:72%;margin:125px 10px 30px 10px;padding:10px 40px 0 40px;background-color:#F9F9F9;box-shadow:0 0 40px -20px rgba(0,0,0,0.3);\" >
			<div id=\"HouseTableDiv\" style=\"margin-top:0px;color:#000;\">";

			echo "
			</div>
			</div>";
			echo "<script >getHouseCount();</script>";
		}
		
		static function getNotificationDiv(){
			echo "<div id=\"NotificationDiv\" style=\"float:left; width:25%;margin:125px 10px 30px 10px;padding:10px 40px 0 40px;background-color:#F9F9F9;box-shadow:0 0 40px -20px rgba(0,0,0,0.3);\">
		<div style=\"margin-top:20px;color:#000;\">";
			index::getNotificationTable();
			echo "</div>
         </div>";
		}
		
		static function getNotificationTable(){
			echo "<table style='min-width:250px;width:100%;' border=0 rules=none >
				<tr><td style=\"font-size:40px;color:#eb6100;width:55%;\">最新通知
					<a class=\"more\" onclick=\"sjmpto('news.php?style=noteList')\" title=\"更多通知\">···</a></td>
				</tr>";
					$noti=new Notification();
					$noticount=$noti->getDataCount();
					if($noticount!=0){
						$st=$noti->getDataLimit(0,5);
						for($counter=0;$counter<count($st);$counter++){
							$analyser=new NotificationAnalyser($st[$counter]);
							echo "
								<tr>
									<td><a class='tablelinktext'>".$analyser->getTitle()."</a></td>
								</tr>";
						}
					}else echo "<tr><td>暂无通知</td></tr>";
				echo "
				<tr>
					<td><hr/></td>
				</tr>
				<tr><td  style=\"font-size:40px;color:#eb6100\">相关政策
					<a class=\"more\" onclick=\"sjmpto('news.php?style=noteList')\" title=\"更多政策\">···</a></td>";
					$noti=new Rule();
					$noticount=$noti->getDataCount();
					if($noticount!=0){
						$st=$noti->getDataLimit(0,10);
						for($counter=0;$counter<count($st);$counter++){
							$analyser=new RuleAnalyser($st[$counter]);
							echo "
								<tr>
									<td>".$analyser->getTitle()."</td>
								</tr>";
						}
					}else echo "<tr><td>暂无数据</td></tr>";
				echo "
				</tr>
			</table>";
		}
	}
?>