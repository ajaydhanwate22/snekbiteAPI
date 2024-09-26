<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset-UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Header, Authorization, X-Requested-With");


require "connection.php";
$response = []; 
$method = $_SERVER["REQUEST_METHOD"];
if ($method == "POST") {

    $data = json_decode(file_get_contents("php://input"), true);


$authorizesname =$_POST["AuthorizesName"];
$centerName =$_POST["CenterName"];
$usedASV =$_POST["UsedASV"];
$date =$_POST["Date"];

    $query = "INSERT INTO usedASVtretmentcenter(AuthorizesName,CenterName,UsedASV,Date) VALUES ('$authorizesname', '$centerName', '$usedASV', '$date')";
    
    $fire = mysqli_query($con, $query);
    if ($fire) {
        $response['message'] = "updated successfully";
    } else {
        $response['message'] = "Failed";
    }
}

echo json_encode($response);
?>
