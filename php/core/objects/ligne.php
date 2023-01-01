<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorLigne extends EntitorObject{
        private $champs = null;

        function addentree($valeur,$type){
            return $this->entrees->createNew($valeur,$this->get('id'),$type);
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->champs = $manager->entitor->getmod('champs_entites');
            $this->entrees = $manager->entitor->getmod('entrees_lignes');
        }
    }
?>