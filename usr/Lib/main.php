<?php
function main()
{
    if (file_exists("install_lock")) {
        die("<h1>目前仍在后台安装Minecraft Bedrock Server，请稍后再次刷新，请勿频繁刷新！</h1>");
    }
    
    //引入头部文件
    include Theme_Enable_Path . "/head.php";
    
    //安装检测
    if (!file_exists(Config_Path . "bp-config.php")) {
        include Theme_Enable_Path . "/install.php";
        exit;
    }
    
    //登录检测
    session_start();
    if (!isset($_SESSION['user']) || empty($_SESSION['user'])) {
        include Theme_Enable_Path . "/login.php";
        exit;
    }
    
    //进入面板
    if (!isset($_GET['action'])) {
        include Theme_Enable_Path . "/main.php";
    }
    
    //引入页脚文件
    include Theme_Enable_Path . "/footer.php";
}