mv /root/mc.sh /usr/local/bin
chmod 755 /usr/local/bin/mc.sh
ln -s /usr/local/bin/mc.sh /usr/local/bin/mc
rm -rf /root/setup.sh
echo "if screen -ls | grep mc | grep Dead ; then
        screen -wipe
fi
while true
do
	sleep 1s
done" > /root/entrypoint.sh
chmod 755 /root/entrypoint.sh
