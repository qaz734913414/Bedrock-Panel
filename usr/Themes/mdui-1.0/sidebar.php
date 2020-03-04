<div class="mdui-drawer" style="overflow-y:hidden;" id="sidebar">
<ul class="mdui-list" mdui-collapse="{accordion: true}">

  <li class="mdui-list-item mdui-ripple">
    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-blue">dashboard</i>
    <div class="mdui-list-item-content">服务器管理</div>
  </li>

  <li class="mdui-collapse-item">
    <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-deep-orange">people</i>
      <div class="mdui-list-item-content">用户管理</div>
      <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
      <li class="mdui-list-item mdui-ripple">账号管理</li>
    </ul>
    <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
      <li class="mdui-list-item mdui-ripple">权限管理</li>
    </ul>
  </li>

  <li class="mdui-list-item mdui-ripple">
    <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-green">folder</i>
    <div class="mdui-list-item-content">备份管理</div>
  </li>

<li class="mdui-collapse-item">
    <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-indigo">color_lens</i>
      <div class="mdui-list-item-content">我的主题</div>
      <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
      <li class="mdui-list-item mdui-ripple">主题管理</li>
    </ul>
    <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
      <li class="mdui-list-item mdui-ripple">安装主题</li>
    </ul>
  </li>

<li class="mdui-collapse-item">
    <div class="mdui-collapse-item-header mdui-list-item mdui-ripple">
      <i class="mdui-list-item-icon mdui-icon material-icons mdui-text-color-light-blue">add_circle</i>
      <div class="mdui-list-item-content">我的插件</div>
      <i class="mdui-collapse-item-arrow mdui-icon material-icons">keyboard_arrow_down</i>
    </div>
    <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
      <li class="mdui-list-item mdui-ripple">插件管理</li>
    </ul>
    <ul class="mdui-collapse-item-body mdui-list mdui-list-dense">
      <li class="mdui-list-item mdui-ripple">安装插件</li>
    </ul>
  </li>
</ul>
<div id="bottomicon" style="position: fixed;bottom: 1em; text-align:center;font-size: 1em;left: 1em;"><div style="display:inline-block;" class="mdui-ripple mdui-ripple-white"><img src="<?php if(isset($_COOKIE['darkmode'])&&$_COOKIE['darkmode']=="dark")echo bp_base_url()."/Themes/mdui-1.0/img/settings-w.svg"; else echo bp_base_url()."/Themes/mdui-1.0/img/settings-b.svg" ?>" style="width: 1.5em;" id="settimg"><br><span>设置</span></div><div style="display:inline-block;margin-left:1em;" class="mdui-ripple mdui-ripple-white" id="darkmodeSwitchBtn"><img src="<?php if(isset($_COOKIE['darkmode'])&&$_COOKIE['darkmode']=="dark")echo bp_base_url()."/Themes/mdui-1.0/img/light.svg"; else echo bp_base_url()."/Themes/mdui-1.0/img/dark.svg" ?>" style="width: 1.5em;" id="dspmodeimg"><br><span id="dspmode">夜间</span></div></div>
</div>
</div>
</div>
</div>
</div>
