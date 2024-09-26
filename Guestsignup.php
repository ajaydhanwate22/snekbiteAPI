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

$username =$_POST["Username"];
$contactNumber =$_POST["ContactNumber"];
$mailid =$_POST["Mail"];
$address =$_POST["Address"];
$profession =$_POST["Profession"];
$password =$_POST["Password"];



if (empty($username)) {
    $response['message'] = "Username is required";
    echo json_encode($response);
    exit();
}


if (empty($contactNumber)) {
    $response['message'] = "Contact number is required";
    echo json_encode($response);
    exit();
} elseif (!is_numeric($contactNumber)) {
    $response['message'] = "Contact number must contain only numbers";
    echo json_encode($response);
    exit();
} elseif (strlen($contactNumber) != 10) {  
    $response['message'] = "Contact number must be 10 digits long";
    echo json_encode($response);
    exit();
}


if (empty($mailid )) {
    $response['message'] = "Email is required";
    echo json_encode($response);
    exit();
} elseif (!filter_var($mailid , FILTER_VALIDATE_EMAIL)) {
    $response['message'] = "Invalid email format";
    echo json_encode($response);
    exit();
}

if (empty($address)) {
    $response['message'] = "Address is required";
    echo json_encode($response);
    exit();
} 


if (empty($profession)) {
    $response['message'] = "Profession is required";
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

$hashedPassword = md5($password);





$checkUser = "SELECT * FROM guest WHERE Username = '$username' ";
$checkQuery = mysqli_query($con, $checkUser);

if (mysqli_num_rows($checkQuery) > 0) {
    $response['message'] = 'User already exists';
    echo json_encode($response);
    exit();
} else { 
    $query = "INSERT INTO guest(Username,ContactNumber,Mail,Address,Profession,Password) 
    VALUES ('$username', '$contactNumber','$mailid','$address','$profession','$hashedPassword')";

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
