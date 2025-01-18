<?php

class DatabaseConn {
    
    protected function connect() {
        try {
            $username = "josh";
            $password = "Warmpad";
            $dbh = new PDO('mysql:host=localhost;dbname=bincom', $username, $password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $dbh;
        } catch (PDOException $e) {
            print "Error: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}

?>
