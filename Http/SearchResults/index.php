<?php
include_once "SearchResultsClasses.php";
include_once "SearchResultsController.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data = json_decode(file_get_contents('php://input'), true);

    $polling_unit_id = $data["polling_unit_id"];

    $SearchResults = new SearchResultsController($polling_unit_id);

    $results = $SearchResults->SearchResults();

    echo $results;
} else {
    echo json_encode(["message" => "Invalid Request", "status" => "error"]);
    http_response_code(400);
}
