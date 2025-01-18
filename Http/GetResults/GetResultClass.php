<?php

include_once "../DatabaseConn/config.php";

class GetResults extends DatabaseConn {
    
    public function GetResults() {
        $stmt = $this->connect()->prepare("
            SELECT announced_pu_results.party_score, announced_pu_results.party_abbreviation, announced_pu_results.date_entered, polling_unit.polling_unit_name, polling_unit.uniqueid 
            FROM announced_pu_results 
            INNER JOIN polling_unit 
            ON announced_pu_results.polling_unit_uniqueid = polling_unit.uniqueid
            WHERE polling_unit.uniqueid = 8;
        ");

        if ($stmt->execute()) {
            $result =  $stmt->fetchAll(PDO::FETCH_ASSOC); 

            return json_encode($result);
        } else {
            return ["error" => "Failed to fetch results"];
        }
    }

}
