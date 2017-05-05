<?php

defined('IS_DEVELOPMENT') OR exit('No direct script access allowed');

$swrve_user_id = isset($params[1]) ? $params[1] : "";

if (trim($swrve_user_id) == "") {
    return array(
        "status" => FALSE,
        "message" => "Error: swrve_user_id is empty"
    );
}

include("config.php");
$connection = new PDO(
    "mysql:dbname=$mydatabase;host=$myhost;port=$myport",
    $myuser, $mypass, array(PDO::ATTR_PERSISTENT => true)
);
    
// reset referrer
$sql2 = "UPDATE $table_name "
        . "SET referrer = '' "
        . "WHERE referrer = :referrer ";
$statement2 = $connection->prepare($sql2);
$statement2->bindParam(":referrer", $swrve_user_id);
$statement2->execute();

return array(
    'affected_row' => $statement2->rowCount(),
    'error' => 0,
    'message' => 'Success'
);


