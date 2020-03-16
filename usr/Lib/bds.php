<?php
@header("content-Type: text/html; charset=utf-8"); //语言强制
ob_start();
date_default_timezone_set('Asia/Shanghai');//此句用于消除时间差
$time_start = microtime_float();
function microtime_float() {
    $mtime = microtime();
    $mtime = explode(' ', $mtime);
    return $mtime[1] + $mtime[0];
}
class ServerInfo{
    //服务器参数
    public $S = array(
        'YourIP', //你的IP
        'DomainIP', //服务器域名和IP及进程用户名
        'Flag', //服务器标识
        'OS', //服务器操作系统具体
        'Language', //服务器语言
        'Name', //服务器主机名
        'Email', //服务器管理员邮箱
        'WebEngine', //服务器WEB服务引擎
        'WebPort', //web服务端口
        'WebPath', //web路径
        'ProbePath', //本脚本所在路径
        'sTime' //服务器时间
        );
 
    public $sysInfo; //系统信息，windows和linux
    public $CPU_Use;
    public $hd = array(
        't', //硬盘总量
        'f', //可用
        'u', //已用
        'PCT', //使用率
        );
    public $NetWork = array(
        'NetWorkName', //网卡名称
        'NetOut', //出网总量
        'NetInput', //入网总量
        'OutSpeed', //出网速度
        'InputSpeed' //入网速度
        ); //网卡流量
 
