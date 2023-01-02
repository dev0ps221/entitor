<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorLigne extends EntitorObject{
        private $champs = null;

        function addentree(){
            foreach($this->getchamps() as $champs){
                $idchamps = $champs->get('id');
                $typechamps = $champs->get('type');
                $ligne = $this->get('id');
                $valeur = "";
                $this->entrees->createNew($valeur,$idchamps,$ligne,$typechamps);
            }
            return $this->getentree();  
        }
        function editentree($champs,$valeur){
            $entree = $this->champs->select($champs);
            return $entree->updateval($valeur);
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