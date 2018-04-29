#DriveTime
<h2>Key:</h2>
login.php is client login page. <br>
login1.php is driver login page. <br>
chooseAccess.php is used as a two-way splitter. Combines both logins.

<h1>Code snippets below for pages.</h1>


<h2> Setup: </h2> 
Page Login1.php is for driver login. <br>
This page will need to be edited in a few ways for production. <br>
The code variable $con is used to secure a connection to the sql db. Change the credentials to match your credentials. <br> 
$resetpasslink variable will also need to be changed according to webserver address. For example, if your site is www.prodrivetime.com, you will use
$resetPassLink = 'http://www.prodrivetime.com/resetPassword.php?fp_code='.$uniqidStr; <br><br><br>


ADD ANY OTHER IMPORTANT DETAIL FOR SETUP HERE...

                                   
For production...      $resetPassLink variable in login and login1 must be changed to the website url.
Also, the email settings will need to be configured to match the company email.   




