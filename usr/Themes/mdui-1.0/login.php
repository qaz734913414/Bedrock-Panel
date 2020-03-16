<body class="mdui-appbar-with-toolbar mdui-appbar-with-tab mdui-theme-primary-light-blue mdui-theme-accent-light-blue <?php if(isset($_COOKIE['darkmode'])&&$_COOKIE['darkmode']=="dark")echo "mdui-theme-layout-dark"; ?>"> 
<div class="mdui-appbar mdui-appbar-fixed">
	<div class="mdui-toolbar mdui-color-light-blue mdui-text-color-white">
		<a href="javascript:;" class="mdui-typo-title mdui-text-color-white">Bedrock-Panel</a>
		<div class="mdui-toolbar-spacer">
		</div>
	</div>
</div>
<div class="mdui-container">
      <div class="mdui-card">
        <div class="mdui-card-media">
          <img src="<?php if(isset($_COOKIE['darkmode'])&&$_COOKIE['darkmode']=="dark")echo Theme_Enable_Url."/img/card.jpg"; else echo Theme_Enable_Url."/img/index.jpg" ?>"/>
          <div class="mdui-card-media-covered mdui-card-media-covered-transparent">
      <div class="mdui-card-primary">
        <div class="mdui-card-primary-title">用户登录</div>
      </div>
    </div>
        </div>
    <div class="mdui-progress" style="display:none;" id="prgs">
  <div class="mdui-progress-indeterminate"></div>
</div>
        <div class="mdui-card-content">
            <div class="mdui-textfield mdui-textfield-floating-label">
              <i class="mdui-icon material-icons">account_circle</i>
              <label class="mdui-textfield-label">用户名</label>
              <input class="mdui-textfield-input" name="username" id="username"></input>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
              <i class="mdui-icon material-icons">lock</i>
              <label class="mdui-textfield-label">密码</label>
              <input class="mdui-textfield-input" name="password" type="password"  id="password"></input>
            </div>
            <span style="color:red;" id="errorInject"></span>
        </div>
        <div class="mdui-card-actions">
          <button class="mdui-btn mdui-ripple" id="tryLogin">登录</button>
        </div>
      </div>
</div>
<style>
@media all and (min-width: 500px) {
    .mdui-container {
       max-width: 500px;
    }
    .mdui-card-media img {
        max-height: 35vh;
    }
}
</style>
<script src="<?php echo Theme_Enable_Url; ?>/scripts/mdui.min.js"></script>
<script>
    function login()
	{
		var loginObj={user:"",password:""};
        loginObj.user=$("#username").val();
        loginObj.password=$("#password").val();
        if(loginObj.user===""||loginObj.password==="")
        {
            toastr.error("请填写用户名和密码！");
		}
		else
		{
			var prgs=$("#prgs");
			prgs.attr("style","");
			$.ajax({
				url:"<?php echo bp_api_url(); ?>/api.php?type=web&action=login",
				dataType:"json",
				data:loginObj,
				type:"POST",
				xhrFields:{
					withCredentials: true
				},
				success:function(data)
				{
					if(data.code===200)
					{
						localStorage.setItem("username",loginObj.user)
						toastr.success("登录成功，将在2秒后跳转！");
						setTimeout("location.reload();",2000);
					}
					else
					{
						toastr.error("用户名或密码错误，请重试！");
					}
				},
				error:function()
				{
					toastr.error("无法连接至服务器！");
				},
                complete:function()
                {
                    prgs.attr("style","display:none;");
                }
			});
		}
    }
    $(document).ready(function (){
        document.title="登录 - Bedrock-Panel";
        $("#password").keypress(function (e) {
                 if (e.which == 13) {
                     login();
                 }
        });
    });
    tryLogin.onclick = login;
</script>
