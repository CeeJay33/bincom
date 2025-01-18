<?php

include_once "../DatabaseConn/config.php";


class SearchResults extends DatabaseConn {
    public function getResultsByPollingUnit($polling_unit_id) {
        try {
            $stmt = $this->connect()->prepare("
                SELECT 
                    announced_pu_results.party_score, 
                    announced_pu_results.party_abbreviation, 
                    announced_pu_results.date_entered, 
                    polling_unit.polling_unit_name 
                FROM announced_pu_results 
                INNER JOIN polling_unit 
                ON announced_pu_results.polling_unit_uniqueid = polling_unit.uniqueid
                WHERE polling_unit.uniqueid = :polling_id
            ");

            $stmt->bindParam(":polling_id", $polling_unit_id);
            $stmt->execute();

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return json_encode($results);

        } catch (PDOException $e) {
            return [
                "message" => "Database error: " . $e->getMessage(),
                "status" => "error"
            ];
        }
    }
}
