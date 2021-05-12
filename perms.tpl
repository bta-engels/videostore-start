#!/bin/sh
group=daemon

sudo chgrp -R $group storage bootstrap/cache database/dumps
sudo chmod -R ugo+rwx storage bootstrap/cache database/dumps
sudo chmod -R +ai "everyone allow read,write,execute,append,readattr,readextattr,readsecurity,writesecurity,chown" storage
sudo chgrp -R $group .
sudo chmod -R g+rwX .
sudo find . -type d -exec chmod g+s '{}' +
