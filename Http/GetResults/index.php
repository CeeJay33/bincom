<?php

// my route

include_once "GetResultClass.php";


if($_SERVER["REQUEST_METHOD"] === "GET"){

   $GetResults = new GetResults();
   $results = $GetResults->GetResults();

echo ($results);

}else{
    echo json_encode(["message"=> "Invalid Request", "status"=> "error"]);
    http_response_code(400);
}