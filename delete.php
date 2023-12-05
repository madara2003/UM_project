<?php
 include("dbConnection.php");

 $arrResult = ["status"=>false, "error"=>null, "id"=>null];
 if (isset($_POST["click_delete_btn"])) {
    $id = $_POST["user_id"]; 
    $sql = "DELETE FROM users WHERE id=?";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$id]);
    $countDelRows = $stmt->rowCount();
   
    if($countDelRows > 0){
      $arrResult["status"] = true;
     } else {
      $arrResult["error"]  = ["code"=> "404", "massage"=> "User not found"];
     }
      $arrResult["id"] = $id;
      echo json_encode($arrResult);
 }else {

      echo json_encode($arrResult);
 }
 $dhb = null;
 $stmt = null;
 exit();

 ?>