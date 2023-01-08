<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorSheet extends EntitorObject{
        private $width;
        private $height;
        function setup(){
            $this->learnDimensions();
            
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
        
            echo $width
            ."<br>";
            
            echo $height;
        }
        function __construct($manager,$data,$entite){
            parent::__construct($manager,$data);
            $this->sheets = $manager;
            $this->entite = $entite;
        }
    }
?>