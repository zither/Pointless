#/bin/sh
REMOTE=https://raw.github.com/zither/Pointless/koding/bin/poi
TARGET=/usr/local/bin/poi

wget $REMOTE -O /tmp/poi
chmod +x /tmp/poi
sudo mv /tmp/poi $TARGET
