# Financial-Grant-Management-System

Project Implementation Detail:

Backend: PHP
Database: MYSQL
Frontend: Bootstrap, HTML, CSS
Operating system: Linux
Local server : Xampp

Build Setup for Linux

To run this project you will be needing localhost, Install Xampp, Wamp or any other local server on your machine.
For Xampp installation you can refer to this link: http://ubuntuportal.com/2013/12/how-to-install-xampp-1-8-3-for-linux-in-ubuntu-desktop.html

Once you are done with Xampp installation check it once by running localhost/index.php or localhost/phpmyadmin.

Step-1: Download the project file from github and extract the zip file, move the transport-management-system folder to your system's /opt/lamp/htdocs folder.

Step-2: In Xampp phpmyadmin create the database Bus_schedule, and export the database file from transport-management-system/database/datasename-----
this will give you all the databases tables which we used for the project under Bus_schedule database.
tables will be: 

Step-3: Check include/Config.php file once , if all your congiguration matches with this. Change password if you gave any password to your root user.

Step-4: After all this setup done, run localhost/frontend/login.html.
