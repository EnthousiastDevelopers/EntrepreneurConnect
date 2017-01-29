<?php 

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
if(isset ($request->action)){
$action = $request->action;
}
if (!isset($action)){
	$action = $_POST['action'];
//echo 'action is: '.$action.'<br>';
	}

if($action == 'edit'){
	
$value = $request->message;
$id = $request->id;
	
  require 'config.php';
  mysqli_query($conn, "UPDATE  profile SET Value = '$value' WHERE ID='$id'");	

echo mysqli_affected_rows($conn);
}


if($action=='update_opened_chats') {
	require 'config.php';
$myid = $request->myid;
$arrayID = $request->Interlocuter;
// print_r($arrayID);
// $arrayID = array(15, 16,19);
$sql = "SELECT * FROM messages where (`FromID` IN (".implode(',',$arrayID).") AND ToID='$myid' AND Status = '0')";

// echo  implode(',',$arrayID);
// echo  $sql;
$result = $conn -> query ($sql);
$data = array();
while ($row = mysqli_fetch_array($result)){	
$data[] = $row;
}
print json_encode($data);
//SET MESSAGE AS SEEN
$sql_update = "UPDATE messages SET Status = 1 where (`FromID` IN (".implode(',',$arrayID).") AND ToID='$myid' AND Status = '0')";
mysqli_query($conn, $sql_update);	
}




if($action == 'updatePicture'){
	$id = $request->id;
$value = $request->PictureID;
$me = $id;
  require 'config.php';
  mysqli_query($conn, "UPDATE  users SET PictureID = '$value' WHERE ID='$me'");	

echo mysqli_affected_rows($conn);
}

if($action == 'updatePreference'){
	$id = $request->id;
$value = $request->preferenceID;
$me = $id;
  require 'config.php';
  mysqli_query($conn, "UPDATE  users SET FirstInterest = '$value' WHERE ID='$me'");	

echo mysqli_affected_rows($conn);
}



if ($action == 'delete') {
$id = $request->id;
	
  require 'config.php';
  mysqli_query($conn, "DELETE from profile WHERE ID='$id'");


echo mysqli_affected_rows($conn);
}