    function __construct(){
        $os = explode(" ", php_uname());
        $oskernel = $this->OS()?$os[2]:$os[1];
        $this->S['sTime'] = date('Y-m-d H:i:s');
 
        $this->sysInfo = $this->GetsysInfo();
        //var_dump($this->sysInfo);
        $this->cpu=$this->getcpu();
 
        $this->hd = $this->GetDisk();
    }
    public function OS(){
        return DIRECTORY_SEPARATOR=='/'?true:false;
    }
    public function GetsysInfo(){
        return $this->sys_linux();
    }
    public function sys_linux(){ //linux系统探测
        $str = @file("/proc/cpuinfo"); //获取CPU信息
        if(!$str) return false;
        $str = implode("", $str);
        @preg_match_all("/model\s+name\s{0,}\:+\s{0,}([\w\s\)\@.-]+)([\r\n]+)/s", $str, $model); //CPU 名称 
        @preg_match_all("/cpu\s+MHz\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $mhz); //CPU频率 
        @preg_match_all("/cache\s+size\s{0,}\:+\s{0,}([\d\.]+\s{0,}[A-Z]+[\r\n]+)/", $str, $cache); //CPU缓存 
        @preg_match_all("/bogomips\s{0,}\:+\s{0,}([\d\.]+)[\r\n]+/", $str, $bogomips); // 
        //服务器运行时间 
        $str = @file("/proc/uptime"); 
        if(!$str) return false; 
        $str = explode(" ", implode("", $str)); 
        $str = trim($str[0]); 
        $min = $str/60; 
        $hours = $min/60; 
        $days = floor($hours/24); 
        $hours = floor($hours-($days*24)); 
        $min = floor($min-($days*60*24)-($hours*60)); 
        $res['uptime'] = $days."天".$hours."小时".$min."分钟"; 
        //内存 
        $str = @file("/proc/meminfo"); 
        if(!$str) return false; 
        $str = implode("", $str); 
        preg_match_all("/MemTotal\s{0,}\:+\s{0,}([\d\.]+).+?MemFree\s{0,}\:+\s{0,}([\d\.]+).+?Cached\s{0,}\:+\s{0,}([\d\.]+).+?SwapTotal\s{0,}\:+\s{0,}([\d\.]+).+?SwapFree\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buf); 
        preg_match_all("/Buffers\s{0,}\:+\s{0,}([\d\.]+)/s", $str, $buffers); 
        $resmem['memTotal'] = round($buf[1][0]/1024, 2); 
        $resmem['memFree'] = round($buf[2][0]/1024, 2); 
        $resmem['memUsed'] = $resmem['memTotal']-$resmem['memFree']; 
        $resmem['memPercent'] = (floatval($resmem['memTotal'])!=0)?round($resmem['memUsed']/$resmem['memTotal']*100,2):0;
        $resmem = $this->formatmem($resmem); //格式化内存显示单位 
        $res = array_merge($res,$resmem); 
        // LOAD AVG 系统负载 
        $str = @file("/proc/loadavg"); 
        if (!$str) return false; 
        $str = explode(" ", implode("", $str)); 
        $str = array_chunk($str, 4); 
        $res['loadAvg'] = implode(" ", $str[0]); 
        return $res; 
    } 
    public function getcpu(){
        $cmd="vmstat | grep 1 | awk '{print \$15}'";
        $res=exec($cmd);
        $res=100-(int)$res;
        return $res;
    }
    public function GetDisk(){ //获取硬盘情况
        $d['t'] = round(@disk_total_space(".")/(1024*1024*1024),3);
        $d['f'] = round(@disk_free_space(".")/(1024*1024*1024),3);
        $d['u'] = $d['t']-$d['f'];
        $d['PCT'] = (floatval($d['t'])!=0)?round($d['u']/$d['t']*100,2):0;
        return $d;
    }
    private function formatmem($mem){
        if(!is_array($mem)) return $mem;
        foreach ($mem as $k=>$v) {
            if(!strpos($k, 'Percent')){
                $v = $v.' M';
            }
            $mem[$k] = $v;
        }
        return $mem;
    }
}

function doAction($action,$para1="")
{
	switch($action)
	{
		case "on":
			$cmd="sudo mcchk on";
			break;
		case "off":
			$cmd="sudo mcchk off";
			break;
		case "wa":
			$cmd="sudo mcchk wa \"$para1\"";
			break;
		case "wr":
			$cmd="sudo mcchk wr \"$para1\"";
			break;
		case "ba":
			system("sudo mcchk cmd \""."kick \\\"$para1\\\" You have been banned by server operator.Sorry.\"");
			$cmd="sudo mcchk ba \"$para1\"";
			break;
		case "br":
			$cmd="sudo mcchk br \"$para1\"";
			break;
		case "op":
			$cmd="sudo mcchk cmd \"op \\\"$para1\\\"\"";
			break;
		case "deop":
			$cmd="sudo mcchk cmd \"deop \\\"$para1\\\"\"";
			break;
		case "runcmd":
			$para1=addslashes($para1);
			$cmd="sudo mcchk cmd \"$para1\"";
			break;
		case "getConfig":
			$result=array();
			$result['wl']=exec("sudo mcchk pq wl");
			$result['md']=exec("sudo mcchk pq md");
			$result['mmp']=exec("sudo mcchk pq mmp");
			$result['mm']=exec("sudo mcchk pq mm");
			$result['df']=exec("sudo mcchk pq df");
			$result['ac']=exec("sudo mcchk pq ac");
			$result['sd']=exec("sudo mcchk pq sd");
			$result['pp']=exec("sudo mcchk pq pp");
			return $result;
	}
	$result=`$cmd`;
	if($action=="runcmd")
	{
		return $result;
	}
	if(strpos($result,"true")!==false||strpos($result,"pped")!==false)return true;
	else return false;
}

function getStatus()
{
    $S = new ServerInfo();
    $ret=array(
    'diskSpace'=>$S->hd['u'].' G',
    'disk'=>$S->hd['PCT'],
    'totMem'=>$S->sysInfo['memTotal'],
    'usedMem'=>$S->sysInfo['memUsed'],
    'freeMem'=>$S->sysInfo['memFree'],
    'upTime'=>$S->sysInfo['uptime'],
    'nowTime'=>$S->S['sTime'],
    'cpu'=>$S->cpu,
    'mem'=>round(100-$S->sysInfo['memPercent'],2),
    );
    $isopen=`sudo mcchk sq`;
    $ret['isOpen']=(strpos($isopen,"true")!==false);
    if($ret['isOpen']===true)
    {
        $people=`sudo mcchk cmd list`;
        preg_match('/(\d*)\/(\d*)/',$people,$rresult);
        $ret['rOnline']=$rresult[1];
        $ret['rTotal']=$rresult[2];
        $ret['rOnlineStr']=explode("\n",$people)[1];
    }
    return $ret;
}