#!/bin/bash
#Author:CNflysky@Bedrock-Panel
#last edited by CNflysky 20.1.14
SERVERROOT="/opt/mc"
PROPERTIESFILE="server.properties"
SCREENNAME="mc"
if [ ! -d SERVERROOT ]; then
	mkdir -p $SERVERROOT
fi
cd $SERVERROOT
case $1 in 
	"d"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		axel --insecure -n 20 https://minecraft.azureedge.net/bin-linux/bedrock-server-$2.zip
		if [ -f "bedrock-server-$2.zip" ]; then
			unzip -q bedrock-server-$2.zip
			rm bedrock-server-$2.zip
			echo "$2" > version
			echo true
		else
			echo false
		fi
		;;
	"u"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		axel -n 20 https://minecraft.azureedge.net/bin-linux/bedrock-server-$2.zip
		if [ -f "bedrock-server-$2.zip" ]; then
			mv worlds/ ../
			mv whitelist.json ../
			mv permissions.json ../
			mv $PROPERTIESFILE ../
			rm -rf *
			unzip -q bedrock-server-$2.zip
			mv ../worlds .
			mv ../whitelist.json .
			mv ../permissions.json .
			mv ../$PROPERTIESFILE .
			echo "$2" > version
			echo true
		else
			echo false
		fi
		;;
	"on"):
		if screen -ls | grep -q $SCREENNAME ; then
			echo false
			exit
		fi
		screen -dmS $SCREENNAME /bin/bash -c "./bedrock_server | tee log.txt"
		if screen -ls | grep -q $SCREENNAME ; then
			echo true
		else
			echo false
		fi
		;;
	"off"):
		if screen -ls | grep -q $SCREENNAME ; then
			screen -x -S $SCREENNAME -p 0 -X stuff "stop"
			screen -x -S $SCREENNAME -p 0 -X stuff "\n"
			rm log.txt
			while screen -ls | grep -q $SCREENNAME
			do
				sleep 0.1s
			done
			if screen -ls | grep -q $SCREENNAME ; then
				echo false
			else
				echo true
			fi
		else
			echo false
		fi
		;;
	"wl"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "on" ]; then
			sed -i '/white-list/s/false/true/g' $PROPERTIESFILE
			if cat $PROPERTIESFILE | grep -q "white-list=true" ; then
				echo true;
			else
				echo false;
			fi
		elif [ "$2" == "off" ]; then 
			sed -i '/white-list/s/true/false/g' $PROPERTIESFILE
			if cat $PROPERTIESFILE | grep -q "white-list=true" ; then
				echo false
			else
				echo true
			fi
		else
			echo false
		fi
		;;
	"wa"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		screen -x -S $SCREENNAME -p 0 -X stuff "whitelist add \"$2\" "
		screen -x -S $SCREENNAME -p 0 -X stuff "\n"
		sleep 2s
		if grep -q -w "$2" whitelist.json ;then
			echo true
		else
			echo false
		fi
		;;
	"wr"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		screen -x -S $SCREENNAME -p 0 -X stuff "whitelist remove \"$2\" "
		screen -x -S $SCREENNAME -p 0 -X stuff "\n"
		sleep 0.5s
		if grep -q -w "$2" whitelist.json ;then
			echo false
		else
			echo true
		fi
		;;
	"wq"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if grep -q -w "$2" whitelist.json ;then
			echo true
		else
			echo false
		fi
		;;
	"sq"):
		if screen -ls | grep -q $SCREENNAME ;then
			echo true
		else
			echo false
		fi
		;;
	"md"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/server-name=/=' $PROPERTIESFILE)
		sed -i "${line}c server-name=$2"  $PROPERTIESFILE
		if grep -q -w "server-name=$2" $PROPERTIESFILE ; then
			echo true
		else
			echo false
		fi
		;;
	"mmp"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if expr $2 + 0 &> /dev/null ; then
			line=$(sed -n '/max-players=/=' $PROPERTIESFILE)
			sed -i "${line}c max-players=$2" $PROPERTIESFILE
			if grep -q -w "max-players=$2" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else
			echo false
		fi
		;;
	"mm"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/gamemode=/=' $PROPERTIESFILE)
		if [ "$2" == "c" ]; then
			sed -i "${line}c gamemode=creative"  $PROPERTIESFILE
			if grep -q -w "gamemode=creative" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		elif [ "$2" == "s" ]; then
			sed -i "${line}c gamemode=survival"  $PROPERTIESFILE
			if grep -q -w "gamemode=survival" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		elif [ "$2" == "a" ]; then
			sed -i "${line}c gamemode=adventure"  $PROPERTIESFILE
			if grep -q -w "gamemode=adventure" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else
			echo false
		fi	
		;;
	"df"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/difficulty=/=' $PROPERTIESFILE)
		if [ "$2" == "p" ]; then
			sed -i "${line}c difficulty=peaceful"  $PROPERTIESFILE
			if grep -q -w "difficulty=peaceful" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		elif [ "$2" == "e" ]; then
			sed -i "${line}c difficulty=easy"  $PROPERTIESFILE
			if grep -q -w "difficulty=easy" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		elif [ "$2" == "n" ]; then
			sed -i "${line}c difficulty=normal"  $PROPERTIESFILE
			if grep -q -w "difficulty=normal" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		elif [ "$2" == "h" ]; then
		       	sed -i "${line}c difficulty=hard"  $PROPERTIESFILE
		       	if grep -q -w "difficulty=hard" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else
			echo false
		fi	
		;;
	"ac"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "t" ]; then
			sed -i '/allow-cheats=/s/false/true/g' $PROPERTIESFILE
			if grep -q -w "allow-cheats=true" $PROPERTIESFILE ; then
				echo true;
			else
				echo false;
			fi
		elif [ "$2" == "f" ]; then 
			sed -i '/allow-cheats=/s/true/false/g' $PROPERTIESFILE
			if grep -q "allow-cheats=false" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else 
			echo false
		fi
		;;
	"sd"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/level-seed=/=' $PROPERTIESFILE)
		sed -i "${line}c level-seed=$2"  $PROPERTIESFILE
		if grep -q -w "level-seed=$2" $PROPERTIESFILE ; then
			echo true
		else
			echo false
		fi
		;;
	"tr"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "t" ]; then
			sed -i '/texturepack-required=/s/false/true/g' $PROPERTIESFILE
			if grep -q "texturepack-required=true" $PROPERTIESFILE ; then
				echo true;
			else
				echo false;
			fi
		elif [ "$2" == "f" ]; then
			sed -i '/texturepack-required=/s/true/false/g' $PROPERTIESFILE
			if grep -q "texturepack-required=false" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else
			echo false
		fi
		;;
	"cmd"):
		cat /dev/null > log.txt
		screen -x -S $SCREENNAME -p 0 -X stuff "$2"
		screen -x -S $SCREENNAME -p 0 -X stuff "\n"
		while [ ! -s log.txt ] 
		do
			sleep 0.1s
		done
		cat log.txt
		;;
	"pp"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "v" ]; then
			line=$(sed -n '/default-player-permission-level=/=' $PROPERTIESFILE)
			sed -i "${line}c default-player-permission-level=visitor"  $PROPERTIESFILE
			if grep -q -w "default-player-permission-level=visitor" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		elif [ "$2" == "m" ]; then
			line=$(sed -n '/default-player-permission-level=/=' $PROPERTIESFILE)
			sed -i "${line}c default-player-permission-level=member"  $PROPERTIESFILE
			if grep -q -w "default-player-permission-level=member" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		elif [ "$2" == "o" ]; then
			line=$(sed -n '/default-player-permission-level=/=' $PROPERTIESFILE)
			sed -i "${line}c default-player-permission-level=operator"  $PROPERTIESFILE
			if grep -q -w "default-player-permission-level=operator" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else
			echo false
		fi
		;;
	"pq"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "wl" ]; then
			text=$(cat $PROPERTIESFILE | grep "white-list=")
			echo ${text#*=}
		elif [ "$2" == "md" ]; then
			text=$(cat $PROPERTIESFILE | grep "server-name=")
			echo ${text#*=}
		elif [ "$2" == "mmp" ]; then
			text=$(cat $PROPERTIESFILE | grep "max-players=")
			echo ${text#*=}
		elif [ "$2" == "mm" ]; then
			text=$(cat $PROPERTIESFILE | grep "gamemode=")
			echo ${text#*=}
		elif [ "$2" == "df" ]; then
			text=$(cat $PROPERTIESFILE | grep "difficulty=")
			echo ${text#*=}
		elif [ "$2" == "ac" ]; then
			text=$(cat $PROPERTIESFILE | grep "allow-cheats=")
			echo ${text#*=}
		elif [ "$2" == "sd" ]; then
			text=$(cat $PROPERTIESFILE | grep "level-seed=")
			echo ${text#*=}
		elif [ "$2" == "tr" ]; then
			text=$(cat $PROPERTIESFILE | grep "texturepack-required=")
			echo ${text#*=}
		elif [ "$2" == "pp" ]; then
			text=$(cat $PROPERTIESFILE | grep "default-player-permission-level=")
			echo ${text#*=}
		elif [ "$2" == "vs" ]; then
			cat version
		else
			echo false
		fi
		;;
	*)
		echo false
esac
