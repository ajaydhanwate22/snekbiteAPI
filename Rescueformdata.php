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

$name =$_POST["Name"];
$age=$_POST["Age"];
$gender =$_POST["Gender"];
$contactNumber =$_POST["ContactNumber"];
$address =$_POST["Address"];
$snakeID =$_POST["SnakeID"];
$biteLocation =$_POST["BiteLocation"];
$affectedbodypart =$_POST["AffectedBodypart"];
$usedASV =$_POST["UsedASV"];
$rescuername =$_POST["Rescuername"];



if (empty($name)) {
    $response['message'] = "Name is required";
    echo json_encode($response);
    exit();
}
if (empty($age)) {
    $response['message'] = "Age is required";
    echo json_encode($response);
    exit();
}
if (empty($gender)) {
    $response['message'] = "Gender is required";
    echo json_encode($response);
    exit();
}
if (empty($contactNumber)) {
    $response['message'] = "ContactNumber is required";
    echo json_encode($response);
    exit();
}
if (empty($address)) {
    $response['message'] = "Address is required";
    echo json_encode($response);
    exit();
}
if (empty($snakeID)) {
    $response['message'] = "snakeID is required";
    echo json_encode($response);
    exit();
}
if (empty($biteLocation)) {
    $response['message'] = "Bite Location is required";
    echo json_encode($response);
    exit();
}
if (empty($affectedbodypart)) {
    $response['message'] = "Affected Body Part is required";
    echo json_encode($response);
    exit();
}
if (empty($usedASV)) {
    $response['message'] = "used ASV is required";
    echo json_encode($response);
    exit();
}
if (empty($rescuername)) {
    $response['message'] = "Rescuername is required";
    echo json_encode($response);
    exit();
}


$checkUser = "SELECT * FROM    rescueformdata WHERE Name = '$name' ";
$checkQuery = mysqli_query($con, $checkUser);

if (mysqli_num_rows($checkQuery) > 0) {
    $response['message'] = 'User already exists';
    echo json_encode($response);
    exit();
} else { 
    $query = "INSERT INTO  rescueformdata (Name, Age, Gender, ContactNumber, Address, SnakeID, BiteLocation, AffectedBodypart, UsedASV, Rescuername) VALUES ('$name', '$age', '$gender','$contactNumber','$address', '$snakeID','$biteLocation','$affectedbodypart','$usedASV','$rescuername')";

    $fire = mysqli_query($con, $query);
    

    if ($fire) {
        $response['message'] = "Registration successfully";
    } else {
        $response['message'] = "Failed"; 
    }
}
}

echo json_encode($response);
?>
