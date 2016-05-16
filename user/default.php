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
        <p style="font-size:36px;border-bottom:1px solid #eb6100">用户概况</p><br/>
        <p style="font-size:24px;">您有<?php echo $wattinghousecount ?>套二手房待审核，<?php echo $checkedhousecount ?>套已通过审核，<?php echo $notpasshousecount ?>套未通过审核，<?php echo $tradinghousecount ?>套正在进行交易，<?php echo $tradedhousecount ?>套已完成交易</p><br/>
        <p style="font-size:24px;">您有<?php echo $wattingdealcount ?>笔交易待审核，<?php echo $checkeddealcount ?>笔已通过审核，<?php echo $notpassdealcount ?>笔未通过审核</p><br/>
		<p style="font-size:1em"><br/><?php echo says(); ?></p>
    </div>
         


</body>
</html>