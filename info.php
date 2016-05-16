<?php
require_once 'core/notification.php';
require_once 'core/rule.php';
require_once 'core/defines.php';

$pg;
$type;
$st;

if(isset($_GET['id'])){
	if(!isset($_GET['type'])){
		echo "<p style=\"font-size:40px;color:#eb6100;text-align:center;\">参数错误，请联系管理员，谢谢！</p>";
		return;
	}
	$st;
	switch($_GET['type']){
		case "notification":
			$type="通知通告";
			$st=notification::getNotificationbyID($_GET['id']);
			break;
		case "rule":
			$type="相关规定";
			$st=rule::getRulebyID($_GET['id']);
			break;
		default:
			echo "<p style=\"font-size:40px;color:#eb6100;text-align:center;\">参数错误，请联系管理员，谢谢！</p>";
			return;
	}
	
	echo "
			<p style=\"font-size:20px;color:#eb6100;\"><a href=\"info.html?type=".$_GET['type']."\">".$type."</a></p>
			";
	
	echo "
			<h1 style=\"font-size:30px;text-align:center;width:100%;color:#eb6100;\">".$st[0][4]."</h1>
			";
	
	echo "
			<hr/>
			";
	
	echo "
			<h6 style=\"text-align:center;font-size:10px;color:#000;font-weight:normal;\">发布者:".$st[0][1]."&nbsp &nbsp &nbsp &nbsp 发布时间:".$st[0][2]."</h6>
					";
	
	echo "
			<br/>
			<pre style=\"text-align=center;font-size:15px;color:#000;width=90%;white-space: pre-wrap;word-wrap: break-word;\">".$st[0][3]."</pre>
			";
	return;
}

if(!isset($_GET['pg']))
	$pg=1;
	else
		$pg=$_GET['pg'];
	
if(isset($_GET['type']))
	switch($_GET['type']){
		case "notification":
			$type="通知通告";
			if(!isset($_SESSION['pgcount'])){
				$count=notification::getNotificationCount();
				if(0==$count){
					echo "<p style=\"font-size:40px;color:#eb6100;text-align:center;\">暂无通知</p>";
					return;
				}
				$_SESSION['pgcount']=ceil($count/20);
			}
			$st=notification::getNotificationLimit(($pg-1)*20, 20);
			break;
		case "rule":
			$type="相关规定";
			if(!isset($_SESSION['pgcount'])){
				$count=rule::getRuleCount();
				if(0==$count){
					echo "<p style=\"font-size:40px;color:#eb6100;text-align:center;\">暂无数据</p>";
					return;
				}
				$_SESSION['pgcount']=ceil($count/20);
			}
			$st=rule::getRuleCount(($pg-1)*20, 20);
			break;
		default:
			echo "<p style=\"font-size:40px;color:#eb6100;text-align:center;\">参数错误，请联系管理员，谢谢！</p>";
			return;
	}
else{
	echo "<p style=\"font-size:40px;color:#eb6100;text-align:center;\">参数错误，请联系管理员，谢谢！</p>";
	return;
}

echo "
		<table width=\"80%\" style=\"margin:auto;\">
			<tr><td colspan=\"2\" style=\"font-size:40px;color:#eb6100;\">".$type."<td></tr>";
for($count=0;$count<count($st);$count++){
	echo "
			<tr><td class=\"infolist\"  onclick=\"javascript:window.location.href='info.html?type=".$_GET['type']."&id=".$st[$count][0]."'\">".$st[$count][4]."</td><td class=\"infolisttime\">".$st[$count][2]."</td></tr>
			";
}

echo "
		<tr><td colspan=\"2\" style=\"text-align:center;\">
		";
if($pg!=1)
	echo "
			<span style=\"float:left;color:#000;\"><a href=\"info.html?type=".$_GET['type']."&pg=".($pg-1)."\">上一页</a></span>
			";
echo "
		<span style=\"color:#000;\">".$pg."/".$_SESSION['pgcount']."</span>
		";
if($pg!=$_SESSION['pgcount'])
	echo "
			<span style=\"float:right;color:#000;\"><a href=\"info.html?type=".$_GET['type']."&pg=".($pg+1)."\">下一页</a></span>
			";
echo "</td></tr>";
echo "
		</table>";
?>