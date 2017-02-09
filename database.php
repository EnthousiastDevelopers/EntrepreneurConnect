<?php
//connect to mysql
$con=mysqli_connect("localhost", "root", "", "shoutit");
//Test Connection
if(mysqli_connect_errno())
{
echo 'Failed to connect to MySQLi: '.mysqli_connect_error();

}
?>