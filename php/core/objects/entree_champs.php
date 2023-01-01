<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntreeChamps extends EntitorObject{
        function update($fields=[]){
            foreach ($fields as $key => $field) {
                $value = $fields[$field];
                $udpdatefunc = "update_entrees_champs_entites_$field";
                echo $udpdatefunc; 
            }
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
        }
    }
?>