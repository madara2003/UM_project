<?php
 include("dbConnection.php");


if (isset($_POST["click_fetch_btn"])) {
    
   $id = $_POST["user_id"]; 
   $resultArr = [];

   $sql ="SELECT * FROM users WHERE id = $id";
   $sth = $dbh->prepare($sql);
   $sth->execute();
   $result = $sth->fetchAll(PDO::FETCH_ASSOC);

   if ($result) {
    foreach($result as $row) {
      array_push($resultArr, $row);
      header("content-type: application/json");
      echo json_encode($resultArr);
    }
   }
   
}

$arrResult = ["status"=>null, "error"=>null, "user"=>null];

if (isset($_POST["click_update_btn"])) {
    // $userId = $_POST["user_update_id"];
    $userId =$_POST["user_update_id"];
    $data = $_POST["user_data"];
   
    
    $firstName = $data["first_name"];
    $lastName = $data["last_name"];
    $userRole = $data["user_role"];
    $userStatus = intval($data["user_status"]);
    // if (!(empty($firstName)) && !(empty($lastName)) && !(empty($userRole))  ) {
     $sql = "UPDATE users SET username=?, userfamilyname=?, user_role=?, user_status=? WHERE id=?";
     $stmt= $dbh->prepare($sql);
     $stmt->execute([$firstName, $lastName, $userRole, $userStatus, $userId]);
     $countDelRows = $stmt->rowCount();

     if ($stmt->execute([$firstName, $lastName, $userRole, $userStatus, $userId])) {
      // $arrResult["status"] = true;
     }else {
      $arrResult["error"] = "something went wrong";
     }
  }         
// }

$arrResult["user"] = $data;
header("content-type: application/json");
echo json_encode($arrResult);

$dhb = null;
$stmt = null;
exit();

?>