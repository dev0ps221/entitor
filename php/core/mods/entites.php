<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorEntites extends EntitorModule{
        function createEntite($titre){
            $this->db->insert_into_entites(['titre'=>$titre]);
        }
        function __construct($conn){
            parent::__construct($conn);
        }
    }
?>