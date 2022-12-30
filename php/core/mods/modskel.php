<?php
    class EntitorModule{

        
        function __construct($name,$connection){
            $this->name = $name;
            $this->db = $connection;
        }
    }

?>