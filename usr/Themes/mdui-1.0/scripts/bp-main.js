var timei;
var al = new mdui.Dialog('#alert');
var firstget = true;
var lastcmd="";
var hints={"?":"? [command: CommandName]<br />? &lt;page: int&gt;",help:"help [command: CommandName]<br />help &lt;page: int&gt;",deop:"deop &lt;player: target&gt;",alwaysday:"alwaysday [lock: Boolean]",give:"give &lt;player: target&gt; &lt;itemName: Item&gt; [amount: int] [data: int] [components: json]",gamemode:"gamemode &lt;gameMode: GameMode&gt; &lt;player: target&gt;<br />gamemode &lt;gameMode: int&gt; &lt;player: target&gt;",gamerule:"gamerule<br />gamerule &lt;rule: BoolGameRule&gt; [value: Boolean]<br />gamerule &lt;rule: IntGameRule&gt; [value: int]",list:"list",op:"op &lt;player: target&gt;",whitelist:"whitelist &lt;add|remove&gt; &lt;player: target&gt;",xp:"xp &lt;amount: int&gt; &lt;player: target&gt;<br />xp &lt;amount: int&gt;L &lt;player: target&gt;",me:"me &lt;message: message&gt;",msg:"msg &lt;target: target&gt; &lt;message: message&gt;",op:"op &lt;player: target&gt;",say:"say &lt;message: message&gt;",tell:"tell &lt;target: target&gt; &lt;message: message&gt;",tellraw:"tellraw &lt;target: target&gt; &lt;raw json message: json&gt;",w:"w &lt;target: target&gt; &lt;message: message&gt;",title:"title &lt;player: target&gt; clear<br />title &lt;player: target&gt; reset<br />title &lt;player: target&gt; &lt;title|subtitle|actionbar&gt; &lt;titleText: message&gt;<br />title &lt;player: target&gt; times &lt;fadeIn: int&gt; &lt;stay: int&gt; &lt;fadeOut: int&gt;"};
function switchServer(onoff) {
	$("#switchLoad").attr("style", "");
	$("#switchBtn").attr("style", "display:none;");
	clearInterval(timei);
	$.ajax({
		url: bpApi + "?action=" + onoff,
		dataType: "json",
		type: "GET",
		xhrFields: {
			withCredentials: true
		},
		success: function(data) {
			if (data.code === 200) {
				$("#switchBtn").text("更新数据中");
				updateData();
				if (onoff === "on") setTimeout("toastr.success(\"操作成功！\");", 1000);
				else toastr.success("操作成功！");
			} else {
				toastr.error("服务器运行出错！");
			}
		},
		error: function() {
			toastr.error("无法连接至服务器！");
		},
		complete: function() {
			timei = setInterval("updateData();", 5000);
			$("#switchLoad").attr("style", "display:none;");
			$("#switchBtn").attr("style", "");
		}
	});
}
function updateData() {
	$.ajax({
		url: bpApi + "?action=serverStatus",
		dataType: "json",
		type: "GET",
		xhrFields: {
			withCredentials: true
		},
		success: function(data) {
			if (data.code === 200) {
				$("#cpuNum").text(data.cpu + "%");
				$("#memNum").text(data.mem + "%");
				$("#diskNum").text(data.disk + "%");
				$("#cpuP").attr("style", "width: " + data.cpu + "%;");
				$("#memP").attr("style", "width: " + data.mem + "%;");
				$("#diskP").attr("style", "width: " + data.disk + "%;");
				if (data.isOpen) {
					$("#bdsOpen").attr("style", "");
					$("#bdsOff").attr("style", "display:none;");
					$("#cpuNum").text(data.cpu + "%");
					$("#bdsOnline").text(data.rOnline);
					$("#bdsTotal").text(data.rTotal);
					$("#bdsStatus").attr("style", "");
					$("#cmdRunArea").attr("style", "");
					$("#actionArea").attr("style", "");
					$("#switchBtn").text("关闭服务器");
					$("#switchBtn").attr("onclick", "switchServer(\"off\");");
				} else {
					$("#bdsOff").attr("style", "");
					$("#bdsOpen").attr("style", "display:none;");
					$("#bdsStatus").attr("style", "display:none;");
					$("#cmdRunArea").attr("style", "display:none;");
					$("#actionArea").attr("style", "display:none;");
					$("#switchBtn").text("开启服务器");
					$("#switchBtn").attr("onclick", "switchServer(\"on\");");
				}
				if (firstget) {
					toastr.success("成功连接数据更新服务器！");
					firstget = false;
				}
			}
		},
		error: function() {
			toastr.error("无法连接至数据更新服务器！");
			firstget = true;
		}
	});
}
function closeAlert(sth) {
	al.close();
	if (sth) $(sth).focus();
}
function doAction() {
	var cmdobj = {
		op: "",
		para1: ""
	};
	cmdobj.op = $("#EcontrolS").val();
	cmdobj.para1 = $("#actionInput").val();
	if (cmdobj.para1 === "") {
		toastr.error("Xbox ID不得为空！");
		return;
	}
	$("#actionLoad").attr("style", "");
	$("#actionButton").attr("style", "display:none;");
	clearInterval(timei);
	$.ajax({
		url: bpApi + "?action=doAction",
		data: cmdobj,
		dataType: "json",
		type: "POST",
		xhrFields: {
			withCredentials: true
		},
		success: function(data) {
			if (data.code === 200) {
				toastr.success("操作成功！");
			} else {
				toastr.error("执行命令过程出错");
			}
		},
		error: function() {
			toastr.error("无法连接至服务器！");
		},
		complete: function() {
			$("#actionLoad").attr("style", "display:none;");
			$("#actionButton").attr("style", "");
			$("#actionInput").val("");
			timei = setInterval("updateData();", 5000);
			updateData();
		}
	});
}
function sendCmd() {
	var cmdobj = {
		op: "runcmd",
		para1: ""
	};
	cmdobj.para1 = $("#cmdInput").val();
	if (cmdobj.para1 === "") {
		toastr.error("执行的命令不得为空！");
		return;
	}
	$("#cmdLoad").attr("style", "");
	$("#cmdButton").attr("style", "display:none;");
	clearInterval(timei);
	$.ajax({
		url: bpApi + "?action=doAction",
		data: cmdobj,
		dataType: "json",
		type: "POST",
		xhrFields: {
			withCredentials: true
		},
		success: function(data) {
			if (data.code === 200) {
				$("#alertTitle").text("提示");
				$("#alertContent").html(data.info);
				al.open();
				$("#alertCloseButton").focus();
				$("#alertCloseButton").attr("onclick", "closeAlert(\"#cmdInput\")");
			} else {
				toastr.error("执行命令过程出错");
			}
		},
		error: function() {
			toastr.error("无法连接至服务器！");
		},
		complete: function() {
			$("#cmdLoad").attr("style", "display:none;");
			$("#cmdButton").attr("style", "");
			$("#cmdInput").val("");
            $("#cmdhint").text("");
			timei = setInterval("updateData();", 5000);
			updateData();
		}
	});
}

