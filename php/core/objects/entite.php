<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntite extends EntitorObject{
        private $champs = null;
        function addligne(){
            $ligne = $this->lignes->createNew($this->get('id'));
            return $ligne->addentree();
        }
        function makerender($canedit=true,$buildedit=null){
            $lignes = [];
            foreach($this->getlignes() as $ligne){
                array_push($lignes,$ligne->makerender($canedit));
            };
            return "
            <div id='tableau".$this->get("id")."' class='table'>
            
                <div class='ligne' style='--columns:1fr;'>
                    <div class='colonne'>
                        ".
                            $this->get('titre')
                        ."
                    </div>
                </div>
                <div class='ligne_labels ligne' style='--columns:repeat(".count($this->getchamps()).",1fr)'>
                    ".
                    implode('',array_map(
                        function($champs){
                            return $champs->makerender($buildedit);
                        },$this->getchamps()
                    ))  
                    ."
                </div>
                    ".
                    implode('',$lignes)  
                    ."
            </div>
            ";
        }
        function addchamps($titre,$type,$reftable=null){
            if($reftable){
                
            }else{
                return $this->champs->createNew($titre,$this->get('id'),$type,$reftable);
            }
        }
        function renamechamps($titre){
            return $this->champs->updatefield($this->get('id'),'titre',$titre);
        }
        function updatetypechamps($titre){
            return $this->champs->updatefield($this->get('id'),'titre',$titre);
        }
        function getlignes(){
            return $this->lignes->getfeed($this->get('id'));
        }
        function getchamps(){
            return $this->champs->getfeed($this->get('id'));
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->lignes = $manager->entitor->getmod('lignes');
            $this->champs = $manager->entitor->getmod('champs_entites');
        }
    }
?>