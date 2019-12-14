#!/bin/bash
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
				fi
				if docker cp $4 $3:$5 > /dev/null 2>&1 ; then
					echo true
				else
					echo false
				fi
				;;
			"exec"):
				if docker ps -a | grep $3 | grep -q Up ; then
					docker exec $3 $4 
				else
					echo false
				fi
				;;
			"rm"):
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
				;;
			*):
				echo false;
		esac
		;;
	"config"):
		;;		
	*):
		echo false
esac
