<?php
include "../Config/config.php";
include Lib_Path."/bds.php";
include Lib_Path."/data-utils.php";
session_start();

$ret=array();
$ret['code']=200;
$ret['info']="";
if(isset($_POST['apiKey']))
{
	$ret['code']=404;
	$ret['info']="该功能暂未开发";
	echo rplyJson($ret);
	exit;
}
elseif(!isset($_SESSION['user']) || empty($_SESSION['user']) || !file_exists(Config_Path."bp-config.php"))
{
	$ret['code']=401;
	$ret['info']="身份验证出现问题";
	echo rplyJson($ret);
	exit;
}
switch($_GET['action']) {
	case "config":
		include "../skin/config.php";
		break;
	case "on":
		if(doAction("on"))
		{
			$ret['info']="执行成功！";
		}
		else
		{
			$ret['code']=500;
			$ret['info']="执行失败，请重试！";
		}
		break;
	case "off":
		if(doAction("off"))
		{
			$ret['info']="执行成功！";
		}
		else
		{
			$ret['code']=500;
			$ret['info']="执行失败，请重试！";
		}
		break;
	case "serverStatus":
		$ret=getStatus();
        $ret['code']=200;
        break;
	case "doAction":
		if(preg_match('/^(?:wa|wr|ba|br|op|deop|runcmd)$/',$_POST['op']))
		{
			$op=$_POST['op'];
			if(!empty($_POST['para1']))$para1=$_POST['para1'];
			else $para1="";
			if($op=="runcmd")
			{
				$ret['info']="执行结果：<br />".doAction($op,$para1);
			}
			else
			{
				$res=doAction($op,$para1);
				if($res==true)$ret['info']="执行成功！";
				else {
					$ret['code']=500;
					$ret['info']="执行失败，请重试！";
				}
			}
		}
		break;
}
echo rplyJson($ret);
?>
