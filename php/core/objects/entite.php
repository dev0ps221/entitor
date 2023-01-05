<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntite extends EntitorObject{
        private $champs = null;
        function addligne(){
            $ligne = $this->lignes->createNew($this->get('id'));
            $ligne->addentree();
            return $ligne;
        }
        function makerender($canedit=true,$buildedit=null){
            $lignes = [];
            foreach($this->getlignes() as $idx=>$ligne){
                array_push($lignes,$ligne->makerender($canedit,$idx));
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
                            global $buildedit;
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
        function addchamps($titre,$type,$reftable=null,$volet=null){
            if($type == 'tableau'){
                $reftable = $reftable!=null ? ($this->manager->entitor->getmod('entites')->clone($reftable,$titre,$volet))->get('id') : 'null';
                if($reftable == 'null'){
                    $type = 'texte';
                }
                if($type == 'tableau'){
                    if(count($this->getlignes())){
                        $table = $this->manager->entitor->getmod('entites')->select($reftable); 
                        foreach($this->getlignes() as $i=>$ligne){
                            $table->addligne();
                        }
                    }
                }
            }
            $id = $this->champs->createNew($titre,$this->get('id'),$type,$reftable);
            if($type == 'texte'){
                if(count($this->getlignes())){
                    $entrees = $this->manager->entitor->getmod('entrees_champs');
                    foreach($this->getlignes() as $i=>$ligne){
                        $entrees->createNew('',$id,$ligne->get('id'),'text');
                    }
                }
            }
            return $id;
        }
        function renamechamps($titre){
            return $this->champs->updatefield($this->get('id'),'titre',$titre);
        }
        function updatetypechamps($type){
            return $this->champs->updatefield($this->get('id'),'type',$type );
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