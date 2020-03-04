<?php
if(!isset($_SESSION['user']) || empty($_SESSION['user']))die("您没有权限！");
$serverConfig=doAction("getConfig");
?>
<body>
  <header class="aui-bar aui-bar-nav header" id="header"> 
   <h1>Minecraft Bedrock Edition Server Web Control Center</h1> 
  </header>
  <div class="aui-content-padded" style="margin:0 auto;width:75%;height:100%"> 
   <br />
 <h2>配置服务器</h2>
  <p>请修改您服务器的信息</p>
  <br />
  <div class="aui-content aui-margin-b-15">
   <form name="input" action="/usr/api/configSet.php" method="post">
    <ul class="aui-list aui-form-list">
     <li class="aui-list-header">配置信息正在收集</li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input"> 
		<select name="whitelist">
			<option value="on" <?php if($serverConfig['wl']=="true")echo "selected"; ?>>启用白名单</option>
			<option value="off" <?php if($serverConfig['wl']=="false")echo "selected"; ?>>禁用白名单</option>
		</select>
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
        <input type="text" name="desc" placeholder="服务器描述" value="<?php echo $serverConfig['md']; ?>" />
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
        <input type="text" name="maxp" placeholder="服务器最大玩家数量" value="<?php echo $serverConfig['mmp']; ?>" />
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="gamemode">
			<option value="c" <?php if($serverConfig['mm']=="creative")echo "selected"; ?>>模式：创造</option>
			<option value="s" <?php if($serverConfig['mm']=="survival")echo "selected"; ?>>模式：生存</option>
			<option value="a" <?php if($serverConfig['mm']=="adventure")echo "selected"; ?>>模式：冒险</option>
		</select>
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="diff">
			<option value="p" <?php if($serverConfig['df']=="peaceful")echo "selected"; ?>>难度：和平</option>
			<option value="e" <?php if($serverConfig['df']=="easy")echo "selected"; ?>>难度：简单</option>
			<option value="n" <?php if($serverConfig['df']=="normal")echo "selected"; ?>>难度：普通</option>
			<option value="h" <?php if($serverConfig['df']=="hard")echo "selected"; ?>>难度：困难</option>
		</select>
       </div>
	  </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="cheat">
			<option value="t" <?php if($serverConfig['ac']=="true")echo "selected"; ?>>作弊：开</option>
			<option value="f" <?php if($serverConfig['ac']=="false")echo "selected"; ?>>作弊：关</option>
		</select>
       </div>
	  </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="pp">
			<option value="v" <?php if($serverConfig['pp']=="visitor")echo "selected"; ?>>初始玩家身份：游客</option>
			<option value="m" <?php if($serverConfig['pp']=="member")echo "selected"; ?>>初始玩家身份：成员</option>
			<option value="o" <?php if($serverConfig['pp']=="operator")echo "selected"; ?>>初始玩家身份：操作员</option>
		</select>
       </div>
      </div></li>
     <div class="aui-content-padded">
      <input class="aui-btn aui-btn-block aui-btn-info" type="submit" value="确认修改" />
     </div>
    </ul>
   </form>
  </div>
 </body>
</html>
