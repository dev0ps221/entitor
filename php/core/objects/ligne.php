<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorLigne extends EntitorObject{
        private $champs = null;

        function addentree(){
            foreach($this->getchamps() as $champs){
                $titrechamps = $champs->get('titre');
                $typechamps = $champs->get('titre');
                $ligne = $this->get('id');
                $valeur = "";
                $this->entrees->createNew($valeur,$titrechamps,$ligne,$type);
            }
            return $this->getentree();  
        }
        function delentree($valeur,$type){
            return $this->manager->delete($valeur,$this->get('id'));
        }
        function getentree(){
            $entree = [];
            return $this->entrees->selectAll($this->get('id'));
        }
        function getchamps(){
            return $this->entite->getchamps();
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->manager = $manager;
            $this->champs = $manager->entitor->getmod('champs_entites');
            $this->entrees = $manager->entitor->getmod('entrees_champs');
            $this->entite = $manager->entitor->getmod('entites')->select($this->get('entite'));
        }
    }
?>