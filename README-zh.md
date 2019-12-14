# Bedrock-Panel 2.0
***注意:这是Docker内部控制脚本与宿主机Shell交互层代码分支。  
如要参与web开发请转到web分支:[点我](https://github.com/bedrock-panel/Bedrock-Panel)***
## 说明
* ### 构建信息  
镜像系统:Debian latest(当前版本:**Buster**)  
软件源:USTC  
安装的软件包:`axel curl libssl-dev screen vim zip unzip`  
服务端默认存储目录:`/opt/mc`  
mc.sh脚本位于`/usr/local/bin`,且创建了符号链接`mc`
* ### 文件说明
**dockerfile**: *镜像构建文件*  
**mc.sh**:*docker容器内部主要操作文件*  
**setup.sh**:*docker镜像构建时需要的文件,主要目的是设置一些启动参数与文件的移动*  
**keep.cpp**:*一个没卵用的程序，主要目的是防止docker退出*  
* ### 使用方法
将所有文件克隆到一个目录下.  
`sudo docker build -t mc .`  
`sudo nohup docker run --name mc -p19132:19132/udp mc >/dev/null 2&>1 &`  
`sudo docker exec mc mc d 1.13.3.0`  
`sudo docker exec mc mc on`  
如果返回`true`则启动成功。
## API说明
API说明主要针对mc.sh.  
**主要使用方法**:`mc <命令> <参数>`  

命令 | 说明 | 参数 | 返回值
--- | --- | --- | --- |
d (deploy) | 部署服务端 | 版本号 | true/false
u (update) | 更新服务端 | 版本号 | true/false
on | 开启服务器 | 无 | true/false
off | 关闭服务器 | 无 | true/false
sq (status query) | 查询服务器状态 | 无 | true/false
wl (whitelist) | 开关白名单 | on/off | true/false
wa (whitelist add) | 加入白名单 | Xbox ID | true/false
wr (whitelist remove) | 移出白名单 | Xbox ID | true/false
wq (whitelist query) | 查询白名单 | Xbox id | true/false
md (modify description) | 修改服务器描述 | 字符串 | true/false
mmp (modify max players)| 修改服务器人数 | 数字 | true/false
mm (modify mode) | 修改服务器模式 | c/s/a(创造/生存/冒险) | true/false
df (difficulty) | 修改难度 | p/e/n/h (和平/简单/普通/困难) | true/false
ac (allow-cheats) | 允许作弊 | t/f | true/false
sd (seed) | 修改种子 | 数字 | true/false
pp (player permission)| 玩家权限 | v/m/o(游客/成员/操作员) | true/false
tr (textures required) | 锁定材质包 | t/f | true/false
pq | 查询服务端配置 | wl,md,mmp,mm,df,ac,sd,tr,pp,vs(版本) | 对应值/false
cmd | 执行命令 | 字符串 | 执行结果

`dcchk.sh <操作目标> <操作项> <容器名> <参数>`  
几个特殊命令:  
`dcchk.sh container create <容器名称> <端口>`  
`dcchk.sh container cp <容器名称> <宿主机路径> <容器路径>`  

操作目标 | 操作类型 | 参数 | 说明 | 返回值
--- | --- | --- | --- | ---
server | start | 无 |开启服务器 | true/false
server | stop | 无 |关闭服务器 | true/false
server | status | 无 |服务器状态 | true/false
server | deploy | 版本号 |部署服务端 | true/false
server | update | 版本号 |更新服务端 | true/false
server | exec | 字符串 | 执行指令 | true/false
whitelist | on | 开启白名单 | true/false
whitelist | off | 关闭白名单 | true/false 
whitelist | add | Xbox ID | 加白名单 | true/false
whitelist | rm | Xbox ID | 删白名单 | true/false
whitelist | query | Xbox ID | 查询白名单 | true/false
config | description | 字符串 | 修改服务器描述 | true/false
config | max-player | 数字 | 修改最大玩家数量 | true/false
config | mode | creative/survival/adventure | 修改服务器模式 | true/false
config | difficulty | peaceful/easy/normal/difficult | 修改难度 | true/false 
config | allow-cheats | true/false | 允许作弊 | true/false
config | seed | 字符串 | 修改种子 | true/false
config | player-permission | visitor/member/operator | 修改玩家权限 | true/false
config | textures-required | true/false | 锁定材质包 | true/false
config | query | 以上 | 查询配置项 | 相应值
container | del | 字符串 | 删除容器 | true/false
container | exec | 字符串 | 执行shell命令 | 相应返回值
container | rm | 路径 | 删除文件 | 相应返回值
container | backup | 无 | 备份存档文件 | true/false
container | start | 无 | 启动容器 | true/false
container | stop | 无 | 停止容器 | true/false
