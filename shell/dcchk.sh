#!/bin/bash
#Docker Minecraft Dedicated Server Checker(dcchk)
#Author:CNflysky@Bedrock-Panel
#last edited by CNflysky 2019.12.14
IMAGENAME=mc
case $1 in 
	"container"):
		case $2 in
			"status"):
				if [ -z "$3" ]; then
					echo false
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					echo true
				else
					echo false
				fi
				;;	
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
			"put"):
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
			"get"):
				if [ -z "$3" ] || [ -z "$4" ] || [ -z "$5" ] ; then
					echo false
					exit
				fi
				if docker cp $3:$5 $4 > /dev/null 2>&1 ; then
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
					docker exec $3 bash -c "$4" 
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
					docker exec $3 bash -c "cd /opt/mc && zip -r /opt/backup.zip worlds server.properties whitelist.json permissions.json > /dev/null 2>&1"
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
					docker exec $3 mc cmd "$4"
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
				if docker ps -a | grep $3 | grep -q Up; then
					unset result
					result=$(docker exec $3 mc pq wl) 
					if [ "$result" == "true" ]; then
						docker exec $3 mc wa "$4"
					else
						echo false
					fi
				else
					echo false
				fi
			;;
			"rm"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					unset result
					result=$(docker exec $3 mc pq wl) 
					if [ "$result" == "true" ]; then
						docker exec $3 mc wr "$4"
					else
						echo false
					fi
				else
					echo false
				fi
			;;
			"on"):
				if [ -z "$3" ]; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc wl on
				else
					echo false
				fi
			;;
			"off"):
				if [ -z "$3" ]; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc wl off
				else
					echo false
				fi
			;;
			*):
			echo false
	esac
	;;
	"config"):
		case $2 in 
			"description"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc md "$4"
				else
					echo false
				fi
				;;
			"max-player"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc mmp "$4"
				else
					echo false
				fi
				;;
			"mode"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					if [ "$4" == "creative" ]; then
						docker exec $3 mc mm c
					elif [ "$4" == "survival" ]; then
						docker exec $3 mc mm s
					elif [ "$4" == "adventure" ]; then
						docker exec $3 mc mm a
					else
						echo false
					fi
				fi
				;;
			"difficulty"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					if [ "$4" == "peaceful" ]; then
						docker exec $3 mc df p
					elif [ "$4" == "easy" ]; then
						docker exec $3 mc df e
					elif [ "$4" == "normal" ]; then
						docker exec $3 mc df n
					elif [ "$4" == "hard" ]; then
						docker exec $3 mc df h
					else
						echo false
					fi
				fi
				;;
			"allow-cheats"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					if [ "$4" == "true" ]; then
						docker exec $3 mc ac t
					elif [ "$4" == "false" ]; then
						docker exec $3 mc ac f
					else
						echo false
					fi
				fi
				;;
			"seed"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					docker exec $3 mc sd "$4"
				else
					echo false
				fi
				;;
			"player-permission"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					if [ "$4" == "visitor" ]; then
						docker exec $3 mc pp v
					elif [ "$4" == "member" ]; then
						docker exec $3 mc pp m
					elif [ "$4" == "operator" ]; then
						docker exec $3 mc pp o
					else
						echo false
					fi
				fi
				;;
			"textures-required"):
				if [ -z "$3" ] || [ -z "$4" ] ; then
					echo false
					exit
				fi
				if docker ps -a | grep $3 | grep -q Up; then
					if [ "$4" == "true" ]; then
						docker exec $3 mc tr t
					elif [ "$4" == "false" ]; then
						docker exec $3 mc tr f
					else
						echo false
					fi
				fi
				;;
			"query"):
				case $4 in
					"whitelist"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq wl
						else
							echo false
						fi
					;;
					"description"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq md
						else
							echo false
						fi
					;;
					"max-player"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq mmp
						else
							echo false
						fi
					;;
					"mode"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq mm
						else
							echo false
						fi
					;;
					"difficulty"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq df
						else
							echo false
						fi
					;;
					"allow-cheats"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq ac
						else
							echo false
						fi
					;;
					"seed"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq sd
						else
							echo false
						fi
					;;
					"player-permission"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq pp
						else
							echo false
						fi
					;;
					"textures-required"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq tr
						else
							echo false
						fi
					;;
					"version"):
						if [ -z "$3" ]; then
							echo false
						fi
						if docker ps -a | grep $3 | grep -q Up; then
							docker exec $3 mc pq vr
						else
							echo false
						fi
					;;
					*)
						echo false
					esac
				;;
			*):
				echo false
				;;
		esac
		;;
	*):
		echo false
esac
