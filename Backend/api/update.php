<?php
require 'connect.php';

// Get the posted data.

$postdata = file_get_contents("php/input");

if(isset($postdata) && !empty($postdata)){
    // extract the data
    $request = json_decode($postdata);
    
    //validate
    if((int)$request->data->id < 1|| trim($request->data->model) == ''){
        return http_response_code(400);
    }
    
    // sanitize
    
    $id = mysqli_real_escape_string($con, $trim($request->data->id));
    $model = mysqli_real_escape_string($con, $trim($request->data->model));
    $price = mysqli_real_escape_string($con, $trim($request->data->price));
    
    // store
    $sql = "update `cars` set `model` = '$model', `price` = '$price' where `id` = '{$id}'";
    
    if(mysqli_query($con, $sql)){
        http_response_code(204);
        
    }
    else http_response_code(422);
}