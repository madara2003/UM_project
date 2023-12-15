<?php
 include("dbConnection.php");

  $data = $_POST["user_data"];
 $resultArr = ["status"=>false,"error"=>null, "user"=>null];
if (isset($_POST["insert"])) {
    $data = $_POST["user_data"];
    $role = [1 => 'User', 2 => 'Admin'];
    $firstName = trim($data["first_name"]);
    $lastName = trim($data["last_name"]);
    $userRole = $role[$data["user_role"]];
    $userStatus = $data["user_status"];

   if (!(empty($firstName)) && !(empty($lastName)) && !(empty($userRole))  ) {
    $sql = "INSERT INTO users (username, userfamilyname, user_role, user_status) VALUES (?, ?, ?, ?);";
    $statement = $dbh->prepare($sql);
    $statement->execute([$firstName, $lastName, $userRole, $userStatus]);

     // Fetch last elemedt bd 
    $stmt = $dbh->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);	
    
    if ($rows) {
     foreach($rows as $row) {
         $resultArr["status"] = true;
         $resultArr["user"] = $row;
         echo json_encode($resultArr);
     }
    }else {
        $resultArr["error"]  = ["code"=> "500", "massage"=> "Internal Server Error"];
    }
   }
}


 if ($resultArr["status"]===false) {
  $resultArr["user"] = $data;
  echo json_encode($resultArr);
}

$dhb = null;
$statement = null;
exit();

?>