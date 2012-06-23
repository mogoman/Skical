#!/bin/bash

echo running rsync --exclude-from=rsync_exclude.txt -e "ssh -p22" -avz . www-data@10.211.56.3:/var/www/skical
rsync --exclude-from=rsync_exclude.txt -e "ssh -p22" -avz . www-data@10.211.56.3:/var/www/skical
