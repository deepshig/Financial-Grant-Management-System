# Financial-Grant-Management-System

Project Implementation Detail:

Backend: PHP <br>
Database: MYSQL <br>
Frontend: Bootstrap, HTML, CSS <br>
Operating system: Linux <br>
Local server : Xampp <br>
_________________________________________________________________________________________

Build Setup for Linux

To run this project you will be needing localhost, Install Xampp, Wamp or any other local server on your machine.
For Xampp installation you can refer to this link: <br> http://ubuntuportal.com/2013/12/how-to-install-xampp-1-8-3-for-linux-in-ubuntu-desktop.html

Once you are done with Xampp installation check it once by running localhost/index.php or localhost/phpmyadmin.

Also, an additional library Sweet Alert will be required, which can be installed through the following link:
http://t4t5.github.io/sweetalert/
_________________________________________________________________________________________

Step-1: Download the project file from github and extract the zip file, move the Financial-Grant-Management-System folder to your system's /opt/lamp/htdocs folder and rename it as SE.

Step-2: In Xampp phpmyadmin create the database FinancialGrantManagementSystem, and import the database file from SE/FinancialGrantManagementSystem.sql
This will give you all the databases tables which we used for the project under FinancialGrantManagementSystem database.

Step-3: Check include/config.php file once , if all your configuration matches with this. Change password if you gave any password to your root user.

Step-4: After all this setup done, run http://localhost/SE/include/Login.php.
