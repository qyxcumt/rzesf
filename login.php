<?php
require_once 'browser.php';

session_start();
//在页首先要开启session,
//error_reporting(2047);
//注销session
$_SESSION=array();
//将session去掉，以每次都能取新的session值;
//用seesion 效果不错，也很方便
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-2.0.3.min.js"></script>
<script src="js/md5.js"></script>  
<script>
    if(top==self){window.location.href("../")} //限定在框架内打开
</script>
</head>
<script>
    function signin(){
    	$(".AjaxAdd").remove();
		var ret=true;
		if(document.forms[0].validate.value==""){
			$("#validate").before("<div class=\"AjaxAdd\" type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>请输入验证码</div>");
			ret=false;
		}
		if(document.forms[0].username.value==""){
			$("#username").before("<div class=\"AjaxAdd\" type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>请输入用户名</div>");
			ret=false;
		}
		if(document.forms[0].password.value==""){
			$("#password").before("<div class=\"AjaxAdd\" type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>请输入密码</div>");
			ret=false;
		}
		if(ret)
			document.forms[0].password.value=hex_md5(document.forms[0].password.value);
		return ret;
    }
    /*
    function enterIn(evt){
  	  var evt=evt?evt:(window.event?window.event:null);//兼容IE和FF
  	  if (evt.keyCode==13){
      document.getElementById("login-button").click()
  	  }
  	}*/           
</script>  
    <body > 
        <div class="container">
			<h1>系统登录</h1>
			<form class="form" method="post" name="form1" action="/cons/loginProcess.php" onSubmit="return signin();">
				<input class="textbox" type="text" placeholder="用户名" tabIndex="1" id="username" name="username" >
                <input class="textbox" type="password" placeholder="密码" tabIndex="2" id="password" name="password" oncopy="return false;" onpaste="return false;" oncut="return false;">
                <input class="textbox" type="text" id="validate" placeholder="验证码" tabIndex="3"  name="validate" autocomplete="off">
                <img id="validateCode" title="点击刷新" src="./captcha.php" onclick="this.src='captcha.php?'+Math.random();"><br/>
                <input type="radio" checked="checked" name="role" value="user" tabIndex="4" />用户 &nbsp&nbsp&nbsp&nbsp
                <input type="radio"  name="role" value="zgbm" tabIndex="5" />主管部门</br>
                <button type="submit" id="login-button" tabIndex="6">登录</button>
                
<?php  

        //接受errno
 if (!empty($_GET['errno']))
 {
     switch($_GET['errno']){
         case 1:$warning="请正确输入用户名";$a='username';break;
         case 2:$warning="请输入密码";$a='password';break;
         case 3:$warning="请不要无视附加码";break;
         case 4:$warning="验证码不正确";break;
         case 5:$warning="用户名或密码不正确";break;      
	}
 if(isset($a)){
    echo "<script>
    $('#".$a."').val('');
    $('#".$a."').focus();
    </script>";
 }
 echo"
    <div type='text' id='alertcontent''>".$warning."</div>
        ";
    
}

?> 
                
			</form> 
        </div>

</body>
</html> 