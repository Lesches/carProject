<?php
require 'connect.php';

// extract, validate and sanitize the id.

$id = ($_GET['id'] !== null && (int)$_GET['id'] > 0)? mysqli_real_escape_string($con, (int)$_GET['id']): false;

if(!$id){
   
   return http_response_code(400);
}
    
    //delete
   $sql = "delete from `cars` where `id` = '{$id}' limit 1";
    
    if(mysqli_query($con, $sql)){
        http_response_code(204);
        
    }
    else http_response_code(422);