<?php

include_once "../DatabaseConn/config.php";

class GetSumResults extends DatabaseConn {
    
    public function fetchSumResults($lga_id) {  
        try {
            $stmt = $this->connect()->prepare("
                SELECT 
                    lga.lga_name,
                    ar.party_abbreviation,
                    SUM(ar.party_score) AS total_score
                FROM 
                    announced_pu_results ar
                JOIN 
                    polling_unit pu ON ar.polling_unit_uniqueid = pu.uniqueid
                JOIN 
                    lga ON pu.lga_id = lga.lga_id
                WHERE 
                    lga.lga_id = :lga_id
                GROUP BY 
                    lga.lga_name, ar.party_abbreviation
                ORDER BY 
                    total_score DESC
            ");

            $stmt->bindParam(":lga_id", $lga_id, PDO::PARAM_INT); 

            if ($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
                return json_encode($result);
            } else {
                return json_encode(["error" => "Failed to fetch results"]);
            }
        } catch (PDOException $e) {
            return json_encode(["error" => "SQL Error: " . $e->getMessage()]);
        }
    }
}
