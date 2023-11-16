<?php
 include("dbConnection.php");

 
$resultArr = ["status"=>true,"error"=>null, "data"=> []];
if (isset($_POST["insert"])) {
    $data = $_POST["user_data"];
    
   $firstName = $data["first_name"];
   $lastName = $data["last_name"];
   $userRole = $data["user_role"];
   $userStatus = $data["user_status"];
   $resultArr["status"] = true;
   if (!(empty($firstName)) && !(empty($lastName)) && !(empty($userRole))  ) {
    $sql = "INSERT INTO users (username, userfamilyname, user_role, user_status) VALUES (?, ?, ?, ?);";
    $statement = $dbh->prepare($sql);
    $statement->execute([$firstName, $lastName, $userRole, $userStatus]);

     // Fetch last elemedt bd 
    $stmt = $dbh->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);	
    $resultArr["status"] = true;
   
    if ($rows) {
     foreach($rows as $row) {
       array_push($resultArr["data"], $row);
       header("content-type: application/json");
       echo json_encode($resultArr);
     }
    }
   }
  
 
  
}else {
  header("content-type: application/json");
  echo json_encode($resultArr);
}

$dhb = null;
$statement = null;

exit();

?>