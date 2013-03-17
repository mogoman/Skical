Skical
======

Symfony based booking calendar.

Designed by Warren van der Woude

License: WTFPL (http://sam.zoy.org/wtfpl/)

Needs Symfony 2.2 - https://github.com/symfony/symfony-standard

How To install
--------------
### 1) clone the project

    git clone git@github.com:mogoman/Skical.git skical

### The rest of the steps require you to be in the directory you clone to - so cd skical if you used skical

### 2) install composer

    curl -s http://getcomposer.org/installer | php

You may get problems from the installer which need to be resolved in php.ini, most are one-liners
that need to be added to the configuration

### 3) install vendors and libraries

    php composer.phar install

### 4) setup the database

Edit the

     app/config/parameters.yml

and adapt the user, db and password according to your db install. Then run

    app/console doctrine:schema:create

to create the database tables

### 5) create yourself an admin user

Run the following and follow the on screen instructions

    app/console fos:user:create
    app/console fos:user:promote

for the promote part, use the role 

    ROLE_ADMIN

### 6) allow access to development environment

Edit the following file and add the IP address of the box where your browser runs

    web/app_dev.php

### 7) change the log and cache directories to allow the web user (normally www) to write to them

    sudo rm -rf app/cache/* app/logs/*
    sudo chown www app/logs/ app/cache/
    mkdir web/assetic
    sudo chown www web/assetic

### 8) clear the cache as the web user

    sudo -u www app/console cache:clear

### 7) point your webserver at the web/ directory and restart

### 8) open up the development URL on your web server

    http://<your server>/app_dev.php

### 9) login and create yourself an event or two

How to setup server for production mode
---------------------------------------

### 1) Create the web/assetic directory owned by the web user (www)

    mkdir web/assetic
    sudo chown www web/assetic

### 2) Deploy assets

    sudo -u www app/console assetic:dump --env=prod

### 3) Clear the production cache

    sudo -u www app/console cache:clear --env=prod


Todo list completed
-------------------
Version 0.8.4
--------------
- add logging for events
- write job control to be able to auto email on quotas
- create bus printout
- prevent users from signing up twice to an event

Version 0.7.30
--------------
- started on command line tools

Version 0.7.19
--------------
- create view of who is attending and controls to remove people from events

version 0.7.18
--------------
- change start / end dates to javascript-based datepicker
- change schema to set cutoff date for people signing up to an event
- change user profile editor to include first / last names
- allow admin user to actually be able to edit other users

pre 0.7.18
----------
- sign up / sign away attendance process is now working
- amount of free slot checking in place
- object maintains own free slot checks
- added admin security
- add constraints to signup (max 5 and payment "on bus" and "transfer")
- setup configuration for sign on, lost password etc. process
- setup project on hosted server for demoing
- setup roles for admin and backend users
- allow admin user to be able to add other users to events
- add twitter bootstrap and jquery to composer and change code references

Todo list still to do
---------------------
- finish off translations

