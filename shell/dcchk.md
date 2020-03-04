`dcchk.sh <操作目标> <操作项> <容器名> <参数>`
特殊命令:
`dcchk.sh container get <容器名称> <宿主机路径> <容器路径>`
`dcchk.sh container put <容器名称> <宿主机路径> <容器路径>`

--- | --- | --- | --- | --- | ---
server | start | 字符串 | 无 |开启服务器 | true/false
server | stop | 字符串 | 无 |关闭服务器 | true/false
server | status | 字符串 | 无 |服务器状态 | true/false
server | deploy | 字符串 | 版本号 |部署服务端 | true/false
server | update | 字符串 | 版本号 |更新服务端 | true/false
server | exec | 字符串 | 字符串 | 执行指令 | true/false
whitelist | on  | 字符串 | 无 | 开启白名单 | true/false
whitelist | off | 字符串 | 无 | 关闭白名单 | true/false
whitelist | add | 字符串 | Xbox ID | 加白名单 | true/false
whitelist | rm | 字符串 | Xbox ID | 删白名单 | true/false
whitelist | query | 字符串 | Xbox ID | 查询白名单 | true/false
config | description | 字符串 | 字符串 | 修改服务器描述 | true/false
config | max-player | 字符串 | 数字 | 修改最大玩家数量 | true/false
config | mode | 字符串 | creative/survival/adventure | 修改服务器模式 | true/false
config | difficulty | 字符串 | peaceful/easy/normal/difficult | 修改难度 | true/false
config | allow-cheats | 字符串 | true/false | 允许作弊 | true/false
config | seed | 字符串 | 字符串 | 修改种子 | true/false
config | player-permission | 字符串 | visitor/member/operator | 修改玩家权限 | true/false
config | textures-required | 字符串 | true/false | 锁定材质包 | true/false
config | query | 字符串 | whitelist/description/max-player/mode/difficulty/allow-cheats/seed/player-permission/textures-required/version | 查询配置项 | 相应值
container | create | 字符串 | 端口号 | 创建容器 | true/false
container | del | 字符串 | 字符串 | 删除容器 | true/false
container | status | 字符串 | 无 | 容器状态 | true/false
container | exec | 字符串 | 字符串 | 执行shell命令 | 相应返回值
container | rm | 字符串 | 路径 | 删除文件 | 相应返回值
container | backup | 字符串 | 无 | 备份存档文件 | true/false
container | restore | 字符串 | 无 | 恢复存档文件 | true/false
container | start | 字符串 | 无 | 启动容器 | true/false
container | stop | 字符串 | 无 | 停止容器 | true/false

