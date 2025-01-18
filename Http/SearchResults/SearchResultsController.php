<?php

class SearchResultsController extends SearchResults {

    private $polling_unit_id;

    public function __construct($polling_unit_id) {
        $this->polling_unit_id = $this->sanitize_id($polling_unit_id);
    }

    public function SearchResults() {
        if (!$this->polling_unit_id) {
            return [
                "message" => "Please enter a valid ID",
                "status" => "error"
            ];
        }


        $results = $this->getResultsByPollingUnit($this->polling_unit_id);

        if (empty($results)) {
            return [
                "message" => "No results found for this polling unit",
                "status" => "error"
            ];
        }

        return $results;
    }

    private function sanitize_id($id) {
        return filter_var($id, FILTER_VALIDATE_INT) ?: false;
    }
}
