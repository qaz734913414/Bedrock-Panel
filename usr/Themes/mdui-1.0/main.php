<body class="mdui-appbar-with-toolbar mdui-theme-primary-light-blue mdui-theme-accent-light-blue mdui-drawer-body-left <?php if(isset($_COOKIE['darkmode'])&&$_COOKIE['darkmode']=="dark")echo "mdui-theme-layout-dark"; ?>"> 
<?php include "sidebar.php"; ?>
<div class="mdui-appbar mdui-appbar-fixed">
	<div class="mdui-toolbar mdui-color-light-blue">
		<a href="javascript:;" class="mdui-btn mdui-btn-icon mdui-ripple mdui-ripple-white" mdui-drawer="{target: '#sidebar'}"><i class="mdui-icon material-icons mdui-text-color-white">menu</i></a>
		<a href="javascript:;" class="mdui-typo-title mdui-text-color-white">Bedrock-Panel</a>
		<div class="mdui-toolbar-spacer">
		</div>
	</div>
</div>
<div class="mdui-dialog" id="alert">
  <div class="mdui-dialog-title" id="alertTitle"></div>
  <div class="mdui-dialog-content" id="alertContent"></div>
  <div class="mdui-dialog-actions">
    <button class="mdui-btn mdui-ripple" id="alertCloseButton" onclick="closeAlert();">关闭</button>
  </div>
</div>
<div class="mdui-container">
<div class="mdui-panel mdui-panel-popout" mdui-panel>

  <div class="mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">服务器状态</div>
    <div class="mdui-panel-item-body">
      <div class="mdui-row mdui-row-gapless">
        <div class="mdui-col-xs-2">CPU</div>
        <div class="mdui-col-xs-8">
            <div class="mdui-progress" style="margin-top:0.32em;">
              <div class="mdui-progress-determinate" style="width: 0%;" id="cpuP"></div>
            </div>
        </div>
        <div class="mdui-col-xs-2" id="cpuNum">0%</div>
      </div>
      <div class="mdui-row mdui-row-gapless" style="margin-top:1em;">
        <div class="mdui-col-xs-2">内存</div>
        <div class="mdui-col-xs-8">
            <div class="mdui-progress" style="margin-top:0.4em;">
              <div class="mdui-progress-determinate" style="width: 0%;" id="memP"></div>
            </div>
        </div>
        <div class="mdui-col-xs-2" id="memNum">0%</div>
      </div>
      <div class="mdui-row mdui-row-gapless" style="margin-top:1em;">
        <div class="mdui-col-xs-2">磁盘</div>
        <div class="mdui-col-xs-8">
            <div class="mdui-progress" style="margin-top:0.4em;">
              <div class="mdui-progress-determinate" style="width: 0%;" id="diskP"></div>
            </div>
        </div>
        <div class="mdui-col-xs-2" id="diskNum">0%</div>
      </div>
      <div class="mdui-row mdui-row-gapless" style="margin-top:1em;">
        <div class="mdui-col-xs-2">BDS</div>
        <div class="mdui-col-xs-10" style="text-align:center;">
            <div id="bdsOpen" style="display:none;">
            <i class="mdui-icon material-icons mdui-text-color-green">check_box</i>
            <span class="mdui-text-color-green">已开启</span>
            </div>
            <div id="bdsOff" style="display:none;">
            <i class="mdui-icon material-icons mdui-text-color-grey">close</i>
            <span class="mdui-text-color-grey">已关闭</span>
            </div>
        </div>
      </div>
      <div id="bdsStatus" style="display:none;">
      <div class="mdui-row mdui-row-gapless" style="margin-top:1em;">
            <div class="mdui-col-xs-12" style="text-align:center;">BDS状态信息</div>
      </div>
      <div class="mdui-row mdui-row-gapless" style="margin-top:1em;">
            <div class="mdui-col-xs-3" style="text-align:center;">在线人数</div>
            <div class="mdui-col-xs-3" style="text-align:center;" id="bdsOnline"></div>
            <div class="mdui-col-xs-3" style="text-align:center;">最大人数</div>
            <div class="mdui-col-xs-3" style="text-align:center;" id="bdsTotal"></div>
      </div>
      </div>
      </div>
    </div>
  
  <div class="mdui-panel-item mdui-panel-item-open">
    <div class="mdui-panel-item-header">快捷操作</div>
    <div class="mdui-panel-item-body" id="Econtrol">
        <button class="mdui-btn mdui-btn-raised mdui-ripple" id="switchBtn"></button>
        <div class="mdui-spinner mdui-spinner-colorful" id="switchLoad" style="display:none;"></div><br /><br />
              <div class="mdui-row mdui-row-gapless" style="display:none;" id="actionArea">
            <div class="mdui-col-xs-6"><div class="mdui-textfield" style="margin-top:-1.2em;">
  <input class="mdui-textfield-input" type="text" placeholder="Xbox ID" id="actionInput" autocomplete="off"></div>
</div>
<div class="mdui-col-xs-4">
<select class="mdui-select" id="EcontrolS" mdui-select>
<option value="wa">加白名单</option>
<option value="wr">删白名单</option>
<option value="ba">加黑名单</option>
<option value="br">删黑名单</option>
<option value="op">加管理员</option>
<option value="deop">删管理员</option>
</select>
</div>
<div class="mdui-col-xs-2"><button class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" id="actionButton"><i class="mdui-icon material-icons mdui-text-color-white" >send</i></button></div><div class="mdui-spinner mdui-spinner-colorful" id="actionLoad" style="display:none;"></div>
    </div>
    </div>
  </div>
  
  <div class="mdui-panel-item mdui-panel-item-open" id="cmdRunArea" style="display:none;">
    <div class="mdui-panel-item-header">命令执行</div>
    <div class="mdui-panel-item-body">
        <div class="mdui-row mdui-row-gapless">
            <div class="mdui-col-xs-10"><div class="mdui-textfield" style="margin-top:-1.2em;">
  <input class="mdui-textfield-input" type="text" placeholder="待执行的命令" id="cmdInput"></div>
      </div>
<div class="mdui-col-xs-2"><button class="mdui-btn mdui-btn-icon mdui-color-theme-accent mdui-ripple" id="cmdButton"><i class="mdui-icon material-icons mdui-text-color-white" >send</i></button></div><div class="mdui-spinner mdui-spinner-colorful" id="cmdLoad" style="display:none;"></div>
</div>
<span class="mdui-text-color-grey" id="cmdhint"></div>
    </div>
  </div>
  
</div>
</div>
<style>
.mdui-col-xs-2 {
    text-align:center;
}
.mdui-select {
    width:100%;
}
.autocomplete-suggestion{margin-left:.5em;display:inline-block;}
</style>
<script>var bpApi="<?php echo bp_api_url(); ?>/action.php";</script>
<script src="<?php echo Theme_Enable_Url; ?>/scripts/jquery.autocomplete.min.js"></script>
<script src="<?php echo Theme_Enable_Url; ?>/scripts/bp-main.js"></script>
