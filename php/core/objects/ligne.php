<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorLigne extends EntitorObject{
        private $champs = null;

        function addentree($valeur,$type){
            $id = $this->manager->createNew($valeur,$this->get('id'),$type);
            return $this->getentree();  
        }
        function delentree($valeur,$type){
            return $this->manager->delete($valeur,$this->get('id'));
        }
        function getentree(){
            $entree = [];
            return $this->entrees->selectAll($this->get('id'));
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->manager = $manager;
            $this->champs = $manager->entitor->getmod('champs_entites');
            $this->entrees = $manager->entitor->getmod('entrees_champs');
        }
    }
?>