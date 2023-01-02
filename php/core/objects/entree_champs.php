<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntreeChamps extends EntitorObject{
        
        function updateval($value){
            echo $this->manager->updateval($this->get('id'),$value);
            
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
        }
    }
?>