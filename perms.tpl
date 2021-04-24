#!/bin/sh
group=stuff

chgrp -R $group storage/logs storage/framework storage/app bootstrap/cache database/dumps
chmod -R ugo+rwx storage/logs storage/framework storage/app bootstrap/cache database/dumps
chgrp -R $group .
chmod -R g+rwX .
find . -type d -exec chmod g+s '{}' +
