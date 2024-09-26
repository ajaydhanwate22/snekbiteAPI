<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

require "connection.php";

$response = []; 

$method = $_SERVER["REQUEST_METHOD"];
if($method == "POST"){

    $AuthorizesName = $_POST["AuthorizesName"];
    $password = md5($_POST["Password"]);


if (empty($AuthorizesName)) {
    $response['message'] = "Authorizes Name is required";
    echo json_encode($response);
    exit();
}

if (empty($password)) {
    $response['message'] = "Password is required";
    echo json_encode($response);
    exit();
} 


$checkUser = "SELECT * FROM treatmentcenter WHERE AuthorizesName = '$AuthorizesName'";
$result = mysqli_query($con, $checkUser);

if ($result) {
    if (mysqli_num_rows($result) > 0) {             
        $row = mysqli_fetch_assoc($result);
        if ($password === $row['Password']) {
            $response['message'] = "LoggedIn successfully";
            $response['user'] = $row;
        } else {
            $response['message'] = "Password Does Not Match";
        }              
    } else {
        $response['message'] = "User does not exist";
    }
} else {
    $response['message'] = "Please Try After Some Time";
}
}

echo json_encode($response);
?>
