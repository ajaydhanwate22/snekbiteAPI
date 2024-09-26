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
$patientstatus =$_POST["Patientstatus"];
$anyDisablity =$_POST["AnyDisablity"];



if (empty($name)) {
    $response['message'] = "Please enter your name.";
    echo json_encode($response);
    exit();
}
if (empty($age)) {
    $response['message'] = "Please provide your age.";
    echo json_encode($response);
    exit();
}
if (empty($gender)) {
    $response['message'] = "Please select your gender.";
    echo json_encode($response);
    exit();
}
if (empty($contactNumber)) {
    $response['message'] = "Contact number is required. Please provide a valid number.";
    echo json_encode($response);
    exit();
}
if (empty($address)) {
    $response['message'] = "Please enter your address.";
    echo json_encode($response);
    exit();
}
if (empty($snakeID)) {
    $response['message'] = "Snake ID is required. Please enter the identification of the snake.";
    echo json_encode($response);
    exit();
}
if (empty($biteLocation)) {
    $response['message'] = "Please specify the bite location.";
    echo json_encode($response);
    exit();
}
if (empty($affectedbodypart)) {
    $response['message'] = "Please indicate which body part is affected.";
    echo json_encode($response);
    exit();
}
if (empty($usedASV)) {
    $response['message'] = "Please specify the amount of ASV used.";
    echo json_encode($response);
    exit();
}
if (empty($rescuername)) {
    $response['message'] = "Please provide the name of the rescuer.";
    echo json_encode($response);
    exit();
}
if (empty($patientstatus)) {
    $response['message'] = "Please provide the patient status.";
    echo json_encode($response);
    exit();
}
if (empty($anyDisablity)) {
    $response['message'] = "Please specify if there are any disabilities.";
    echo json_encode($response);
    exit();
}



$checkUser = "SELECT * FROM tratmentformdata WHERE Name = '$name' AND ContactNumber = '$contactNumber'";
$checkQuery = mysqli_query($con, $checkUser);

if (mysqli_num_rows($checkQuery) > 0) {
    $response['message'] = 'User already exists with this name and contact number.';
    echo json_encode($response);
    exit();
} else { 

    $query = "INSERT INTO tratmentformdata (Name, Age, Gender, ContactNumber, Address, SnakeID, BiteLocation, AffectedBodypart, UsedASV, Rescuername,Patientstatus,AnyDisablity) VALUES ('$name', '$age', '$gender','$contactNumber','$address', '$snakeID','$biteLocation','$affectedbodypart','$usedASV','$rescuername' ,'$patientstatus', '$anyDisablity',)";

    $fire = mysqli_query($con, $query);
    
    if ($fire) {
        $response['message'] = "Registration successfully";
    } else {
        $response['message'] = "Failed to register. Please try again."; 
    }
}
}

echo json_encode($response);
?>
