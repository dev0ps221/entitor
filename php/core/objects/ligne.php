<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorLigne extends EntitorObject{
        private $champs = null;

        function addentree($valeur,$type){
            return $this->manager->createNew($valeur,$this->get('id'),$type);
        }
        function delentree($valeur,$type){
            return $this->manager->delete($valeur,$this->get('id'));
        }
        function getentree(){
            $entree = [];
            foreach($this->entrees->selectAll($this->get('entree')) as $champs){
                // $this->champs->get
            }
            
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