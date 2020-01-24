# Accel-Manager v1.0.0.x

## About

This software claims to cover basic actions on the daily management of an Accel-PPP B-RAS, running PPPoE Sessions.

## Features

 - User/Acl data stored on a local database, default SQLite3 
 - User access control by profile configurations
 - List all PPPoE sessions with:
    - Pagination 
    - Search by a specified field
    - Order by field
 - This is the actions that can be executed on a give session:
    - Live network traffic graphic
    - Change rate-limit parameters
    - Restore rate-limit to original parameters values
    - Drop the session

## Requirements

Since this software uses the Laravel Framework on version ^6.x, he inherited the Laravel
requirements.

- PHP >= 7.2.0
- BCMath PHP Extension
- Ctype PHP Extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension 
- Tokenizer PHP Extension
- XML PHP Extension

- Composer (used to install project dependencies). If you are not familiar with the composer installation, just go to https://getcomposer.org/ or Google for the process of installation on your SO.

Besides PHP, the server has to run a WebServer (this has developed and tested with Apache 2.4, but can be used an Nginx) and a database. I strongly recommend the use of the SQLite3 database, for his small size and resource consumption, after all, the focus of the machine will be on terminate the user PPPoE Sessions.

(Optional) Git client. With git, you can clone the repository locally and get further updates smoothly.

## Installation

Once you have the Http server, PHP and Database installed on your server, you are ready to go. I will illustrate the installation process with Git, if you prefer to download the source code directly, just skip the cloning repository step, and make sure to download and unzip the project on the folder where you Http server is configured to serve.

1- Access you Http server configured folder (like /var/www/html for exemple)
```
cd /var/www/html
```

2- Clone this repository on that folder
```
git clone https://github.com/marcioelias/accel-manager.git .
``` 

3- Install project dependencies
```
composer install
```

4- Migrate the database
```
php artisan migrate --sed
```

5- Access the installed software by going to the IP address of your server

6- Default user credentials:
    - For the administrator profile there a default username: admin and password: admin
    - For the limited user profile the username: user and the password also is user.


