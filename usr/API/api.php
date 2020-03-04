<?php
include "../Config/config.php"; 

# 载入配置文件
include Config_Path."bp-config.php";

// BDS服务器操作函数导入
include Lib_Path."/bds.php";
// 登录Lib导入
include Lib_Path."/login.php";
//
include Lib_Path."/data-utils.php";

if (!$_GET['type']){
	$ret['code']=403;
	$ret['info']="未指明操作来源，非法请求，操作已被拦截。";
	echo rplyJson($ret);
	exit;
}
switch($_GET['action']) {
	case "login":
		login($_GET['type'],$_POST["user"],$_POST["password"]);
		break;
	case "bds":
		bds($_GET['type'],$_POST["user"],$_POST["password"]);
		break;
}
