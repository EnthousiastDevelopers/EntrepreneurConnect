 <?php
  require 'config.php';
  $query = $_GET["q"];
    $parent = $_GET["id"];
	
if($query=='profile') {
	
  $category = $_GET["c"];

  $sql="SELECT * FROM profile where Parent = '$parent' and Category = '$category'";
    $result = $conn->query($sql);
	
$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
    print json_encode($data);
}


if($query=='messages') {
$myid = $_GET['myid'];

$sql= "(SELECT * FROM (SELECT users.FirstName AS ToFirstName, users.LastName AS ToLastName, TEMP2.* FROM users INNER JOIN (SELECT users.FirstName, users.LastName, TEMP.* FROM users INNER JOIN(SELECT * FROM messages where (FromID = '$parent' AND ToID='$myid') OR (ToID = '$parent' AND FromID='$myid') ORDER BY Timestamp DESC LIMIT 20) AS TEMP ON users.ID = TEMP.FromID) AS TEMP2 ON users.ID = TEMP2.ToID) sub ORDER BY Timestamp)";


$result = $conn -> query ($sql);
$data = array();
while ($row = mysqli_fetch_array($result)){	
$data[] = $row;
}
print json_encode($data);
//SET MESSAGE AS SEEN
set_received_msg_to_seen();
$sql_update = "UPDATE messages SET Status = 1 where (FromID = '$parent' AND ToID='$myid' AND Status = '0')";
mysqli_query($conn, $sql_update);	
}


function set_received_msg_to_seen() {
	
// echo mysqli_affected_rows($conn);
}

if($query=='inbox') {
$myid = $_GET['myid'];
$sql = "SELECT users.FirstName AS ToFirstName, users.LastName AS ToLastName, TEMP2.* FROM users INNER JOIN (SELECT users.FirstName, users.LastName, TEMP.* FROM users INNER JOIN (SELECT * FROM messages INNER JOIN (SELECT DISTINCT MAX(ID) AS MSGID FROM messages where (ToID='$myid') OR (FromID='$myid') GROUP BY LEAST(FromID, ToID)) AS TEMP ON messages.ID = TEMP.MSGID ORDER BY Timestamp DESC LIMIT 20) AS TEMP ON users.ID = TEMP.FromID) AS TEMP2 ON users.ID = TEMP2.ToID";


$result = $conn -> query ($sql);
$data = array();
while ($row = mysqli_fetch_array($result)){	
$data[] = $row;
}
print json_encode($data);
}

if($query=='check_updates') {
$myid = $_GET['myid'];
$sql = "SELECT MAX(ID) FROM messages where  ToID='$myid' LIMIT 1";

$result = $conn -> query ($sql);
 while($row = mysqli_fetch_array($result)){
// print_r ($row);
echo ($row['MAX(ID)']);
// echo mysqli_num_rows($result);
 };
}

if($query=='explore_profile') {
	
  $category = $_GET["c"];

  $sql="SELECT * FROM profile ";
    $result = $conn->query($sql);
	
$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
    print json_encode($data);
}





if($query == 'user')	{
	
  $sql="SELECT * FROM users where ID = '$parent'";
    $result = $conn->query($sql);
	
$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
    print json_encode($data);
}
if($query == 'explore')	{
	
  $sql="SELECT ID, FirstName, LastName, PictureID FROM users";
    $result = $conn->query($sql);
	
$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
    print json_encode($data);
}
	
	
?>