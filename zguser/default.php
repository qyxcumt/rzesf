<?php 
	require_once $_SERVER['DOCUMENT_ROOT'].'/says.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/core/security.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/core/user.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/core/house.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/core/deal.php';
	require_once 'summary.php';
	
	
 ?>
<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link href="../css/edit.css" rel="stylesheet" type="text/css" /> 
<script>
    if(top==self){window.location.href("../user")} //限定在框架内打开
</script>
</head>
<body> 
        
    <div style="margin-top:10%;padding:0 50px;color:#294171">
        <p style="font-size:36px;border-bottom:1px solid #eb6100">待审核信息</p><br/>
        <p style="font-size:24px;">共有<?php echo $housecount ?>套二手房待审核</p><br/>
        <p style="font-size:24px;">共有<?php echo $dealcount ?>笔交易待审核</p><br/>
		<p style="font-size:1em"><br/><?php echo says(); ?></p>
    </div>



</body>
</html>