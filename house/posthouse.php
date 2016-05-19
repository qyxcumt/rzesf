<?php
require_once '../core/House.php';
require_once '../core/user.php';

?>

<html>
<head>
<title>发布房源</title>
<link rel="stylesheet" href="../css/style.css">
<script src="../js/jquery-2.0.3.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
    if(top==self){window.location.href("../user")} //限定在框架内打开
</script>
</head>
<body style="margin:auto;text-align:center;">
<?php
if(isset($_POST['POD'])){
	$user=new user($_SESSION['user']);
	$id=$user->getID();
	waittingHouse::addHouse($_POST['POD'], $_POST['obligee'], $_POST['region'], $_POST['address'], $_POST['area'], $_POST['room'], $_POST['hall'], $_POST['toilet'], $_POST['floor'], $_POST['floor_count'], $_POST['fitment'], $_POST['price'], $_POST['AOB'], $_POST['linkman'], $_POST['phone'], $id);

}else{
	echo "
		<div style=\"text-align:left;margin:0 auto;width:30%;\">
		<form method=\"post\" name=\"form1\" action=\"posthouse.php\"  class=\"form\">
			<label style=\"color:black;\">房产证号：</label><input  style=\"color:#000;\" type=\"text\" tabIndex=\"1\" id=\"POD\" name=\"POD\"></br>
			<label style=\"color:black;\">&nbsp&nbsp&nbsp&nbsp&nbsp权利人：</label><input style=\"color:#000;\" type=\"text\" tabIndex=\"2\" id=\"obligee\" name=\"obligee\"></br>
			<label style=\"color:black;\">区域：</label><select tabIndex=\"3\ name=\"region\" id=\"region\">
				<option value =\"1\">东港区</option>
				<option value =\"2\">岚山区</option>
				<option value=\"3\">五莲县</option>
				<option value=\"4\">莒县</option>
			</select></br>
			<label style=\"color:black;\">地址：</label><input style=\"color:#000;\" type=\"text\" tabIndex=\"4\" id=\"address\" name=\"address\"></br>
			<label style=\"color:black;\">面积：</label><input style=\"color:#000;\" type=\"text\" tabIndex=\"5\" id=\"area\" name=\"area\"></br>
			<input style=\"color:#000;width:20px;\" type=\"text\" tabIndex=\"6\" id=\"room\" name=\"room\"><label style=\"color:black;\">室</label><input style=\"color:#000;width:20px;\" type=\"text\" tabIndex=\"7\" id=\"hall\" name=\"hall\"><label style=\"color:black;\">厅</label><input style=\"color:#000;width:20px;\" type=\"text\" tabIndex=\"8\" id=\"toilet\" name=\"toilet\"><label style=\"color:black;\">卫</label></br>
			<input style=\"color:#000;width:30px;\" type=\"text\" tabIndex=\"9\" id=\"floor\" name=\"floor\"><label style=\"color:black;\"><label style=\"color:black;\">层，共</label><input style=\"color:#000;width:30px;\" type=\"text\" tabIndex=\"10\" id=\"floor_count\" name=\"floor_count\"><label style=\"color:black;\">层</label></br>
			<label style=\"color:black;\">装修：</label><select tabIndex=\"11\" id=\"fitment\" name=\"fitment\">
				<option value =\"1\">毛坯房</option>
				<option value =\"2\">简装修</option>
				<option value=\"3\">精装修</option>
			</select></br>
			<label style=\"color:black;\">价格：</label><input style=\"color:#000;\" type=\"text\" tabIndex=\"12\" id=\"price\" name=\"price\"></br>
			<label style=\"color:black;\">其他说明：</label><input style=\"color:#000;\" type=\"text\" tabIndex=\"13\" id=\"AOB\" name=\"AOB\"></br>
			<label style=\"color:black;\">联系人：</label><input style=\"color:#000;\" type=\"text\" tabIndex=\"14\" id=\"linkman\" name=\"linkman\"></br>
			<label style=\"color:black;\">电话：</label><input style=\"color:#000;\" type=\"text\" tabIndex=\"15\" id=\"phone\" name=\"phone\"></br>
			<button type=\"submit\" id=\"register-button\" tabIndex=\"16\">注册</button>
		</form>
		</div>
			";
}
?>
</body>
</html>
