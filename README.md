# Bedrock-Panel 2.0
***中文版:[点我](https://github.com/bedrock-panel/Bedrock-Panel/blob/container-shell/README-zh.md)***  
***Please note:This branch is created only for the Docker in-container shell script and host shell script developments.   
If you want to help us for the development of web pages,please follow this link:[Click Me](https://github.com/bedrock-panel/Bedrock-Panel)***
## Explains
* ### Construction Info
**Base info**:Debian latest(Current version:**Buster**)  
**Software mirror**:USTC  
**Installed packages**:`axel curl libssl-dev screen vim zip unzip`  
**BDS path**:`/opt/mc`  
**mc.sh path**:`/usr/local/bin` and a symbolic link has been created : `mc`
* ### File description
**dockerfile**: *Image build config*  
**mc.sh**:*In-container BDS controlling script*  
**setup.sh**:*A script helps build docker image,do some file movement and setup some permissions.*  
**keep.cpp**:*Just some shit prevents docker from stop running*  
* ### Usage
Clone everything in this branch into a folder,then execute :  
`sudo docker build -t mc .`  
`sudo nohup docker run --name mc -p19132:19132/udp mc >/dev/null 2&>1 &`  
`sudo docker exec mc mc d 1.13.3.0`  
`sudo docker exec mc mc on`  
if it returned `true`,then a image named `mc` was built and a container named `mc` has been launched up and started running.
## API Explains
**Usage**:`mc <command> <parameter>`  

command | description | parameters | returning value
--- | --- | --- | --- |
d (deploy) | Deploy server | version | true/false
u (update) | Upgrade server | version | true/false
on | Open server | none | true/false
off | Shutdown server | none | true/false
sq (status query) | Query server status | none | true/false
wl (whitelist) | Whitelist managements | on/off | true/false
wa (whitelist add) | Add ID to whitelist | Xbox ID | true/false
wr (whitelist remove) | Remove ID from whitelist | Xbox ID | true/false
wq (whitelist query) | Query ID from whitelist | Xbox id | true/false
md (modify description) | Modify server description(motd) | string | true/false
mmp (modify max players)| Modify server max players | int | true/false
mm (modify mode) | Modify server game mode | c/s/a(creative/survival/adventure) | true/false
df (difficulty) | Modify server difficulty | p/e/n/h (peaceful/easy/normal/hard) | true/false
ac (allow-cheats) | Allow cheats | t/f | true/false
sd (seed) | Modify server seed | int | true/false
pp (player permission)| Modify server player permissions  | v/m/o(visitor/member/operator) | true/false
tr (textures required) | Lock texture pack | t/f | true/false
pq | Query server config | wl,md,mmp,mm,df,ac,sd,tr,pp,vs(version) | value/false
cmd | Execute a command | string | result
