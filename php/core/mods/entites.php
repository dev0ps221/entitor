<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorEntites extends EntitorModule{
        function createNew($titre){
            return $this->db->request('insert_into_entites',['titre'=>$titre]);
        }
        function __construct($name,$conn){
            parent::__construct($name,$conn);
        }
    }
?>