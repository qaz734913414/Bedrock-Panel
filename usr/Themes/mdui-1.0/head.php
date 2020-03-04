<!DOCTYPE html>
<html>
 <head> 
  <meta charset="utf-8" /> 
  <meta name="viewport" content="maximum-scale=1,minimum-scale=1,user-scalable=0,width=device-width,initial-scale=1" /> 
  <meta name="format-detection" content="telephone=no,email=no,date=no,address=no" /> 
    <link rel="stylesheet" href="<?php echo Theme_Enable_Url; ?>/styles/mdui.min.css"/>
    <link rel="stylesheet" href="<?php echo Theme_Enable_Url; ?>/styles/toastr.min.css"/>
  <link rel="icon" href="/logo.png" type="image/png" />
  <link rel="manifest" href="<?php echo Theme_Enable_Url; ?>/manifest.json" />
<script src="<?php echo Theme_Enable_Url; ?>/scripts/jq.js"></script>
<script src="<?php echo Theme_Enable_Url; ?>/scripts/mdui.min.js"></script>
<script src="<?php echo Theme_Enable_Url; ?>/scripts/toastr.min.js"></script>
<script>
toastr.options = {  
        closeButton: false,
        debug: false,
        progressBar: true,
        onclick: null,
        showDuration: "300",
        hideDuration: "1000",
        timeOut: "1500",
        extendedTimeOut: "1000",
        showEasing: "swing",
        hideEasing: "linear",
        showMethod: "fadeIn",
        hideMethod: "fadeOut"
    }; 
</script>
  <!-- 插件注册点 -->
</head> 
