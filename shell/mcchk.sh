#!/bin/bash
#Author:CNflysky@Bedrock-Panel
#last edited by CNflysky 20.3.1
SERVERROOT="/opt/mc"
PROPERTIESFILE="server.properties"
SCREENNAME="mc"
if [ ! -d SERVERROOT ]; then
	mkdir -p $SERVERROOT
fi
cd $SERVERROOT
case $1 in 
	"d"):
		if [ -z "$2" ] && [ -z "$3" ]; then
			echo false
			exit
		fi
		if [ -f "$2" ] ; then
			unzip -d . -q $2
			echo "$3" > version
			echo true
		else
			echo false
		fi
		;;
	"u"):
		if [ -z "$2" ] && [ -z "$3" ]; then
			echo false
			exit
		fi
		if [ -f "$2" ]; then
			mv worlds/ ../
			mv whitelist.json ../
			mv permissions.json ../
			mv $PROPERTIESFILE ../${PROPERTIESFILE}.old
			rm -rf *
			unzip -d . -q $2
			mv ../worlds .
			mv ../whitelist.json .
			mv ../permissions.json .
			mv ../${PROPERTIESFILE}.old .
			lineold=$(wc -l ${PROPERTIESFILE}.old | cut -d ' ' -f1)
			linenew=$(wc -l $PROPERTIESFILE | cut -d ' ' -f1)
			if [ "$lineold" == "$linenew" ]; then
				mv ${PROPERTIESFILE}.old $PROPERTIESFILE
			else
			        for ((i=$lineold;i<=linenew;i++))
        			do
                			sed -n ${i}p $PROPERTIESFILE >> ${PROPERTIESFILE}.old
        			done
				mv ${PROPERTIESFILE}.old $PROPERTIESFILE
			fi
			echo "$3" > version
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
		while ! cat log.txt | grep -q started
		do
			sleep 0.1s
		done
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
	"cw"):
		if [ ! -d "$2" ]; then
			echo false
			exit
		fi
		if [ -f whitelist.json ]; then
		    cp whitelist.json $2 && chown www-data:www-data $2/whitelist.json
		    chmod 600 $2/whitelist.json
		    if [ -f $2/whitelist.json ]; then
		        echo true
		    else
		        echo false
		    fi
		fi
		;;
	"b"):
		if [ ! -d "$2" ]; then
			echo false
			exit
		fi
		while cat log.txt | grep -q "There are"
                do
                        sleep 0.1s
                done
                cat /dev/null > log.txt
                screen -x -S $SCREENNAME -p 0 -X stuff "save hold"
                screen -x -S $SCREENNAME -p 0 -X stuff "\n"	
		sleep 5s
		zip -r $2 whitelist.json permissions.json worlds/ blacklist.txt  server.properties > /dev/null 2>&1
		while cat log.txt | grep -q "There are"
                do
                        sleep 0.1s
                done
                cat /dev/null > log.txt
                screen -x -S $SCREENNAME -p 0 -X stuff "save resume"
                screen -x -S $SCREENNAME -p 0 -X stuff "\n"
		if [ -f "$2" ]; then
			echo true
		else
			echo false
		fi
		;;
	"r"):
		if [ ! -f "$2" ]; then
                        echo false
                        exit
                fi
		rm -rf worlds/ permissions.json server.properties blacklist.txt whitelist.json 
		unzip -d . $2
		if [ -f server.properties ]; then
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
	"clfe"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "t" ]; then
			sed -i '/content-log-file-enabled=/s/false/true/g' $PROPERTIESFILE
			if grep -q -w "content-log-file-enabled=true" $PROPERTIESFILE ; then
				echo true;
			else
				echo false;
			fi
		elif [ "$2" == "f" ]; then 
			sed -i '/content-log-file-enabled=/s/true/false/g' $PROPERTIESFILE
			if grep -q "content-log-file-enabled=false" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else 
			echo false
		fi
		;;
	"ct"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/compression-threshold=/=' $PROPERTIESFILE)
		sed -i "${line}c compression-threshold=$2"  $PROPERTIESFILE
		if grep -q -w "compression-threshold=$2" $PROPERTIESFILE ; then
			echo true
		else
			echo false
		fi
		;;
	"pmst"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/player-movement-score-threshold=/=' $PROPERTIESFILE)
		sed -i "${line}c player-movement-score-threshold=$2"  $PROPERTIESFILE
		if grep -q -w "player-movement-score-threshold=$2" $PROPERTIESFILE ; then
			echo true
		else
			echo false
		fi
		;;
	"pmdt"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/player-movement-distance-threshold=/=' $PROPERTIESFILE)
		sed -i "${line}c player-movement-distance-threshold=$2"  $PROPERTIESFILE
		if grep -q -w "player-movement-distance-threshold=$2" $PROPERTIESFILE ; then
			echo true
		else
			echo false
		fi
		;;
	"pmdtim"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		line=$(sed -n '/player-movement-distance-threshold-in-ms=/=' $PROPERTIESFILE)
		sed -i "${line}c player-movement-distance-threshold-in-ms=$2"  $PROPERTIESFILE
		if grep -q -w "player-movement-distance-threshold-in-ms=$2" $PROPERTIESFILE ; then
			echo true
		else
			echo false
		fi
		;;
	"sam"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "t" ]; then
			sed -i '/server-authoritative-movement=/s/false/true/g' $PROPERTIESFILE
			if grep -q -w "server-authoritative-movement=true" $PROPERTIESFILE ; then
				echo true;
			else
				echo false;
			fi
		elif [ "$2" == "f" ]; then 
			sed -i '/server-authoritative-movement=/s/true/false/g' $PROPERTIESFILE
			if grep -q "server-authoritative-movement=false" $PROPERTIESFILE ; then
				echo true
			else
				echo false
			fi
		else 
			echo false
		fi
		;;
	"cpm"):
		if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ "$2" == "t" ]; then
			sed -i '/correct-player-movement=/s/false/true/g' $PROPERTIESFILE
			if grep -q -w "correct-player-movement=true" $PROPERTIESFILE ; then
				echo true;
			else
				echo false;
			fi
		elif [ "$2" == "f" ]; then 
			sed -i '/correct-player-movement=/s/true/false/g' $PROPERTIESFILE
			if grep -q "correct-player-movement=false" $PROPERTIESFILE ; then
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
		while cat log.txt | grep -q "There are"
		do
			sleep 0.1s
		done
		cat /dev/null > log.txt
		screen -x -S $SCREENNAME -p 0 -X stuff "$2"
		screen -x -S $SCREENNAME -p 0 -X stuff "\n"
		while [ ! -s log.txt ] 
		do
			sleep 0.1s
		done
		cat -v log.txt | sed 's/\^@//g'
		cat /dev/null > log.txt
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
	"bl"):
		if [ -f blacklist.txt ]; then
			cat blacklist.txt
		else
			echo false
		fi
		;;
	"bi"):
	    touch blacklist.txt
	    echo "* * * * * /usr/bin/mcchk bc" >> cron.file
	    crontab cron.file
	    rm -rf cron.file
		service cron start
	    if [ -f blacklist.txt ]; then
	            echo true
	    else
	            echo false
	    fi
	    ;;
	"ba"):
	    if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ ! -f blacklist.txt ]; then
	            echo false
	            exit
	    fi
		echo $2 >> blacklist.txt
		if cat blacklist.txt | grep -q $2; then
		        echo true
	    else
		        echo false
        fi
	    ;;
	"br"):
	    if [ -z "$2" ]; then
			echo false
			exit
		fi
		if [ ! -f blacklist.txt ]; then
	            echo false
	            exit
	    fi
	    if cat blacklist.txt | grep -q "$2" ; then
	        sed -i '/'$2'/d' blacklist.txt
	            if cat blacklist.txt | grep -q "$2" ; then
	                echo false
	            else
	                echo true
	            fi
	    else
	        echo false
	    fi
	    ;;
	"bc"):
        #this function is for blacklist only. you should not call it manually.
	for ((j=0;j<12;j++))
        do
		cat /dev/null > log.txt
		screen -x -S $SCREENNAME -p 0 -X stuff "list"
		screen -x -S $SCREENNAME -p 0 -X stuff "\n"
		while [ ! -s log.txt ] 
		do
			sleep 0.1s
		done
		onlineplayerlistraw=$(cat -v log.txt | sed 's/\^@//g')
		cat /dev/null > log.txt
		onlineplayerlist=${onlineplayerlistraw#*e:}
		blines=$(wc -l blacklist.txt | cut -d ' ' -f1)
		for ((i=1;i<=$blines;i++))
		do
			id=$(sed -n ${i}p blacklist.txt)
			if echo $onlineplayerlist | grep -q -w $id; then
				echo kicking...
				screen -x -S $SCREENNAME -p 0 -X stuff "kick \"$id\" You have been banned by server operator.Sorry"
				screen -x -S $SCREENNAME -p 0 -X stuff "\n"
				sleep 1s
			fi
		done
		sleep 4s
        done
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
		elif [ "$2" == "ct" ]; then
			text=$(cat $PROPERTIESFILE | grep "compression-threshold=")
			echo ${text#*=}
		elif [ "$2" == "sam" ]; then
			text=$(cat $PROPERTIESFILE | grep "server-authoritative-movement=")
			echo ${text#*=}
		elif [ "$2" == "pmst" ]; then
			text=$(cat $PROPERTIESFILE | grep "player-movement-score-threshold=")
			echo ${text#*=}
		elif [ "$2" == "pmdt" ]; then
			text=$(cat $PROPERTIESFILE | grep "player-movement-distance-threshold=")
			echo ${text#*=}
		elif [ "$2" == "pmdtim" ]; then
			text=$(cat $PROPERTIESFILE | grep "player-movement-duration-threshold-in-ms=")
			echo ${text#*=}
		elif [ "$2" == "cpm" ]; then
			text=$(cat $PROPERTIESFILE | grep "correct-player-movement=")
			echo ${text#*=}
		elif [ "$2" == "clfe" ]; then
			text=$(cat $PROPERTIESFILE | grep "content-log-file-enabled=")
			echo ${text#*=}
		elif [ "$2" == "vs" ]; then
			cat version
		else
			echo false
		fi
		;;
	
	*):
		echo false
esac
