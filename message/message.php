<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/deal.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/house.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/message.php';
$user=new user($_SESSION['user']);
$id=$user->getID();
$messageList=message::getMessage($id);
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
                <th style="text-align:left;padding-left:15px;font-size:30px;font-weight:300;line-height:50px;color:#fff;background-color:#3b424d;" colspan="8" nowrap>我的消息</th></tr>
<?php
 						if (isset($_GET['pn'])) $pn=$_GET['pn'];
                         else $pn=1;
                         $first=0+($pn-1)*10;
                         $full=10+($pn-1)*10;
						 $pa=1;
						if((count ($messageList)== 0)||($first>=count ($messageList)) ){
                            echo"<tr><td colspan='8' nowrap style='font-size:24px'>没有消息</td></tr>";
						} else 
                        {
                            $pa=(int)((count ($messageList)-1)/10)+1;
                             if ($pn==$pa) $full=count($messageList);
                            echo"<tr style='color:#33AAEE;height:35px;  font-weight: 200;border-bottom:1px solid #999'>
                                <th width=90% nowrap>内容</th><th width=10% nowrap>时间</th>
                				</th></tr>";
                                
							for($i = $first; $i < $full; $i++) {
						  		$row = $messageList[$i];
                                $check="check".$i;
                            	echo 
                                   "<tr class='tr' style='height:36px;'>
                                    <td>".$row[1]."</td><td>".$row[4]."</td>";
                        		echo "</tr>";

                     		}
							echo"<tr style='height:20px;'/>
            					<tr style='height:40px;background-color:#DDD'>
                                <td style='color:#3b424d;text-align:left;padding-left:20px;font-size:14px;font-weight:300;line-height:40px;' colspan='8' nowrap>
                				".$pn."/".$pa."
                				<div style='float:right;'>";
                            if (($pn>1)&&($pa>2)) echo"
                            <button type='button' onclick='topage(1)'>首页</button>";
                            if ($pn>1) echo"
                            <button type='button' onclick='topage(".($pn-1).")'>上一页</button>";
                            if ($pn<$pa) echo"
                            <button type='button' onclick='topage(".($pn+1).")'>下一页</button>";
                            if (($pn<$pa)&&($pa>2)) echo"
                            <button type='button' onclick='topage(".$pa.")'>尾页</button>";
                            echo "
                        		</div>
                       			</td></tr>";
                        }
                        ?>
		</table>
   	</div> 
   	</body>
   	</html>