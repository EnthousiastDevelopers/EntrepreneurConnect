<?php
//this is an old fashion of defining strings, dont use it anymore (mysql)

/* <<<<<<< HEAD
$servername = "localhost";
$username = "root";
$password = "1234";
$database = "database2";
$conn = new mysqli($servername, $username, $password);
Create a Database
$sql = "CREATE DATABASE $database ";
if ($conn->query($sql) === TRUE) {
   echo "Database created successfully";
} else {
    echo "Error creating '$database': " . $conn->error;
}
======= */
$servername = "localhost";
$username = "root";
$password = "";
$database = "startupdb";
$conn = new mysqli($servername, $username, $password);
//Create a Database
$sql = "CREATE DATABASE $database ";
if ($conn->query($sql) === TRUE) {
   //echo "Database created successfully";
} else {
   // echo "Error creating '$database': " . $conn->error;
}
mysqli_close($conn);
// >>>>>>> origin/master
// closing connection, cause we need to connect to the new database
//new connection to the database
	
// $servername = "sql3.freemysqlhosting.net";
// $username = "sql3119062";
// $password = "M3SFZ429pu";
// $database = "sql3119062";
// <<<<<<< HEAD
// $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $server = $url["host"];
// $username = $url["user"];
// $password = $url["pass"];
// $db = substr($url["path"], 1);
// $conn = new mysqli($server, $username, $password, $db);
// =======
// $url = parse_url(getenv("CLEARDB_DATABASE_URL"));
// $server = $url["host"];
// $username = $url["user"];
// $password = $url["pass"];
// $db = substr($url["path"], 1);
// $conn = new mysqli($server, $username, $password, $db);
// >>>>>>> origin/master

// Create connection we use $conn instead of $link
$conn = new mysqli($servername, $username, $password, $database);
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error($conn);
  }
  ?>
