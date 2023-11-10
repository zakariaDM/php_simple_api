<?php

header('Content-Type: application/json'); // Mon WS va Exposer du JSON
//modifie pour essai de git/gitlab
if (strtoupper($_SERVER['REQUEST_METHOD']) != 'GET') { // N'accepter que le verbe POST
    http_response_code(405);
    echo json_encode(array("error" => "Mothod  not allowed")); // Encoder un PHP Array en format JSON pour l'afficher
    die();
}

//  $body = file_get_contents("php://input");
//  $object = json_decode($body, true);

// Throw an exception if decoding failed
//if (!is_array($object)) {
//    throw new Exception('Failed to decode JSON object');
//}

$user = $_GET["username"];
$name = $_GET["name"];

try {
    $servername = "localhost:3306";
    $username = "root";
    $password = "test";
    $conn = new PDO("mysql:host=$servername;dbname=ifiag", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO users (name, username) VALUES ( '" . $name . "', '" . $user . "')";

    $conn->exec($sql);
    http_response_code(201);
    echo json_encode(array(
        "success" => "The user is successfully added into database"
    ));
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array(
        "error" => $e->getMessage()
    ));
}

