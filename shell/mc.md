
**主要使用方法**:`mc <命令> <参数>`  

命令 | 说明 | 参数 | 返回值
--- | --- | --- | --- |
d (deploy) | 部署服务端 | 服务端路径 版本号 | true/false
u (update) | 更新服务端 | 服务端路径 版本号 | true/false
on | 开启服务器 | 无 | true/false
off | 关闭服务器 | 无 | true/false
sq (status query) | 查询服务器状态 | 无 | true/false
wl (whitelist) | 开关白名单 | on/off | true/false
wa (whitelist add) | 加入白名单 | Xbox ID | true/false
wr (whitelist remove) | 移出白名单 | Xbox ID | true/false
cw (copy whitelist) | 复制白名单文件至路径 | 完整路径 | true/false
b (backup) | 备份服务器文件 | 备份文件的完整路径(要带后缀名 zip格式)| true/false
r (restore) | 恢复备份 | 备份文件的完整路径 | true/false
ba (blacklist add) | 加入黑名单 | Xbox id | true/false
br (blacklist remove) | 移出黑名单 | Xbox id | true/false
bl (blacklist list) | 列出黑名单 | Xbox id | true/false
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
