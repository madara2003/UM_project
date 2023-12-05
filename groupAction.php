<?php
 include("dbConnection.php");

 $usersId = $_POST["users_id"];
 $arrResult = ["status"=>false, "error"=>["code"=> "500", "massage"=> "Internal Server Error"], "ids"=>null];

 if ($_POST["click_group_btn"] ==="1") {
   foreach ($usersId as $userId) {
   
    $sql ="SELECT * FROM users WHERE id = $userId";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() == 0) {
     $arrResult["error"] = ["code"=> "404", "massage"=> "User not found"];
     break;
    }
     
     $userStatus = 1;
     $sql = "UPDATE users SET  user_status=? WHERE id=?";
     $stmt= $dbh->prepare($sql);
     $stmt->execute([$userStatus, $userId]);
     if ($stmt->execute([$userStatus, $userId])) {
      $arrResult["status"] = true;
    }
   }
 }

 if ($_POST["click_group_btn"] ==="2") {
   foreach ( $usersId as $userId) {
    $sql ="SELECT * FROM users WHERE id = $userId";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() == 0) {
     $arrResult["error"] = ["code"=> "404", "massage"=> "User not found"];
     break;
    }
    
     $userStatus = 0;
     $sql = "UPDATE users SET  user_status=? WHERE id=?";
     $stmt= $dbh->prepare($sql);
     $stmt->execute([$userStatus, $userId]);
     if ($stmt->execute([$userStatus, $userId])) {
       $arrResult["status"] = true;
     } 
    }
 }

 if ($_POST["click_group_btn"] ==="3") {
   foreach ( $usersId as $userId) {
    $sql ="SELECT * FROM users WHERE id = $userId";
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount() == 0) {
     $arrResult["error"] = ["code"=> "404", "massage"=> "User not found"];
     break;
    }else {
      
    }

    $sql = "DELETE FROM users WHERE id=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$userId]);
     
   }
 }


 $arrResult["ids"] =  $usersId;
 echo json_encode($arrResult);
 

 $dhb = null;
 $stmt = null;
 exit();
 
 ?>