<?php
/*******************************************************************
**----------------------------------------------------------------**
****** 编写于2020-2-28 14:15 Star_caorui 未经授权,严禁盗用代码 *****
**----------------------------------------------------------------**
**写这段代码的时候,只有上帝和我知道它是干嘛的. 现在,只有上帝知道了**
**----------------------------------------------------------------**
*******************************************************************/


# 注册默认路径
define('Basic_Path',str_replace('\\','/',dirname(dirname(__FILE__))).'/');  //BP总目录
define('Lib_Path',				Basic_Path 	.'Lib'		);						//系统库目录
define('API_Path',				Basic_Path 	.'API/'		);						//API目录
define('Download_Path',    		Basic_Path 	.'Downloads/'	);					//下载目录
define('Log_Path',    			Basic_Path 	.'Logs/'	);						//日志目录
define('Plugin_Path',    		Basic_Path 	.'Plugins/'	);						//插件目录
define('Theme_Path',			Basic_Path 	.'Themes/'	);						//主题目录
define('Language_Path',			Basic_Path 	.'Language/'	);						//语言默认目录
define('Config_Path',			Basic_Path 	.'Config/'	);						//配置文件目录
define('Plugin_Config_Path',	Config_Path .'Plugins/'	);							//插件配置文件目录
define('Theme_Config_Path',		Config_Path .'Themes/'	);							//主题配置文件目录
define('User_Config_Path',		Config_Path .'Users/'	);							//用户配置文件目录
define('Server_Config_Path',	Config_Path .'Servers/'	);							//服务器配置文件目录

# 注册默认Url
define('Web_Root_Url',	$_SERVER['SERVER_NAME'].str_replace('/usr/', '' , str_replace($_SERVER['DOCUMENT_ROOT'], '' , Basic_Path))	);//Web根目录