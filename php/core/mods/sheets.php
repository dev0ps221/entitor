<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorSheets extends EntitorObject{
        
        
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->entites = $this->manager->entitor->getmod('entites');
        }
    }
?>