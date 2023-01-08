<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorSheet extends EntitorObject{
        private $width = 0;
        private $height = 0;
        private $map = [];
        function setup(){
            $this->learnDimensions();
            $this->setMap();
            echo "<pre>";
                print_r($this->map);
            echo "<pre>";
        }
        function setMap(){
            $x = 0;
            $y = 0;
            while($y < $this->height){
               $this->map[$y] = [];
               while($x < $this->width){
                $this->map[$y][$x] = [];
                $x++;
               }
               $x = 0;
               $y++; 
            }
        }
        function countlignes(){
            return count($this->entite->getlignes());
        }
        function countcolonnes($entite=null){
            if($entite == null){
                $entite = $this->entite;
            }
            $fields =$entite->getchamps();
            $count = count($fields);
            foreach($fields as $field){
                if($field->get('type') == 'tableau'){
                    $count--;
                    $count+=$this->countcolonnes($field->reftable);
                }
            }
            return $count;
        }
        function learnDimensions(){
            $this->height = $this->countlignes();
            $this->width = $this->countcolonnes();
        }
        function __construct($manager,$data,$entite){
            parent::__construct($manager,$data);
            $this->sheets = $manager;
            $this->entite = $entite;
        }
    }
?>