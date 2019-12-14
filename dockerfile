FROM debian:latest
LABEL maintainer="CNflysky@bedrock-panel" description="Bedrock-Panel Container"
COPY mc.sh /root/
COPY keep /root/
COPY setup.sh /root/
RUN sed -i 's/deb.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list && \
sed -i 's/snapshot.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list && \
sed -i 's/security.debian.org/mirrors.ustc.edu.cn/g' /etc/apt/sources.list && \
apt update && \
apt -y install libssl-dev screen vim axel zip unzip curl && \
chmod 755 /root/* && \
/root/setup.sh
ENTRYPOINT /root/entrypoint.sh
