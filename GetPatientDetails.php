<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=UTF-8");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "connection.php"; 

$response = [];

if (isset($_GET['id'])) {
    $patientId = mysqli_real_escape_string($con, $_GET['id']);

    $query = "SELECT * FROM patientdata WHERE id = '$patientId'"; 

    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $response['message'] = 'Patient details fetched successfully';
        $response['data'] = mysqli_fetch_assoc($result);
    } else {
        $response['message'] = 'No patient found with the given ID';
    }
} else {
    $response['message'] = 'Patient ID not provided';
}

echo json_encode($response);
?>
