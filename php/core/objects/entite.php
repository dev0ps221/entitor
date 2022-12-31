<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntite extends EntitorObject{
        private $champs = null;
        function addligne($data){
            return $this->lignes->createNew($this->get('id'));
        }
        function addchamps($titre,$type){
            return $this->champs->createNew($titre,$this->get('id'),$type);
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->lignes = $manager->entitor->getmod('entrees_lignes');
            $this->champs = $manager->entitor->getmod('champs_entites');
        }
    }
?>