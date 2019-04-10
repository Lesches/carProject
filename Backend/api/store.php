<?php
require 'connect.php';

// Get the posted data.

$postdata = file_get_contents("php/input");

if(isset($postdata) && !empty($postdata)){
    // extract the data
    $request = json_decode($postdata);
    
    //validate
    if(trim($request->data->model) === ''|| (int)$request->data->price < 1){
        return http_response_code(400);
    }
    
    // sanitize
    
    $model = mysqli_real_escape_string($con, $trim($request->data->model));
    $model = mysqli_real_escape_string($con, $trim($request->data->price));
    
    // store
    $sql = "insert into `cars`(`id`, `model`, `price`) values(null, '{$model}', '{$price}')";
    
    if(mysqli_query($con, $sql)){
        http_response_code(201);
        $car = [
            'model' =>model,
            'price' =>price,
            'id' => mysqli_insert_id($con)
            ];
        
        echo json_encode(['data' =>$car]);
        
    }
    else http_response_code(422);
}