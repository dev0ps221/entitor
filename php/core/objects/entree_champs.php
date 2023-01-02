<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntreeChamps extends EntitorObject{
        
        function updateval($value){
            return $this->manager->updateval($this->get('id'),$value);
            
        }
        function makerender(){
            return "
            <div id='entree_champs_".$this->get("id")."' class='colonne'>
                ".$this->get('valeur')."
            </div>
            ";
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
        }
    }
?>