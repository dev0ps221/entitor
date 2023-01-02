<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntreeChamps extends EntitorObject{
        function update($fields=[]){
            foreach ($fields as $key => $field) {
                $value = $fields[$field];
                $this->manager->updatefield($this->get('id'),$field,$value);
                echo $udpdatefunc; 
            }
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
        }
    }
?>