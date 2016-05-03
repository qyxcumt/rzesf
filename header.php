<?php 
$type='large';
if(isset($_SESSION['headertype'])) if($_SESSION['headertype']=='small') $type='small';
	echo "
    <div id='header' class='header ".$type."'>
        <div class='inner'>
            <h1><p><p1>山东省日照市</p1><p2>二手房交易系统</p2></p></h1>
            <ul class='nav'>";
            if(empty($_SESSION['user'])){
           	 	echo "<li><a href='index.html' >首页</a></li>
           	 			<li><a href='houses.html' title='查询房源'>房源</a></li>
                <li><a href='login.html' title='登录系统'>登录</a></li>
                <li><a href='register.html' title='注册新用户'>注册</a></li>
            </ul>
        </div>
	</div>";
            }else{
            	echo "<li><a href='index.html' >首页</a></li>
            		<li><a href='houses.html' title='查询房源'>房源</a></li>
                <li><a href='/user' title='个人中心'>个人中心</a></li>
                <li><a href='logout.php' title='注销登录'>注销</a></li>
            </ul>
        </div>
	</div>";
            }

		
		  

    /*               <li class='search'><input placeholder='搜索' onkeydown='enterIn(event);'></li>
                <li><a class='btn' href='#'><img src='imgs/magnifier.png'></a></li>
                */
?>