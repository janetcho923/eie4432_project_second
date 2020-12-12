<?php
//connect to the database
session_start();
include "mysql-connect.php";
$connect = mysqli_connect($server, $user, $pw, $db);
$login = false;
//retrieve value from php form 
$loginID = $_POST[id];
$userPassword = $_POST[pw];

//clean up data retrieved from a database or from an HTML form
$loginID= stripcslashes($loginID);
$userPassword = stripcslashes($userPassword);
//prevent special character 
$loginID = mysql_real_escape_string($loginID);
$userPassword = mysql_real_escape_string($userPassword);

//query 1 :check login 
$userQuery = "SELECT * FROM loginEntire WHERE 'loginID' = $loginID and 'Userpassword' = $userPassword";
$result = mysqli_query($connect, $userQuery);
//check whether the username matches with the input, also the password
$row = mysql_fetch_array($result);
if (($row['loginID']==$username) && ($row['Userpassword']==$userPassword))
{
    header('Location: mainpage.html');
}
else
{
    header('Location: login.html');
 //prompt an error box    
}
?>