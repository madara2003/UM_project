<?php
 include("dbConnection.php");

$arrResult = ["status"=>false, "error"=>null, "user"=>null];
if (isset($_POST["click_fetch_btn"])) {
   $id = $_POST["user_id"]; 
   $sql ="SELECT * FROM users WHERE id = $id";
   $sth = $dbh->prepare($sql);
   $sth->execute();
   $result = $sth->fetchAll(PDO::FETCH_ASSOC);

   if ($result) {
    foreach($result as $row) {
      $arrResult["user"] = $row;
      $arrResult["status"] = true;
      echo json_encode($arrResult);
    }
   }else {
    $arrResult["error"]  = ["code"=> "404", "massage"=> "User not found"];
    echo json_encode($arrResult);
   }
}

if (isset($_POST["click_update_btn"])) {
    $userId =$_POST["user_update_id"];
    $data = $_POST["user_data"]; 
    $role = [1 => 'User', 2 => 'Admin'];
    $userRole = $role[$data["user_role"]];
    $data["user_role"] = $userRole;
    $firstName = trim($data["first_name"]);
    $lastName = trim($data["last_name"]);
    $userStatus = intval($data["user_status"]);
    if (!(empty($firstName)) && !(empty($lastName)) && !(empty($userRole))  ) {
     $sql = "UPDATE users SET username=?, userfamilyname=?, user_role=?, user_status=? WHERE id=?";
     $stmt= $dbh->prepare($sql);
     $stmt->execute([$firstName, $lastName, $userRole, $userStatus, $userId]);
     $countDelRows = $stmt->rowCount();

     if ($stmt->execute([$firstName, $lastName, $userRole, $userStatus, $userId])) {
      $arrResult["status"] = true;
     }else {
      $arrResult["status"] = false;
      $arrResult["error"]  = ["code"=> "404", "massage"=> "User not found"];
     }
   }
  
  $arrResult["user"] = $data;
  echo json_encode($arrResult);
        
}

$dhb = null;
$stmt = null;
exit();

?>