$(document).ready(function() {
	document.title = "首页 - Bedrock-Panel";
	updateData();
	timei = setInterval("updateData();", 5000);
	cmdButton.onclick = sendCmd;
	actionButton.onclick = doAction;
	$("#cmdInput").keypress(function(e) {
		if (e.which == 13) {
			sendCmd();
		}
	});
	$("#actionInput").keypress(function(e) {
		if (e.which == 13) {
			doAction();
		}
	});
	$('#EcontrolS').on('open.mdui.select',
	function() {
		$("#Econtrol").attr("style", "overflow:visible;");
	});
	$('#EcontrolS').on('close.mdui.select',
	function() {
		$("#Econtrol").attr("style", "");
	});
    cmdInput.oninput = function()
    {
        var txt=$("#cmdInput").val().split(" ")[0];
        if(txt==="")$("#cmdhint").text("");
        if(txt!=lastcmd)
        {
            if(txt in hints)
            {
                $("#cmdhint").attr("class","mdui-text-color-grey");
                $("#cmdhint").html(hints[txt]);
            }
            else
            {
                $("#cmdhint").attr("class","mdui-text-color-red");
                $("#cmdhint").text("您输入的命令可能有误，或不推荐在控制台执行，如果您确定此命令正确，您仍可以继续执行此命令！");
            }
        }
    }
});