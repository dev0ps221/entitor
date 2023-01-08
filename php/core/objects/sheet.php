<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorSheet extends EntitorObject{
        
        function setup(){
            $this->learnDimensions();
        }
        function learnDimensions(){
            $height = $this->entite->countlignes();
            echo $height;
        }
        function __construct($manager,$data,$entite){
            parent::__construct($manager,$data);
            $this->sheets = $manager;
            $this->entite = $entite;
        }
    }
?>