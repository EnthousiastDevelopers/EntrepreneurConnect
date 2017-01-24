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