<script>
function getCookie(name) {
  var nameEQ = name + '='
  var ca = document.cookie.split(';') // 把cookie分割成组
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i] // 取得字符串
    while (c.charAt(0) == ' ') { // 判断一下字符串有没有前导空格
      c = c.substring(1, c.length) // 有的话，从第二位开始取
    }
    if (c.indexOf(nameEQ) == 0) { // 如果含有我们要的name
      return unescape(c.substring(nameEQ.length, c.length)) // 解码并截取我们要值
    }
  }
  return false
}
function setCookie(name, value, seconds) {
  seconds = seconds || 0;   //seconds有值就直接赋值，没有为0，这个根php不一样。
  var expires = "";
  if (seconds != 0 ) {      //设置cookie生存时间
    var date = new Date();
    date.setTime(date.getTime()+(seconds*1000));
    expires = "; expires="+date.toGMTString();
  }
  document.cookie = name+"="+escape(value)+expires+"; path=/";   //转码并赋值
}
function setdarkmode()
{
    var darkmode=getCookie("darkmode");
    var bdy=$("body");
    var dmg=$("#dspmodeimg");
    var settimg=$("#settimg");
    if(darkmode===false||darkmode==="light")
    {
        setCookie("darkmode","light",864000);
        if(bdy.hasClass("mdui-theme-layout-dark"))
        {
            bdy.removeClass("mdui-theme-layout-dark");
            dmg.attr("src","<?php echo Theme_Enable_Url; ?>/img/dark.svg");
            settimg.attr("src","<?php echo Theme_Enable_Url; ?>/img/settings-b.svg");
        }
    }
    else
    {
        setCookie("darkmode","dark",864000);
        if(!bdy.hasClass("mdui-theme-layout-dark"))
        {
            bdy.addClass("mdui-theme-layout-dark");
            dmg.attr("src","<?php echo Theme_Enable_Url; ?>/img/light.svg");
            settimg.attr("src","<?php echo Theme_Enable_Url; ?>/img/settings-w.svg");
        }
    }
}
function switchdarkmode()
{
    var darkmode=getCookie("darkmode");
    if(darkmode==="dark")setCookie("darkmode","light",864000);
    else setCookie("darkmode","dark",864000);
    setdarkmode();
}
$(document).ready(function(){
    darkmodeSwitchBtn.onclick = function()
    {
        switchdarkmode();
    }
});
</script>
</body>
</html>
