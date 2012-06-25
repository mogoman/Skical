Skical
======

Symfony based booking calendar.

Needs Symfony 2.1 - https://github.com/symfony/symfony-standard

How To install
--------------
### 1) clone the project

    git clone git@github.com:mogoman/Skical.git skical

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

### 6) point your webserver at the web/ directory and restart

Edit the following file and add the IP address of the box where your browser runs

    web/app_dev.php

Done
----
- sign up / sign away attendance process is now working
- amount of free slot checking in place
- object maintains own free slot checks

Todo list
---------
- add constraints to signup (max 5 etc)
- setup roles for admin and backend users
- setup configuration for sign on, lost password etc. process
- setup project on hosted server for demoing
