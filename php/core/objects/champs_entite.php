<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorChampsEntite extends EntitorObject{
        function addentree($valeur,$type){
            return $this->entrees->createNew($valeur,$this->get('id'),$type);
        }
        function rename(){
            
        }
        function makerender(){
            return "
            <div id='champs".$this->get("id")."' class='colonne'>
                ".$this->get('titre')."
            </div>
            ";
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->entrees = $manager->entitor->getmod('entrees_champs');
        }
    }
?>