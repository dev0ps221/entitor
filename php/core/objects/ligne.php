<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorLigne extends EntitorObject{
        private $champs = null;
        
        function makerender($canedit,$idx){
            $entrees = [];
            foreach($this->getentree() as $i=>$entree){
                array_push($entrees,$entree->makerender($canedit));
            }
            return "
            <div id='ligne".$this->get("id")."' class='ligne' style='--columns:repeat(".count($this->getchamps()).",1fr)'>
                ".
                implode('',$entrees)  
                ."
            </div>
            ";
        }
        function addentree(){
            $processline = function ($ref,$processline){ 
                foreach($ref->getchamps() as $champs){
                    $idchamps = $champs->get('id');
                    $typechamps = $champs->get('type');
                    $ligne = $ref->get('id');
                    $valeur = "";
                    if($typechamps == 'texte'){
                        $ref->entrees->createNew($valeur,$idchamps,$ligne,$typechamps);
                    }
                    if($typechamps == 'tableau'){
                        $newligne = $this->manager->entitor->getmod('entites')->select($champs->get('reftable'))->addligne();
                        $processline($newligne,$processline);
                        $ref->entrees->createNew($newligne->get('id'),$idchamps,$ligne,'entree');
                    }
                }
            };
            $processline($this,$processline);
            return $this->getentree();  
        }
        function editentree($champs,$valeur){
            $entree = $this->entrees->select($champs);
            return $entree->updateval($valeur);
        }
        function delentree($valeur,$type){
            return $this->manager->delete($valeur,$this->get('id'));
        }
        function getentree(){
            $entree = [];
            return $this->entrees->getfeed($this->get('id'));
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
            $this->entite->set('id',$this->get('entite'));
        }
    }
?>