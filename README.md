#DriveTime

______________________________________________________________________________________________________________________________________
WARNING:

DO NOT INCLUDE THIS README FILE ON THE LIVE SERVER. 
THIS COULD GIVE AWAY INFORMATION ABOUT HOW YOUR SITE WORKS AND MAY MAKE IT VULNERABLE TO ATTACKS.
KEEP THIS FOR YOUR RECORD, OFFLINE.

______________________________________________________________________________________________________________________________________

Setup:

There are several files that will need to edited in order to match your specific domain and credentials.
Each page will have comments that will explain exactly what needs to be changed and how to do it.

Files: Login1.php and Login.php will need to be edited. 

In Login1.php there is a line that says $resetPassLink... There is a comment to show how to edit it. 
Below that, there is a whole section for mail. There are a few lines that need to be edited, the comments are in the file.
Make sure to not change anything that is not supposed to be changed or the project will not run.

In Login.php the same process will need to be done as with Login1.php. There are the same comments on both pages explaining the changes.
Repeat the same steps as with Login1, there is no difference besides Login1.php is the drivers login and Login.php is the clients login. 

In connection.php change the servername, username, password, and the table name. In that order, there will be comments.

SQL Database:

This project uses all SQL db for storing its backend data. There is an attachment below of the table structure required for each table.
There are five tables overall: Clients, drivers, admin, request_trans, and transactions. 
It is extremely important that all of the table names match exactly as they are shown here or the code will not execute.
All of the tables names are lower case. Make sure to include the underscore in request_transactions.
This is because the code is hardwired to run with those names.


