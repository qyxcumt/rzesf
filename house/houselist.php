<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/core/user.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/core/house.php';

$user=new user($_SESSION['user']);
$id=$user->getID();
$type;
switch($_GET['type']){
	case "checked":
		$type="已通过审核房源";
		$houseList=house::getHouseTablebyPublisher($id);
		break;
	case "waitting":
		$type="待审核房源";
		$houseList=house::getWaittingHousebyPublisher($id);
		break;
	case "notpassed":
		$type="未通过审核房源";
		$houseList=house::getnotPassedHousebyPublisher($id);
		break;
	case "trading":
		$type="正在交易房源";
		$houseList=house::getTradingHousebyPublisher($id);
		break;
	case "traded":
		$type="已完成交易房源";
		$houseList=house::getTradedHousebyPublisher($id);
		break;
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
                <th style="text-align:left;padding-left:15px;font-size:30px;font-weight:300;line-height:50px;color:#fff;background-color:#3b424d;" colspan="8" nowrap><?php echo $type;?>
                    <!--a href="newsAdd.php" id="add" class="add">添加通知</a--></th></tr>
            
					<?php
 						if (isset($_GET['pn'])) $pn=$_GET['pn'];
                         else $pn=1;
                         $first=0+($pn-1)*10;
                         $full=10+($pn-1)*10;
						 $pa=1;
						if((count ($houseList)== 0)||($first>=count ($houseList)) ){
                            echo"<tr><td colspan='8' nowrap style='font-size:24px'>没有".$type."</td></tr>";
						} else 
                        {
                            $pa=(int)((count ($houseList)-1)/10)+1;
                             if ($pn==$pa) $full=count($houseList);
                            echo"<tr style='color:#33AAEE;height:35px;  font-weight: 200;border-bottom:1px solid #999'>
                                <th width=5% nowrap>户型</th><th nowrap>面积</th><th width=10% nowrap>价格(万)</th>
                                <th width=15% nowrap>电话</th><th width=15% nowrap>联系人</th>
    							<th width=15% nowrap>地址</th><th width=15% nowrap>发布时间</th><th width=8%  nowrap></th><th width=6%></th></tr>";
                                
							for($i = $first; $i < $full; $i++) {
						  		$row = $houseList[$i];
						  		$analysor=new HouseDataAnalyser($row);
                                $check="check".$i;
                            	echo 
                                   "<tr class='tr' style='height:36px;'>
                                    <td>".$analysor->getRoomCount()."室".$analysor->getHallCount()."厅".$analysor->getToiletCount()."卫"."</td><td>".$analysor->getArea()."</td>
                                    <td>".$analysor->getPrice()."</td><td>".$analysor->getPhone()."</td>
                                	<td>".$analysor->getLinkman()."</td><td>".$analysor->getAddress()."</td><td>".$analysor->getTime()."</td>";
                                    if($_GET['type']=="checked"||$_GET['type']=="waitting") echo "<td><a style='float:right;' class='del' href='housedel.php?type=".$_GET['type']."&POD=".$analysor->getPOD_NO()."';>×</a></td>";
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
                            echo "<button type='button' id='all'>全选</button><button type='button' id='reverse'>反选</button>
                            	<button type='button' class='dela' onclick='delm()'>删除</button>
                        		</div>
                       			</td></tr>";
                        }
                        ?>
		</table>
   	</div> 
<script>
 $("#list").click(function(){
	allchk();
});
$("#all").click(function(){
        if(!$(this).hasClass('on')){
        $("#list :checkbox").prop("checked", true);
        }
        else {
        $("#list :checkbox").prop("checked", false);
		}
});
 $("#reverse").click(function () {  
    $("#list :checkbox").each(function () {   
        $(this).prop("checked", !$(this).prop("checked"));   
    });
    allchk();
});
	function allchk(){ 
    	var chknum = $("#list :checkbox").size();//选项总个数 
    	var chk = 0; 
   	 	$("#list :checkbox").each(function () {   
        	if($(this).prop("checked")==true){ chk++; } 
   	 	}); 
    	if(chknum==chk){//全选 
        	$("#all").addClass('on');
    	}else{//不全选 
        	$("#all").removeClass('on');
        } 
    } 
        
    function topage(pn){
        	window.location ="?pn="+pn;//跳页
    }
    
    function del(id){
        if(confirm("确认删除吗？")){
            window.location ="../house/HouseAction.php?action=del&POD_ID="+id;
        }
     }
    
	function note(nID, nTitle, lID){
    	this.nID = nID;
    	this.nTitle = nTitle;
    	this.lID = lID;
	}    
    
    function delm(){ 
    	var chknum = $("#list :checkbox").size();//选项总个数 
    	var chkdn = 0; 
       
        var tArr = [];
        var chkd = new Array();
        var name;
   	 	$("#list :checkbox").each(function () {   
        	if($(this).prop("checked")==true){              
                tArr.push(new note($(this).prop("name"),$(this).attr("nTitle"),$(this).attr("lID")));
                chkdn++; 
            } 
   	 	});
        if(chkdn==0){
        	alert('未选中任何项');
        }else if(chkdn==1){
            del(tArr[0].nID,tArr[0].nTitle,tArr[0].lID);
        }else {
            if(chkdn==chknum){ac='确认删除本页全部通知（'+chkdn+'则）吗？';pn=<?php echo $pn-1==0?1:$pn-1; ?>;}
        	else{ac='确认删除“'+tArr[0].nTitle+'”等'+chkdn+'则通知吗？';pn=<?php echo $pn; ?>;}
            if(confirm(ac)) 
            {	list="&pn="+pn+"&total="+chkdn;
                for(i=0;i<chkdn;i++)
                {
                    list=list+"&nID"+i+"="+tArr[i].nID;
                }
             //alert(list);
             window.location ="../cons/NewsAction.php?action=delm&type=note"+list;
            }
               
        }
    } 

     


    
</script> 
</body>
</html>

