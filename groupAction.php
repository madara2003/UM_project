<?php
 include("dbConnection.php");

 $usersId = $_POST["users_id"];
 $arrResult = ["status"=>false, "error"=>null, "ids"=>"dare"];

if (isset($usersId)) {
 if ($_POST["click_group_btn"] ==="1") {
   foreach ($usersId as $userId) {
     $userStatus = "1";
     $sql = "UPDATE users SET  user_status=? WHERE id=?";
     $stmt= $dbh->prepare($sql);
     $stmt->execute([$userStatus, $userId]);
   }
 }

 if ($_POST["click_group_btn"] ==="2") {
   foreach ( $usersId as $userId) {
     $userStatus = "0";
     $sql = "UPDATE users SET  user_status=? WHERE id=?";
     $stmt= $dbh->prepare($sql);
     $stmt->execute([$userStatus, $userId]);
    }
 }

 if ($_POST["click_group_btn"] ==="3") {
   foreach ( $usersId as $userId) {
      $sql = "DELETE FROM users WHERE id=?";
      $stmt= $dbh->prepare($sql);
      $stmt->execute([$userId]);
   }
 }
 if (isset($stmt)) {
    if ($_POST["click_group_btn"] ==="1" || $_POST["click_group_btn"] ==="2") {
      if ($stmt->execute([$userStatus, $userId])) {
        $arrResult["status"] = true;
      }else {
        $arrResult["error"] = "something went wrong";
      }
    }else if ($_POST["click_group_btn"] ==="3") {
      $countDelRows = $stmt->rowCount();
   
      if($countDelRows > 0){
        $arrResult["status"] = true;
       } else {
        $arrResult["error"] = "something went wrong";
       }
    }
 }
}
 $arrResult["ids"] = $usersId;
 header("content-type: application/json");
 echo json_encode($arrResult);
 

 $dhb = null;
 $stmt = null;
 exit();
 
 ?>