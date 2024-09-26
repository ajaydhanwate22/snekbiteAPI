<?php 

header("Access-Control-Allow-Origin: *");
header("Content-Type:application/json;charset=UTF-8");
header("Access-Control-Allow-Methods:POST");
header("Access-Control-Allow-Headers:Content-Type,Access-Control-Allow-Headers,Authorization,X-Requested-With");

require "connection.php";
$response = []; 

$method = $_SERVER["REQUEST_METHOD"];

if($method == "POST"){
    
    $data = json_decode(file_get_contents("php://input"),true);
 
    $username =$_POST["Username"];
    $password =$_POST["Password"];


    if (empty($username)) {
        $response['message'] = "Username is required";
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

$checkUser = "SELECT * FROM guest WHERE Username = '$username'";
$result = mysqli_query($con, $checkUser);

if ($result) {
    if (mysqli_num_rows($result) > 0) {             
        $row = mysqli_fetch_assoc($result);
        if ($hashedPassword === $row['Password']) {
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
