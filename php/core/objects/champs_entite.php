<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorChampsEntite extends EntitorObject{
        function addentree($valeur,$type){
            return $this->entrees->createNew($valeur,$this->get('id'),$type);
        }
        function rename(){

        }
        function tablerender(){
            return " 

                <div id='champs".$this->get("id")."' class='colonne ".$this->get("type")."'>
                    ".$this->get('titre')."
                    <div class='ligne_labels ligne' style='--columns:repeat(".count($this->champs).",1fr)'>
                        ".
                        implode('',array_map(
                            function($champs){
                                global $buildedit;
                                return $champs->makerender($buildedit);
                            },$this->champs
                        ))  
                        ."
                    </div>
                </div>
            ";
        }
        function makerender(){
            return $this->get("type") == 'tableau' ? $this->tablerender() :  "
                <div id='champs".$this->get("id")."' class='colonne ".$this->get("type")."'>
                    ".$this->get('titre')."
                </div>
            ";
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->entrees = $manager->entitor->getmod('entrees_champs');
            if($this->get('type') == 'tableau'){
                $this->reftable = $this->manager->entitor->getmod('entites')->select($this->get('reftable'));
                $this->champs = $this->reftable->getchamps();
            }
        }
    }
?>