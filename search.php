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

if($action == 'quicksearch'){

	$searchvalue = $request->searchvalue;
	$searchrating = $request->searchrating;
	
	require 'config.php';
	
$sql="(SELECT USERS.id AS ID, 
        COMPLETEPROMMASTER.Rate, 
        COMPLETEPROMMASTER.valuespro, 
        COMPLETEPROMMASTER.vision, 
        COMPLETEPROMMASTER.core, 
        COMPLETEPROMMASTER.skills, 
        COMPLETEPROMMASTER.service, 
        COMPLETEPROMMASTER.product, 
        COMPLETEPROMMASTER.honnesty, 
        COMPLETEPROMMASTER.ambition, 
        COMPLETEPROMMASTER.courage, 
        COMPLETEPROMMASTER.integrity, 
        COMPLETEPROMMASTER.creativity, 
        USERS.FirstName, 
        USERS.LastName, 
        USERS.PictureUrl 
 FROM   (SELECT users.id        AS ID, 
                users.firstname AS FirstName, 
                users.lastname  AS LastName, 
                profile.value   AS PictureUrl 
         FROM   profile 
                INNER JOIN users 
                        ON users.pictureid = profile.id 
         GROUP  BY users.id) AS USERS 
        INNER JOIN (SELECT ID AS ID, 
                           ( courage + ambition + creativity + integrity 
                             + honnesty ) / 5 
                                                         AS 
                                                                    Rate, 
                           Concat_ws(', ', vision, core, status, skills, product 
                           , 
                           service) AS 
                                                                    VALUESPRO, 
                           vision, 
                           core, 
                           skills, 
                           service, 
                           product, 
                           honnesty, 
                           ambition, 
                           courage, 
                           integrity, 
                           creativity 
                    FROM   (SELECT profile.parent              AS ID, 
                                   Group_concat(profile.value) AS VALUE, 
                                   Group_concat(( CASE 
                                                    WHEN profile.title = 'core' 
                                                  THEN 
                                                    profile.value 
                                                    ELSE NULL 
                                                  END ))       AS CORE, 
                                   Group_concat(CASE 
                                                  WHEN profile.title = 'vision' 
                                                THEN 
                                                  profile.value 
                                                  ELSE NULL 
                                                END)           AS VISION, 
                                   Group_concat(CASE 
                                                  WHEN profile.title = 'service' 
                                                THEN 
                                                  profile.value 
                                                  ELSE NULL 
                                                END)           AS SERVICE, 
                                   Group_concat(CASE 
                                                  WHEN profile.title = 'skills' 
                                                THEN 
                                                  profile.value 
                                                  ELSE NULL 
                                                END)           AS SKILLS, 
                                   Group_concat(CASE 
                                                  WHEN profile.title = 'status' 
                                                THEN 
                                                  profile.value 
                                                  ELSE NULL 
                                                END)           AS STATUS, 
                                   Group_concat(CASE 
                                                  WHEN profile.title = 'product' 
                                                THEN 
                                                  profile.value 
                                                  ELSE NULL 
                                                END)           AS PRODUCT, 
                                   Avg(CASE 
                                         WHEN profile.title = 'Creativity' THEN 
                                         profile.value 
                                         ELSE NULL 
                                       END)                    AS CREATIVITY, 
                                   Avg(CASE 
                                         WHEN profile.title = 'Courage' THEN 
                                         profile.value 
                                         ELSE NULL 
                                       END)                    AS COURAGE, 
                                   Avg(CASE 
                                         WHEN profile.title = 'Honnesty' THEN 
                                         profile.value 
                                         ELSE NULL 
                                       END)                    AS HONNESTY, 
                                   Avg(CASE 
                                         WHEN profile.title = 'Ambition' THEN 
                                         profile.value 
                                         ELSE NULL 
                                       END)                    AS AMBITION, 
                                   Avg(CASE 
                                         WHEN profile.title = 'Integrity' THEN 
                                         profile.value 
                                         ELSE NULL 
                                       END)                    AS INTEGRITY 
                            FROM   profile 
                            GROUP  BY profile.parent) AS COMPLETEPRO) AS 
                                                 COMPLETEPROMMASTER 
                ON USERS.id = COMPLETEPROMMASTER.id WHERE (VALUESPRO LIKE '%$searchvalue%')
 GROUP  BY USERS.id) ";

 $result = $conn -> query($sql);	
 $data = array();
 while($row = mysqli_fetch_array($result)) {
	 $data[] = $row;
 }
 print json_encode ($data);
 }//end if action = quicksearch

 ?>