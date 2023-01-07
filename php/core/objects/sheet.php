<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorSheet extends EntitorObject{
        
        function setup(){
            $this->learnDimensions();
        }
        function learnDimensions(){
            
        }
        function __construct($manager,$data,$entite){
            parent::__construct($manager,$data);
            $this->sheets = $manager->entitor->getmod('sheets');
            $this->entite = $entite;
            $this->setup();
        }
    }
?>