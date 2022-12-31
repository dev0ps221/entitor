<?php
    class EntitorModule{

        
        function __construct($entitor,$name,$connection){
            $this->entitor = $entitor;
            $this->name = $name;
            $this->db = $connection;
        }
    }

?>