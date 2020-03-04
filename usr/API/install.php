<?php
//引入头部文件
include "../Themes/Aui-1.0/head.php";

//引入弹窗代码
include "../Lib/toast.php";


//去除可能存在的安装状态文件
unlink("../install_lock");

//锁定安装状态
$install_stat=fopen("../install_lock", "w");
fwrite($install_stat,"Installing...");

//检查提交参数
if(empty($_POST['version']) || empty($_POST['whitelist']) || empty($_POST['desc']) || empty($_POST['maxp']) || empty($_POST['gamemode']) || empty($_POST['diff']) || empty($_POST['cheat']) || empty($_POST['pp']))
{
	unlink("../install_lock");
	die(makeToast("您未填写部分参数或填写的参数有误！"));
}

//执行安装命令
$instRes=exec("sudo mcchk d ".$_POST['version']);
if($instRes!=="true")//检查安装结果
{
	unlink("../install_lock");
	die(makeToast("无法安装MCBE服务端，请重试！"));
}

//保存用户设置
system("sudo mcchk wl ".$_POST['whitelist']);
system("sudo mcchk md \"".$_POST['desc']."\"");
system("sudo mcchk mmp ".$_POST['maxp']);
system("sudo mcchk mm ".$_POST['gamemode']);
system("sudo mcchk df ".$_POST['diff']);
system("sudo mcchk ac ".$_POST['cheat']);
if(isset($_POST['seed'])&&$_POST['seed']!="")system("sudo mcchk sd ".$_POST['seed']);
system("sudo mcchk pp ".$_POST['pp']);

//生成config.php代码
$user = "\$user=\"".$_POST['user']."\";";
$passMd5=md5($_POST['password']);
$password = "\$password=\"$passMd5\";";
$ip = '$ip=' . "file_get_contents('http://members.3322.org/dyndns/getip');";

//打开配置文件并写入
$config = fopen('../Config/bp-config.php', "w");
$write_config = fwrite($config, "<?php\n$user\n$password\n$ip\n");

//添加黑名单Crontab事件
system("sudo mcchk bi");

if ($write_config) {
	unlink("../install_lock");
    //unlink('../usr/Skin/install.php');
    //unlink('install.php');
	echo makeToast("安装成功！");
} else {
   die(makeToast("未知错误！"));
}
?>
