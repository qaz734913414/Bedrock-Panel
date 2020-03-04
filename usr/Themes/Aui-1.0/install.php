 <body>
  <header class="aui-bar aui-bar-nav header" id="header"> 
   <h1>Minecraft Bedrock Edition Server Web Control Center</h1> 
  </header>
  <div class="aui-content-padded" style="margin:0 auto;width:75%;height:100%"> 
   <br />
 <h2>正在安装</h2>
  <p>请输入一些关于您服务器的信息</p>
  <br />
  <div class="aui-content aui-margin-b-15">
   <form name="input" action="/usr/API/install.php" method="post">
    <ul class="aui-list aui-form-list">
     <li class="aui-list-header">配置信息正在收集</li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="version">
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
		</select>
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
        <input type="text" name="user" placeholder="用户名" />
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
        <input type="password" name="password" placeholder="密码" />
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input"> 
		<select name="whitelist">
			<option selected disabled>请选择服务器白名单配置</option>
			<option value="on">启用白名单</option>
			<option value="off">禁用白名单</option>
		</select>
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
        <input type="text" name="desc" placeholder="服务器描述" />
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
        <input type="text" name="maxp" placeholder="服务器最大玩家数量" />
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="gamemode">
			<option selected disabled>请选择游戏模式</option>
			<option value="c">模式：创造</option>
			<option value="s">模式：生存</option>
			<option value="a">模式：冒险</option>
		</select>
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="diff">
			<option selected disabled>请选择服务器难度</option>
			<option value="p">难度：和平</option>
			<option value="e">难度：简单</option>
			<option value="n">难度：普通</option>
			<option value="h">难度：困难</option>
		</select>
       </div>
	  </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="cheat">
			<option selected disabled>请选择是否允许作弊</option>
			<option value="t">作弊：开</option>
			<option value="f">作弊：关</option>
		</select>
       </div>
	  </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
        <input type="text" name="seed" placeholder="服务器种子（可不填）" />
       </div>
      </div></li>
     <li class="aui-list-item">
      <div class="aui-list-item-inner">
       <div class="aui-list-item-input">
		<select name="pp">
			<option selected disabled>请选择玩家初始身份</option>
			<option value="v">初始玩家身份：游客</option>
			<option value="m">初始玩家身份：成员</option>
			<option value="o">初始玩家身份：操作员</option>
		</select>
       </div>
      </div></li>
     <div class="aui-content-padded">
      <input class="aui-btn aui-btn-block aui-btn-info" type="submit" value="我已确认" />
     </div>
    </ul>
   </form>
  </div>
 </body>
</html>
