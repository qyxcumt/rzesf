<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<link rel="stylesheet" href="css/style.css">
<script src="js/jquery-2.2.3.min.js"></script>
<script src="js/md5.js"></script>  
<script>
    if(top==self){window.location.href("../")} //限定在框架内打开
</script>
</head>
<script>    
  	function check(){
  	  	$(".AjaxAdd").remove();
  	  	var ret=true;
  	  	if(document.forms[0].validate.value==""){
  	  	  	$("#validate").before("<div class=\"AjaxAdd\" type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>请输入验证码</div>");
  	  	  	ret=false;
  	  	}
  	  	if(document.forms[0].username.value==""){
  	  	  	$("#username").before("<div class=\"AjaxAdd\" type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>请输入用户名</div>");
  	  	  	ret=false;
  	  	}else {
  	  	  	if(document.forms[0].username.value.length>64){
  	  	  		$("#username").before("<div class=\"AjaxAdd\" type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>用户名应小于64个字符</div>");
  	  	  		ret=false;
  	  	  	}else{
  	  	  	  	var filter= /^[0-9a-zA-Z]*$/g;
  	  	  	  	if(!filter.test(document.forms[0].username.value)){
  	  	  	  		$("#username").before("<div class=\"AjaxAdd\" type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>用户名由英文字符和数字组成</div>");
  	  	  	  		ret=false;
  	  	  	  	}
  	  	  	}
  	  	}
  	  	if(document.forms[0].password.value==""){
  	  	  	$("#password").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>请输入密码</div>");
  	  	  	ret=false;
  	  	}
  	  	if(document.forms[0].password_confirm.value==""){
  	  	  	$("#password_confirm").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>请确认密码</div>");
  	  	  	ret=false;
  	  	}
		if(document.forms[0].password.value!=document.forms[0].password_confirm.value){
			$("#password").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>两次输入的密码不一致</div>");
			ret=false;
		}
		if(document.forms[0].name.value==""){
			$("#name").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>请输入姓名</div>");
			ret=false;
		}
		if(document.forms[0].ID_NO.value==""){
			$("#ID_NO").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>请输入身份证号</div>");
			ret=false;
		}
		if(document.forms[0].phone.value==""){
			$("#phone").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>请输入手机号</div>");
			ret=false;
		}

		var mailfilter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		if(document.forms[0].mail.value!=""&&!mailfilter.test(document.forms[0].mail.value)){
			$("#mail").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>邮箱格式错误</div>");
			ret=false;
		}
		if(document.forms[0].QQ.value!=""&&((document.forms[0].QQ.value.length<6||document.forms[0].QQ.value.length>13)||!isNaN(document.forms[0].QQ.value))){
			$("#QQ").before("<div type='text' class=\"AjaxAdd\" style='margin:10px 0px 0px 0px;'>QQ号格式错误</div>");
			ret=false;
		}
		document.forms[0].md5password.value=hex_md5(document.forms[0].password.value);
		return ret;
  	}
  	     
</script>  
    <body > 
        <div class="Register">
			<h1>用户注册</h1>
<?php  

        //接受errno
 if (!empty($_GET['errno']))
 {
     switch($_GET['errno']){
         case 1:$warning="我是验证码，请不要无视我::>_<::";break;
         case 2:$warning="用户名由字母和数字组成且小于64位";break;
         case 3:$warning="该用户名已被注册";break;
         case 4:$warning="请输入正确的身份证号";break;
         case 5:$warning="请输入正确的手机号";break;     
         case 6:$warning="请输入正确的邮箱";break;
         case 7:$warning="请输入正确的QQ号";break;
         case 8:$warning="该身份证号已被注册，请联系主管部门处理";break;
         case 9:$warning="验证码不正确";break;
	}

 echo"
    <div type='text' id='alertcontent' style='margin:10px 0px 0px 0px;'>".$warning."</div>
        ";
    
}

?>
			<form class="form" method="post" name="form1" action="/cons/registerProcess.php" onSubmit="return check();" >
				<input class="textbox" type="text" placeholder="用户名(必填)" tabIndex="1" id="username" name="username" value="" >
                <input class="textbox" type="password" placeholder="密码(必填)" tabIndex="2" id="password" name="password" oncopy="return false;" onpaste="return false;" oncut="return false;"><input type="hidden" name="md5password" class="text">
                <input class="textbox" type="password" placeholder="确认密码(必填)" tabIndex="3" id="password_confirm" name="password_confirm" oncopy="return false;" onpaste="return false;" oncut="return false;">
                <input class="textbox" type="text" placeholder="真实姓名(必填)" tabIndex="5" id="name" name="name">
                <input class="textbox" type="text" placeholder="身份证号(必填)" tabIndex="5" id="ID_NO" name="ID_NO">
                <input class="textbox" type="text" placeholder="手机号(必填)" tabIndex="6" id="phone" name="phone">
                <input class="textbox" type="text" placeholder="E-mail" tabIndex="7" id="mail" name="mail">
                <input class="textbox" type="text" placeholder="QQ" tabIndex="8" id="QQ" name="QQ">
                <input class="textbox" type="text" id="validate" placeholder="验证码" tabIndex="9"  name="validate" autocomplete="off">
                <img id="validateCode" title="点击刷新" src="./captcha.php" onclick="this.src='captcha.php?'+Math.random();"><br/>
                <button type="submit" id="register-button" tabIndex="10">注册</button>
 
                
			</form> 
        </div>
<script>
$('#alertcontent').hover(function (event) {
	event.preventDefault();
	$('#alertcontent').fadeOut(1000);
});
$('#login-button').click(function (event) {
	event.preventDefault();
	$('form').fadeOut(500);
	$('.wrapper').addClass('form-success');
});
    

</script>

</body>
</html> 