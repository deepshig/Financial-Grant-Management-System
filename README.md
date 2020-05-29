# Financial-Grant-Management-System

`This is a term project from my undergraduation. It does not exhibit my current programming skills`

## Objective

The purpose of this software is to manage the records of financial grants of Institute people. It facilitats to request grants as well as settle them, thus allowing research professionals to spend more time on research and discovery and less on administration. Using software for this purpose will avoid any duplicity or manipulation of records and thus stop corruption. It will track pre and post-award information at institution with a significant number of proposals, grants or research projects. It will provide privacy and reliability.

## Project Description

The software system is designed for 2 king of users.

* Admin
* Institute People (Faculty, PhD and MTech.)

Admin is a super user who can modify (update) all database. He can grant permission to other users if they want to access other user’s information. He verifies registration of new users. Basically all the Institute people will request Admin for the grant, and from there the Admin will handle the financial grant. He can cancel the grant if he found it inappropriate or its not feasible to provide.

Institute poeple are the users that can log into their account using their unique institute email id as username and their own password. These users can access (read) their own database only. They can enter a new grant request but can’t make changes in older one. If they want to make change, they will have to cancel the previous grant and request for a new one. Limits on request will be there based on the roles.

More details can be found [here](http://home.iitj.ac.in/~ug201313008/project1.html).

## Techincal Dependencies:

Backend: PHP <br>
Database: MYSQL <br>
Frontend: Bootstrap, HTML, CSS <br>
Operating system: Linux <br>
Local server : Xampp <br>
_________________________________________________________________________________________
_________________________________________________________________________________________

Build Setup for Linux

To run this project you will be needing localhost, Install Xampp, Wamp or any other local server on your machine.
For Xampp installation you can refer to this link: <br> http://ubuntuportal.com/2013/12/how-to-install-xampp-1-8-3-for-linux-in-ubuntu-desktop.html

Once you are done with Xampp installation check it once by running localhost/index.php or localhost/phpmyadmin.

Also, an additional library Sweet Alert will be required, which can be installed through the following link:
http://t4t5.github.io/sweetalert/
_________________________________________________________________________________________
_________________________________________________________________________________________

Step-1: Download the project file from github and extract the zip file, move the Financial-Grant-Management-System folder to your system's /opt/lamp/htdocs folder and rename it as SE.
_________________________________________________________________________________________

Step-2: In Xampp phpmyadmin create the database FinancialGrantManagementSystem, and import the database file from SE/FinancialGrantManagementSystem.sql
This will give you all the databases tables which we used for the project under FinancialGrantManagementSystem database.
_________________________________________________________________________________________

Step-3 : You will need to modify php.ini file for the functioning of send notification and upload bills options. You will need root access for this. Firstly, change your working directory to /opt/lampp/etc. Now open php.ini in root mode. <br> <br>

A) In the File Uploads section of php.ini, configure as follows: <br>
;;;;;;;;;;;;;;;; <br>
; File Uploads ; <br>
;;;;;;;;;;;;;;;; <br>

; Whether to allow HTTP file uploads. <br>
; http://php.net/file-uploads <br>
file_uploads=On <br>
<br>
; Temporary directory for HTTP uploaded files (will use system default if not <br>
; specified). <br>
; http://php.net/upload-tmp-dir <br>
;upload_tmp_dir = <br>
upload_tmp_dir="/opt/lampp/htdocs/SE/testupload" <br>
; Maximum allowed size for uploaded files. <br>
; http://php.net/upload-max-filesize <br>
upload_max_filesize=128M <br> <br>

B) In [mail function], configure as follows: <br>
[mail function] <br>
; For Win32 only. <br>
; http://php.net/smtp <br>
SMTP=localhost <br>
; http://php.net/smtp-port <br>
smtp_port=25 <br>

; For Win32 only. <br>
; http://php.net/sendmail-from <br>
;sendmail_from = me@example.com <br>

; For Unix only.  You may supply arguments as well (default: "sendmail -t -i"). <br>
; http://php.net/sendmail-path <br>
sendmail_path =  /usr/sbin/sendmail -t -i <br>

; Force the addition of the specified parameters to be passed as extra parameters <br>
; to the sendmail binary. These parameters will always replace the value of <br>
; the 5th parameter to mail(), even in safe mode. <br>
;mail.force_extra_parameters = <br>

; Add X-PHP-Originating-Script: that will include uid of the script followed by the filename <br>
mail.add_x_header=On <br>

; Log all mail() calls including the full path of the script, line #, to address and headers <br>
;mail.log = <br>
_________________________________________________________________________________________

Step-4: Check include/config.php file once , if all your configuration matches with this. Change password if you gave any password to your root user.
_________________________________________________________________________________________

Step-5: After all this setup done, run http://localhost/SE/include/Login.php.
_________________________________________________________________________________________
_________________________________________________________________________________________