if ($action == 'add') {
$title = $request->Title;
$value = $request->Value;
$parent = $request->Parent;
$category = $request->Category;
	
  require 'config.php';
  
//inserting data
$sql = "INSERT INTO profile (Title,Value,Parent,Category) VALUES ('$title','$value','$parent','$category')";

if (mysqli_query($conn, $sql)) {
	//if the picture is uploaded sucessfully,it will be moved inside the container folder
 $sql2 ="SELECT ID FROM profile where Parent = '$parent' and Category = '$category' and Title='$title' and Value='$value'";
   $result = $conn->query($sql2);
   while ($row = mysqli_fetch_array($result)) {
  $newID = $row['ID'];
  echo $newID;
}
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}


if ($action == 'sendMessage') {
$FromID = $request->FromID;
$ToID = $request->ToID;
$Value = $request->Value;
  require 'config.php';
$Value = mysqli_real_escape_string($conn, $Value);	
  
//inserting data
$sql = "INSERT INTO messages (FromID,ToID,Value) VALUES ('$FromID','$ToID','$Value')";

if (mysqli_query($conn, $sql)) {
echo '1';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}





if ($action == 'EditMyRatings') {
$message = $request->message;
$Author = $request->authorID;
$parent = $request->id;
$category = 'ratings';
$title = 'update error';
	
  require 'config.php';
  //var_dump( $message);

//inserting data



$sql = "INSERT INTO profile (ID, Title,Value,Parent,Category, Author) VALUES " ;
  $n = 0;
foreach ($message as $object) {
  $array = get_object_vars($object);
  foreach ($array as $key => $values) {
	  
	$id = $key;
	foreach($values as $title => $value) {
	
	//echo '<br> Title is: '.$title.'<br>';
	if($n == 0) {
$sql_temp = "('$id','$title','$value','$parent','$category', '$Author')";
	}else {
$sql_temp = ",('$id','$title','$value','$parent','$category','$Author')";
	}}
	
	
	$n++;
$sql .= $sql_temp; 
}};
$sql .= "ON DUPLICATE KEY UPDATE Value=VALUES(Value)";

//echo $sql.'<br>';

if (mysqli_query($conn, $sql)) {
	//if the picture is uploaded sucessfully,it will be moved inside the container folder
 $sql2 ="SELECT ID FROM profile where Parent = '$parent' and Category = '$category' and Title='$title' and Value='$value'";
   $result = $conn->query($sql2);
   while ($row = mysqli_fetch_array($result)) {
  $newID = $row['ID'];
  //echo $newID;
}
echo '1';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
if ($action == 'AddRating') {
$message = $request->message;
$Author = $request->authorID;
$parent = $request->id;
$category = 'ratings';
	
  require 'config.php';
  //var_dump( $message);

//inserting data
$sql = "INSERT INTO profile (Title,Value,Parent,Category, Author) VALUES " ;
  $n = 0;
foreach ($message as $object) {
  $array = get_object_vars($object);
  foreach ($array as $key => $value) {
	  
	$title = $key;
	$value = $value;
	//echo '<br> Title is: '.$title.'<br>';
	if($n == 0) {
$sql_temp = "('$title','$value','$parent','$category', '$Author')";
	}else {
$sql_temp = ",('$title','$value','$parent','$category','$Author')";
	}
	$n++;
$sql .= $sql_temp; 
}};

// echo $sql.'<br>';

if (mysqli_query($conn, $sql)) {
	//if the picture is uploaded sucessfully,it will be moved inside the container folder
 $sql2 ="SELECT ID FROM profile where Parent = '$parent' and Category = '$category' and Title='$title' and Value='$value'";
   $result = $conn->query($sql2);
   while ($row = mysqli_fetch_array($result)) {
  $newID = $row['ID'];
  //echo $newID;
}
echo '1';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}


if ($action == 'signup') {
session_start();
  require 'config.php';
	//print_r($request);
$username = $request->uname;
$email = $request->email;
$firstname = $request->firstname;
$lastname = $request->lastname;
$password = $request->pswd;
$pictureid = $request->pictureid;
		  
				  
  
//inserting data
$sql = "INSERT INTO users (Username,Email,FirstName,LastName,Password,PictureID) VALUES ('$username','$email','$firstname','$lastname','$password','$pictureid')";

if (mysqli_query($conn, $sql)) {
	//if the picture is uploaded sucessfully,it will be moved inside the container folder
 $sql2 ="SELECT * FROM users where Email = '$email' and Password = '$password' and Username='$username' and LastName='$lastname'";
   $result = $conn->query($sql2);
   while ($row = mysqli_fetch_array($result)) {
 
	    session_start();
  $_SESSION['userID'] = $row['ID'];
  
  $newID = $row['ID'];
  echo $newID;
}
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}





if($action == 'upload'){
if(isset($_FILES['file'])){
    //The error validation could be done on the javascript client side.
	
    $errors= array();        
    $file_name = $_FILES['file']['name'];
    $file_size =$_FILES['file']['size'];
    $file_tmp =$_FILES['file']['tmp_name'];
    $file_type=$_FILES['file']['type'];   
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $extensions = array("jpeg","jpg","png");        
    if(in_array($file_ext,$extensions )=== false){
     $errors[]="file extension not allowed, please choose a JPEG or PNG file.";
    }
    if($file_size > 2097152){
    $errors[]='File size cannot exceed 2 MB';
    }         
 $file_path = "uploads/".$file_name;	
    if(empty($errors)==true){
        move_uploaded_file($file_tmp,"uploads/".$file_name);
       // echo " uploaded file: " . "uploads/" . $file_name;
		
		$title = 'PictureUrl';
		$parent = $_POST['id'];
		$category = 'bio';
		$value = $file_path;
		
//inserting data
require 'config.php';
$sql = "INSERT INTO profile (Title,Parent,Category, Value) VALUES ('$title','$parent','$category', '$value')";

if (mysqli_query($conn, $sql)) {
	//if the picture is uploaded sucessfully,it will be moved inside the container folder
   
 $sql2 ="SELECT * FROM profile where Parent = '$parent' and Category = '$category' and Title='$title' and Value='$value'";
   $result = $conn->query($sql2);
  
  
  $data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = $row;
}
    print json_encode($data);
	
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//end insert sql
    }else{
        print_r($errors);
    }
}
}


if($action == 'login') {
	require 'config.php';
$uname = $request->uname;
$password = $request->pswd;

    $uname = mysqli_real_escape_string($conn,$uname);
    $password = mysqli_real_escape_string($conn,$password);
  $sql = "SELECT * FROM users WHERE (Email = '$uname'  OR  Username='$uname')";
 
   $result = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($result);
	
	if($count == 1) {
 while ($row = mysqli_fetch_array($result)) {

 $password_real = $row['Password'];
 if ($password_real == $password){
	 	    session_start();
  $_SESSION['userID'] = $row['ID'];

	 echo 0;
 }else{
	 echo 2;
 }
   }
	}else {
		echo 1;
	}
}

if ($action == 'uploadPicture') {
$title = 'PictureURL';
$value = $request->Value;
$parent = $request->Parent;
$category = $request->Category;
	
  require 'config.php';
  
  $filepath = "uploads/";
  	


$file_name = $_FILES['picture']['name'];
$file_type = $_FILES['picture']['type'];

$target_Path = $parent.$filepath.'_'.basename( $_FILES['picture']['name'] );

//inserting data
$sql = "INSERT INTO profile (Title,ID,Parent,Category) VALUES ('$title','$id','$parent','$category')";


if (mysqli_query($conn, $sql)) {
	//if the picture is uploaded sucessfully,it will be moved inside the container folder
        move_uploaded_file( $_FILES['picture']['tmp_name'], "$target_Path" );
   
 $sql2 ="SELECT Value FROM profile where Parent = '$parent' and Category = '$category' and Title='$title' and ID='$id'";
   $result = $conn->query($sql2);
   while ($row = mysqli_fetch_array($result)) {
  $newID = $row['ID'];
  echo $newID;
   }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}


  if ($action=='upload-temp'){
  
//inserting data
$sql = "INSERT INTO profile (Title,Value,Parent,Category) VALUES ('$title','$value','$parent','$category')";

if (mysqli_query($conn, $sql)) {
	//if the picture is uploaded sucessfully,it will be moved inside the container folder
 $sql2 ="SELECT ID FROM profile where Parent = '$parent' and Category = '$category' and Title='$title' and Value='$value'";
   $result = $conn->query($sql2);
   while ($row = mysqli_fetch_array($result)) {
  $newID = $row['ID'];
  echo $newID;
}
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}
?>