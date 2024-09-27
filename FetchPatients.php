<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json;charset=UTF-8");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require "connection.php"; 

$response = [];

$query = "SELECT * FROM patientdata"; 

$result = mysqli_query($con, $query);

if ($result) {
    $patients = [];
    
    while ($row = mysqli_fetch_assoc($result)) {
        $patients[] = [
             'id' => $row['id'],
            'fullname' => $row['FullName'],
            'snakeID' => $row['SnakeID'],
            'usedASV' => $row['UsedASV']
        ];
    }
    

    if (count($patients) > 0) {
        $response['message'] = 'Patients fetched successfully';
        $response['data'] = $patients; 
    } else {
        $response['message'] = 'No patients found';
    }
} else {
    $response['message'] = 'Database query failed';
}


echo json_encode($response);

?>
