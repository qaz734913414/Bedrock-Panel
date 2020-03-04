<?php
if(!isset($_SESSION['user']) || empty($_SESSION['user']))die("您没有权限！");
?>
<body>
  <header class="aui-bar aui-bar-nav header" id="header"> 
   <h1>Minecraft Bedrock Edition Server Web Control Center</h1> 
  </header> 
  <div class="aui-content-padded" style="margin:0 auto;width:75%;height:100%"> 
   <br /> 
  <h2 class="aui-bar">Minecraft 网页控制后台</h2> 
  <div class="aui-content aui-margin-b-15"> 
   <ul class="aui-list aui-list-in"> 
    <li class="aui-list-header">服务器状态</li> 
    <li class="aui-list-item">
     <div class="aui-list-item-inner">
       IP/域名:<?php echo $GLOBALS['ip'];?>
     </div></li>
    <li class="aui-list-item"> 
     <div class="aui-list-item-inner">
       CPU:
      <div class="aui-progress aui-progress-sm" style="margin:0 auto;width:75%"> 
       <div class="aui-progress-bar" style="width:0%;"></div> 
      </div> 
     </div> </li> 
    <li class="aui-list-item"> 
     <div class="aui-list-item-inner">
       内存:
      <div class="aui-progress aui-progress-sm" style="margin:0 auto;width:75%"> 
       <div class="aui-progress-bar" style="width:0%;"></div> 
      </div> 
     </div> </li> 
    <li class="aui-list-item"> 
     <div class="aui-list-item-inner">
       硬盘:
      <div class="aui-progress aui-progress-sm" style="margin:0 auto;width:75%"> 
       <div class="aui-progress-bar" style="width:0%;"></div> 
      </div> 
     </div> </li> 
   </ul> 
  </div>   
<br />
 <div class="aui-content aui-margin-b-15"> 
   <ul class="aui-list aui-list-in"> 
   
    <li class="aui-list-header">MC服务器操作</li> 
	
    <li class="aui-list-item"> 
		<div class="aui-list-item-inner"> 
			<a href="" class="aui-btn aui-btn-primary aui-btn-block aui-btn-outlined aui-btn-sm" id="switchStat">未知操作</a>
		</div>
	</li>
	
	<li class="aui-list-item"> 
		<div class="aui-list-item-inner"> 
			<a href="/usr/API/action.php?action-old=config" class="aui-btn aui-btn-primary aui-btn-block aui-btn-outlined aui-btn-sm">配置服务器</a>
		</div>
	</li>
	
    <li class="aui-list-item"> 
		<div class="aui-list-item-inner">
			<form action="/usr/API/action.php?action=doAction" method="post">
			<input type="text" name='para1' id="ipt" placeholder="待执行的命令">
		</div>
	</li> 
	<li class="aui-list-item"> 
		<div class="aui-list-item-inner">
			<select name="op" id="opr">
                <option value="wa">操作：添加白名单</option>
                <option value="wr">操作：删除白名单</option>
				<option value="ba">操作：添加黑名单</option>
                <option value="br">操作：删除黑名单</option>
				<option value="op">操作：给玩家管理员权限</option>
                <option value="deop">操作：去除玩家管理员权限</option>
				<option value="runcmd" selected>操作：执行命令</option>
			</select>
		</div>
	</li>
    <li class="aui-list-item"> 
     <div class="aui-list-item-inner">
  <input class="aui-btn aui-btn-primary aui-btn-block aui-btn-outlined aui-btn-sm" type="submit" value="确认操作" />
	
</form>
     </div> </li> 
   </ul> 
  </div>
 <div class="aui-content aui-margin-b-15" <?php //if($user!=$adminuser)echo "display:none;"; ?>> 
   <ul class="aui-list aui-list-in"> 
    <li class="aui-list-header">面板操作</li> 
	 <li class="aui-list-item"> 
     <div class="aui-list-item-inner"> 
			<a href="/usr/API/action.php?action=users" class="aui-btn aui-btn-primary aui-btn-block aui-btn-outlined aui-btn-sm">面板用户管理</a>
     </div></li>
   </ul> 
  </div>
  <script>
		opr.onchange=function(){
			var ele1=document.getElementById("ipt");
			var e=document.getElementById("opr").selectedOptions[0].value;
			if(e=="wa"||e=="wr"||e=="ba"||e=="br"||e=="op"||e=="deop")
			{
				ele1.placeholder="玩家的Xbox ID";
			}
			else if(e=="runcmd")
			{
				ele1.placeholder="待执行的命令";
			}
		};
	</script>
 </body>
</html>
