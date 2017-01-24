<?php
   include('config.php');
   session_start();
 if(!isset($_SESSION['userID'])){
      header("location:login.html");
   }else {
	      $user_check = $_SESSION['userID'];
   // echo 'checkpoint 1 <br>';
   
   $ses_sql = mysqli_query($conn,"select * from users where ID = '$user_check' ");
  
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
    $id = $row["ID"];
    $first_name = $row["FirstName"];
       $last_name = $row["LastName"];
      $username = $row["Username"];
      $pictureid = $row["PictureID"];
      $email = $row["Email"];
	  // echo $email;
	  // echo ',';
	  // echo $id;

   }

   
?>