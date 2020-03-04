<?php
//登录检测
session_start();
if (isset($_POST['user'])) {
    if ($_POST['user'] == $GLOBALS['user'] && md5($_POST['password']) == $GLOBALS['password']) {
        $_SESSION['user'] = $GLOBALS['user'];
        header('location:index.php');
    }
    else{
        $login_error = $GLOBALS['user'].$GLOBALS['password'].'登录失败，用户名或密码不正确';
		makeToast($login_error);
        exit;
    }
}
?>
<body>
<header class="aui-bar aui-bar-nav header" id="header">
<h1>Minecraft Bedrock Edition Server Web Control Center</h1>
</header>
<div class="aui-content-padded" style="margin:0 auto;width:75%;height:100%">
	<br/>
	<h2>正在等待登录</h2>
	<p>
		我们需要收集一些信息来继续
	</p>
	<br/>
	<div class="aui-content aui-margin-b-15">
		<form method="post">
			<ul class="aui-list aui-form-list">
				<li class="aui-list-header">输入您的账号密码来完成身份认证</li>
				<li class="aui-list-item">
				<div class="aui-list-item-inner">
					<div class="aui-list-item-input">
						<input type="text" name="user" placeholder="用户名"/>
					</div>
				</div>
				</li>
				<li class="aui-list-item">
				<div class="aui-list-item-inner">
					<div class="aui-list-item-input">
						<input type="password" name="password" placeholder="密码"/>
					</div>
				</div>
				</li>
				<div class="aui-content-padded">
					<input class="aui-btn aui-btn-block aui-btn-info" type="submit" value="我已确认"/>
				</div>
			</ul>
		</form>
	</div>
</div>
</body>
</html>
