<?php

// my route

include_once "GetSummedResultClass.php";

header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (!isset($_GET["lga_id"]) || !is_numeric($_GET["lga_id"])) {
        echo json_encode(["message" => "Invalid LGA ID", "status" => "error"]);
        http_response_code(400);
        exit;
    }

    $lga_id = intval($_GET["lga_id"]); 
    $GetResults = new GetSumResults();
    $results = $GetResults->fetchSumResults($lga_id);

    echo $results;
} else {
    http_response_code(405);
    echo json_encode(["message" => "Method Not Allowed", "status" => "error"]);
}
