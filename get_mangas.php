<?php
header('Content-Type: application/json'); // Mon WS va Exposer du JSON
//modifie pour essai de git/gitlab
if (strtoupper($_SERVER['REQUEST_METHOD']) != 'GET') { // N'accepter que le verbe POST
    http_response_code(405);
    echo json_encode(array("error" => "Mothod  not allowed")); // Encoder un PHP Array en format JSON pour l'afficher
    die();
}

try {
    http_response_code(200);
    echo file_get_contents("./data/mangas.json");
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(array(
        "error" => $e->getMessage()
    ));
}


