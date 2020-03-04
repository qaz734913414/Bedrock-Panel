<?php
	# 载入配置文件
		if(file_exists(Config_Path."bp-config.php"))include Config_Path."bp-config.php";
	
	# 载入函数库
		include Lib_Path."/get_url.php";
		include Lib_Path."/bds.php";
	
	# 载入临时变量
		//echo '正在载入临时变量<br />';
	
	# 载入插件中
		//echo '正在载入插件中<br />';
	
	# 载入语言文件
		//echo '正在载入语言<br />';
	
	# 载入主题
		define('Theme_Enable_Path',	Theme_Path.'mdui-1.0'	);//当前主题目录-绝对路径（临时写法）
		define('Theme_Enable_Url',	str_replace($_SERVER['DOCUMENT_ROOT'], '' , Theme_Enable_Path)	);//当前主题目录-相对路径（临时写法）
