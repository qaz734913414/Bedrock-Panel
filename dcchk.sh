#!/bin/bash
#Docker Minecraft Dedicated Server Checker(dcchk)
#Author:CNflysky@Bedrock-Panel
#last edited by CNflysky 2019.12.14
IMAGENAME=mc
case $1 in 
	"container"):
		case $2 in 
			"create"):
				if [ -z "$3" ] || [ -z "$4" ]; then
					echo false
					exit 
				fi
				if docker ps -a | grep -q -w $3 || netstat -ano | grep -q :$4 ; then
					echo false
					exit 
				fi
				nohup docker run --name $3 -p$4:19132/udp $IMAGENAME > /dev/null 2>&1 &
				sleep 2s
				if docker ps -a | grep $3 | grep -q Up ; then
					echo true
				else
					echo false
				fi
				;;
			"cp"):
				if [ -z "$3" ] || [ -z "$4" ] || [ -z "$5" ] ; then
					echo false
					exit
				fi
				if docker cp $4 $3:$5 > /dev/null 2>&1 ; then
					echo true
				else
					echo false
				fi
				;;
			"del"):
				if [ -z "$3" ]; then
					echo false
					exit 
				fi
				if docker ps -a | grep $3 | grep -q Up ; then
					docker stop $3 > /dev/null 2>&1
					docker rm $3 > /dev/null 2>&1
				else
					docker rm $3 > /dev/null 2>&1
				fi
				if docker ps -a | grep -q $3; then
					echo false
				else
					echo true
				fi
				;;
			"exec"):
				if [ -z "$3" ] || [ -z "$4" ]; then
					echo false
					exit 
				fi
				if docker ps -a | grep $3 | grep -q Up ; then
					docker exec $3 $4 
				else
					echo false
				fi
				;;
			"rm"):
				if [ -z "$3" ] || [ -z "$4" ]; then
					echo false
					exit 
				fi
				if docker ps -a | grep $3 | grep -q Up ; then 
					if docker exec $3 rm -rf $4 ; then
						echo true
					else
						echo false
					fi
				else
					echo false
				fi
				;;
			"backup"):
				if [ -z "$3" ] ;then
					echo false
					exit 
				fi
				if docker ps -a | grep $3 | grep -q Up ; then
					docker exec $3 zip -r /opt/backup.zip /opt/mc/worlds /opt/mc/server.properties /opt/mc/whitelist.json /opt/mc/permissions.json > /dev/null 2>&1
					if docker exec $3 ls /opt/backup.zip > /dev/null 2>&1 ; then
						echo true
					else
						echo false
					fi
				fi
				;;
			"restore"):
				if [ -z "$3" ] ;then
                                        echo false
                                        exit
                                fi
				if docker exec $3 ls /opt/backup.zip > /dev/null 2>&1 ; then
					docker exec $3 unzip -o -d /opt/mc /opt/backup.zip > /dev/null 2>&1
					docker exec $3 rm -rf /opt/backup.zip
					if docker exec $3 ls /opt/backup.zip > /dev/null 2>&1 ; then 
						echo false
					else
						echo true
					fi
				else
					echo false
				fi
				;;
			"start"):
				if [ -z "$3" ] ;then
                                        echo false
                                        exit
                                fi
				if docker ps -a | grep $3 | grep -q Up ; then
					echo false
				else
					docker start $3 > /dev/null 2>&1
					if docker ps -a | grep $3 | grep -q Up ; then
						echo true
					else
						echo false
					fi
				fi
				;;
			"stop"):
				if [ -z "$3" ] ;then
                                        echo false
                                        exit
                                fi
				if docker ps -a | grep $3 | grep -q Up ; then
					docker stop $3 > /dev/null 2>&1
					if docker ps -a | grep $3 | grep -q Up ; then
						echo false
					else
						echo true
					fi
				else
					echo true
				fi
				;;
			*):
				echo false;
		esac
		;;
	"server"):
		case $2 in 
			"start"):
				if [ -z "$3" ]; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc on
				else
					echo false
				fi
				;;
			"stop"):
				if [ -z "$3" ]; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc off
				else
					echo false
				fi
				;;
			"deploy"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc d $4
				else
					echo false
				fi
				;;
			"status"):
				if [ -z "$3" ]; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc sq
				else
					echo false
				fi
				;;
			"update"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc u $4
				else
					echo false
				fi
				;;
			"exec"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc cmd $4
				else
					echo false
				fi
				;;
			*):
				echo false
		esac
		;;
	"whitelist"):
		case $2 in
			"add"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				unset result
				result=$(docker exec $3 mc pq wl) 
				if [ "$result" == "true" ]; then
					docker exec $3 mc wa "$4"
				else
					echo false
				fi
			;;
			"rm"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				unset result
				result=$(docker exec $3 mc pq wl) 
				if [ "$result" == "true" ]; then
					docker exec $3 mc wr "$4"
				else
					echo false
				fi
			;;
			"query"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				unset result
				result=$(docker exec $3 mc pq wl) 
				if [ "$result" == "true" ]; then
					docker exec $3 mc wq "$4"
				else
					echo false
				fi
			;;
			""
			*):
			echo false
	esac
	;;
	*):
		echo false
esac
