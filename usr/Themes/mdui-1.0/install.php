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
        <div class="mdui-card-primary-title">欢迎使用Bedrock-Panel</div>
      </div>
    </div>
        </div>
    <div class="mdui-tab mdui-tab-full-width disable" id="instab" mdui-tab>
  <a href="#step1" class="mdui-ripple">Step 1: 配置面板</a>
  <a href="#step2" class="mdui-ripple">Step 2: 配置BDS</a>
</div>
    <div class="mdui-progress" style="display:none;" id="prgs">
  <div class="mdui-progress-indeterminate"></div>
</div>
        <div class="mdui-card-content">
            <div id="step1" class="mdui-p-a-2">
            <div class="mdui-textfield mdui-textfield-floating-label">
              <i class="mdui-icon material-icons">account_circle</i>
              <label class="mdui-textfield-label">设置您的用户名</label>
              <input class="mdui-textfield-input" name="username" id="username"></input>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
              <i class="mdui-icon material-icons">lock</i>
              <label class="mdui-textfield-label">设置您的密码</label>
              <input class="mdui-textfield-input" name="password" type="password"  id="password"></input>
            </div>
            </div>
            <div id="step2" class="mdui-p-a-2">
            <div class="mdui-textfield mdui-textfield-floating-label">
              <i class="mdui-icon material-icons">description</i>
              <label class="mdui-textfield-label">设置您的服务器描述</label>
              <input class="mdui-textfield-input" name="desc" id="desc"></input>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
              <i class="mdui-icon material-icons">supervisor_accounts</i>
              <label class="mdui-textfield-label">设置服务器最大玩家数量</label>
              <input class="mdui-textfield-input" name="maxp" id="maxp" oninput="this.value=this.value.replace(/\D/g,'')"></input>
            </div>
            <div class="mdui-textfield mdui-textfield-floating-label">
              <i class="mdui-icon material-icons">golf_course</i>
              <label class="mdui-textfield-label">设置服务器种子（可不填）</label>
              <input class="mdui-textfield-input" name="seed" id="seed"></input>
            </div>
            <div class="mdui-row">
                <div class="mdui-col-xs-1"><i class="mdui-icon material-icons" style="bottom:8px;padding:6px;color:rgba(0,0,0,.54);">update</i></div>
                <div class="mdui-col-xs-11"><select id="version" class="mdui-select" mdui-select>
        			<option disabled selected>请选择服务器版本</option>
        			<option value="1.14.30.2">服务器版本：1.14.30.2</option>
                    <option value="1.14.21.0">服务器版本：1.14.21.0</option>
                    <option value="1.14.20.1">服务器版本：1.14.20.1</option>
                    <option value="1.14.1.4">服务器版本：1.14.1.4</option>
                    <option value="1.14.0.9">服务器版本：1.14.0.9</option>
                    <option value="1.13.3.0">服务器版本：1.13.3.0</option>
                    <option value="1.13.2.0">服务器版本：1.13.2.0</option>
                    <option value="1.13.1.5">服务器版本：1.13.1.5</option>
                    <option value="1.13.0.34">服务器版本：1.13.0.34</option>
                    <option value="1.12.1.1">服务器版本：1.12.1.1</option>
                    <option value="1.12.0.28">服务器版本：1.12.0.28</option>
                    <option value="1.11.4.2">服务器版本：1.11.4.2</option>
                    <option value="1.11.2.1">服务器版本：1.11.2.1</option>
                    <option value="1.11.1.2">服务器版本：1.11.1.2</option>
                    <option value="1.11.0.23">服务器版本：1.11.0.23</option>
                    <option value="1.10.0.7">服务器版本：1.10.0.7</option>
                    <option value="1.9.0.15">服务器版本：1.9.0.15</option>
                    <option value="1.8.1.2">服务器版本：1.8.1.2</option>
                    <option value="1.8.0.24">服务器版本：1.8.0.24</option>
                    <option value="1.7.0.13">服务器版本：1.7.0.13</option>
                    <option value="1.6.1.0">服务器版本：1.6.1.0</option>
                    <option value="1.6.0.15">服务器版本：1.6.0.15</option>
    		</select></div>
        </div>
        <div class="mdui-row">
                <div class="mdui-col-xs-1"><i class="mdui-icon material-icons" style="bottom:8px;padding:6px;color:rgba(0,0,0,.54);">playlist_add_check</i></div>
                <div class="mdui-col-xs-11"><select id="whitelist" class="mdui-select" mdui-select>
        			<option selected disabled>请选择服务器白名单配置</option>
        			<option value="on">启用白名单</option>
        			<option value="off">禁用白名单</option>
    		</select></div>
        </div>
        <div class="mdui-row">
                <div class="mdui-col-xs-1"><i class="mdui-icon material-icons" style="bottom:8px;padding:6px;color:rgba(0,0,0,.54);">gamepad</i></div>
                <div class="mdui-col-xs-11"><select id="gamemode" class="mdui-select" mdui-select>
        			<option selected disabled>请选择游戏模式</option>
        			<option value="c">模式：创造</option>
        			<option value="s">模式：生存</option>
        			<option value="a">模式：冒险</option>
    		</select></div>
        </div>
        <div class="mdui-row">
                <div class="mdui-col-xs-1"><i class="mdui-icon material-icons" style="bottom:8px;padding:6px;color:rgba(0,0,0,.54);">developer_mode</i></div>
                <div class="mdui-col-xs-11"><select id="cheat" class="mdui-select" mdui-select>
        			<option selected disabled>请选择是否允许作弊</option>
        			<option value="t">作弊：开</option>
        			<option value="f">作弊：关</option>
    		</select></div>
        </div>
        <div class="mdui-row">
                <div class="mdui-col-xs-1"><i class="mdui-icon material-icons" style="bottom:8px;padding:6px;color:rgba(0,0,0,.54);">people</i></div>
                <div c            $("html,body").animate({
                scrollTop: 0
            }, 500);lass="mdui-col-xs-11"><select id="pp" class="mdui-select" mdui-select>
        			<option selected disabled>请选择玩家初始身份</option>
        			<option value="v">初始玩家身份：游客</option>
        			<option value="m">初始玩家身份：成员</option>
        			<option value="o">初始玩家身份：操作员</option>
    		</select></div>
        </div>
        </div>
        </div>
        <div class="mdui-card-actions">
          <button class="mdui-btn mdui-ripple" id="tryInstall">下一步</button>
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
    }            $("html,body").animate({
                scrollTop: 0
            }, 500);
}
.mdui-row
{
    margin-top:1em;
}
.mdui-card
{
    overflow:visible;
}
.mdui-col-xs-11 .mdui-select
{
    width: calc(100% - 1em);
    margin-left:1em;
}
.disable {
    pointer-events: none;
}
</style>
<script src="<?php echo Theme_Enable_Url; ?>/scripts/mdui.min.js"></script>
<script>
    var instab=new mdui.Tab("#instab");
    function nextstep()
    {
        var Obj={user:"",password:""};
        Obj.user=$("#username").val();
        Obj.password=$("#password").val();
        if(Obj.user===""||Obj.password==="")
        {
            toastr.error("请填写所有必填项！");
            return;
        }
		else
		{
			var prgs=$("#prgs");
			prgs.attr("style","");
            toastr.success("安装正在进行！");
			/*$.ajax({
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
						toastr.success("配置成功，即将进入下一步");
						instab.next();
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
                    $(".mdui-card-content").removeClass("disable");
                    $(".mdui-card-actions").removeClass("disable");
                }
			});*/
		}
        
    }
    function install()
	{
		var Obj={desc:"",maxp:"",seed:"",version:"",gamemode:"",cheat:"",pp:""};
        Obj.desc=$("#desc").val();
        Obj.maxp=$("#maxp").val();
        Obj.seed=$("#seed").val();
        Obj.version=$("#version").val();
        Obj.gamemode=$("#gamemode").val();
        Obj.cheat=$("#cheat").val();
        Obj.pp=$("#pp").val();
        if(Obj.user===""||Obj.password===""||Obj.desc===""||Obj.maxp===""||Obj.version===null||Obj.gamemode===null||Obj.cheat===null||Obj.pp===null)
        {
            toastr.error("请填写所有必填项！");
            return;
        }
		else
		{
            $("html,body").animate({
                scrollTop: 0
            }, 500);
			var prgs=$("#prgs");
			prgs.attr("style","");
            $(".mdui-card-content").addClass("disable");
            $(".mdui-card-actions").addClass("disable");
            toastr.success("一切顺利，安装正在进行！");
			/*$.ajax({
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
			});*/
		}
    }
    $(document).ready(function (){
		document.title="安装 - Bedrock-Panel";
        $(".mdui-tab-indicator")[1].remove();
    });
    tryInstall.onclick = nextstep;
</script>
