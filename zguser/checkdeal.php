<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/house.php';

if(isset($_POST['action'])){
	switch($_POST['action']){
		case "pass":
			$house=new waittingHouse($_POST['id']);
			$user=new zgUser($_SESSION['zguser']);
			if($house->setChecked($user->getID())){
				echo 1;
				exit();
			}
			echo 0;
			exit();
		case "notpass":
			$house=new waittingHouse($_POST['id']);
			$user=new zgUser($_SESSION['zguser']);
			if($house->setnotPassed($user->getID(), $_POST['reason'])){
				echo 1;
				exit();
			}
			echo 0;
			exit();
	}
}
?>
<html>
<head>
<title><?php echo $type;?></title>
<link href="../css/edit.css" rel="stylesheet" type="text/css" /> 
<script src="../js/jquery-2.0.3.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
    if(top==self){window.location.href("../user")} //限定在框架内打开
</script>
</head>
<body>
<div style="padding:30px 40px 0">
        <table class="list" rules=none id='list'>
            <tr style="height:50px;">
                <th style="text-align:left;padding-left:15px;font-size:30px;font-weight:300;line-height:50px;color:#fff;background-color:#3b424d;" colspan="8" nowrap>审核房源
                    <!--a href="newsAdd.php" id="add" class="add">添加通知</a--></th></tr>
<?php 
	if(House::getWaittingHouseCount()==0){
		echo "<tr><td colspan='8' nowrap style='font-size:24px'>没有待审核房源</td></tr>";
	}else{
		$row=waittingHouse::getFirstWatting();
		$house=new waittingHouseDataAnalyser($row);
		echo"<tr style='color:#33AAEE;height:35px;  font-weight: 200;border-bottom:1px solid #999'>
                                <th width=5% nowrap>房产证号</th><th width=5% nowrap>户型</th><th nowrap>面积</th><th width=10% nowrap>价格(万)</th>
                                <th width=15% nowrap>电话</th><th width=15% nowrap>联系人</th>
    							<th width=15% nowrap>地址</th><th width=15% nowrap>发布时间</th><th width=8%  nowrap></th><th width=6%></th></tr>";
		echo "<tr class='tr' style='height:36px;'>";
		echo "<td>".$house->getPOD_NO()."</td>";
		echo "<td>".$house->getRoomCount()."室".$house->getHallCount()."厅".$house->getToiletCount()."卫</td>";
		echo "<td>".$house->getArea()."</td><td>".$house->getPrice()."</td><td>".$house->getPhone()."</td>";
		echo "<td>".$house->getLinkman()."</td><td>".$house->getAddress()."</td><td>".$house->getTime()."</td>";
		echo "<td><a style='float:right;' class='pass' onclick=\"pass(".$house->getPOD_NO().")\";>√</a></td>";
		echo "<td><a style='float:right;' class='del' onclick=\"notpass(".$house->getPOD_NO().")\";>×</a></td>";
	}
?>
<script>
function pass(POD){
	$.post("checkhouse.php",
			{
			action:"pass",
			id:POD
			},
			function(data,status){
				//alert(data)
				if(status=="success"){
					//alert(data)
					if(data==1)
						window.location.href="checkhouse.php"
					else{
						alert("操作失败！")
						window.location.href="checkhouse.php"
					}	
				}
			})
}

function notpass(POD){
	var str = prompt("请输不予通过的原因:","");
	if(str==null)
		return
	$.post("checkhouse.php",
			{
			action:"notpass",
			id:POD,
			reason:str
			},
			function(data,status){
				//alert(data)
				if(status=="success"){
					if(data=="1"){
						window.location.href="checkhouse.php"
					}else{
						alert("操作失败！")
						window.location.href="checkhouse.php"
					}	
				}
			})
}

</script>

</table>
</div>
</body>
</html>
                    