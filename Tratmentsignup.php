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

$centerName =$_POST["CenterName"];
$centerLocation =$_POST["CenterLocation"];
$email =$_POST["EmailID"];
$contactNumber =$_POST["ContactNumber"];
$currentASV =$_POST["CurrentstockASV"];
$availableASV =$_POST["AvailabilityofASV"];
$description =$_POST["Description"];
$authorizesname =$_POST["AuthorizesName"];
$password =$_POST["Password"];
$confirmpassword =$_POST["ConfirmPassword"];



if (empty($centerName)) {
    $response['message'] = "centerName is required";
    echo json_encode($response);
    exit();
}
if (empty($currentASV)) {
    $response['message'] = "update current stock ASV";
    echo json_encode($response);
    exit();
}
if (empty($availableASV)) {
    $response['message'] = "update Available stock ASV";
    echo json_encode($response);
    exit();
}
if (empty($description)) {
    $response['message'] = "fill the description";
    echo json_encode($response);
    exit();
}
if (empty($authorizesname)) {
    $response['message'] = "authorizes name is required";
    echo json_encode($response);
    exit();
}
if (empty($centerLocation)) {
    $response['message'] = "centerLocation is required";
    echo json_encode($response);
    exit();
}
if (empty($email)) {
    $response['message'] = "Email is required";
    echo json_encode($response);
    exit();
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['message'] = "Invalid email format";
    echo json_encode($response);
    exit();
}
if (empty($contactNumber)) {
    $response['message'] = "contactNumber number is required";
    echo json_encode($response);
    exit();
} elseif (!preg_match('/^[0-9]{10}$/', $contactNumber)) {
    $response['message'] = "Invalid contactNumber number format";
    echo json_encode($response);
    exit();
}
if (empty($password)) {
    $response['message'] = "Password is required";
    echo json_encode($response);
    exit();
} elseif (strlen($password) < 6) {
    $response['message'] = "Password must be at least 6 characters";
    echo json_encode($response);
    exit();
}
if ($password !== $confirmpassword) {
    $response['message'] = "Passwords do not match";
    echo json_encode($response);
    exit();
}
$hashedPassword = md5($password);


$checkUser = "SELECT * FROM treatmentcenter WHERE AuthorizesName = '$authorizesname' ";
$checkQuery = mysqli_query($con, $checkUser);

if (mysqli_num_rows($checkQuery) > 0) {
    $response['message'] = 'User already exists';
    echo json_encode($response);
    exit();
} else { 
    $query = "INSERT INTO treatmentcenter(CenterName, CenterLocation, EmailID, ContactNumber,CurrentstockASV,AvailabilityofASV,AuthorizesName,Password) VALUES ('$centerName', '$centerLocation', '$email', '$contactNumber','$currentASV','$availableASV','$authorizesname','$hashedPassword')";

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
