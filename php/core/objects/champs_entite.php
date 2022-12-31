<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorChampsEntite extends EntitorObject{
        function addentree($valeur,$type){
            return $this->entrees->createNew($valeur,$this->get('id'),$type);
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->entrees = $manager->entitor->getmod('entrees_champs');
            $this->addentree('test'.$this->get('titre'),'texte');
            print_r($this->entrees->getfeed($this->get('id')));
        }
    }
?>