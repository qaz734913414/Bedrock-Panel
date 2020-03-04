<?php
session_start();
if(isset($_SESSION['user']) && !empty($_SESSION['user']))
{
	if(isset($_POST['whitelist'])&&$_POST['whitelist']!="")system("sudo mcchk wl ".$_POST['whitelist']);
	if(isset($_POST['desc'])&&$_POST['desc']!="")system("sudo mcchk md \"".$_POST['desc']."\"");
	if(isset($_POST['maxp'])&&$_POST['maxp']!="")system("sudo mcchk mmp ".$_POST['maxp']);
	if(isset($_POST['gamemode'])&&$_POST['gamemode']!="")system("sudo mcchk mm ".$_POST['gamemode']);
	if(isset($_POST['diff'])&&$_POST['diff']!="")system("sudo mcchk df ".$_POST['diff']);
	if(isset($_POST['cheat'])&&$_POST['cheat']!="")system("sudo mcchk ac ".$_POST['cheat']);
	if(isset($_POST['pp'])&&$_POST['pp']!="")system("sudo mcchk pp ".$_POST['pp']);
	echo "<script>alert(\"修改成功！重启MC服务器后生效！\");window.location.href=\"\/\";</script>";
}
else
{
	echo "<script>alert(\"致命错误，您未登录！\");window.location.href=\"\/\";</script>";
}
?>
