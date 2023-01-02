<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntite extends EntitorObject{
        private $champs = null;
        function addligne(){
            $ligne = $this->lignes->createNew($this->get('id'));
            return $ligne->addentree();
        }
        function makerender(){
            return "
            <div id='tableau".$this->get("id")."'>
            
                <div class='ligne_labels'>
                    ".
                    implode('',array_map(
                        function($champs){
                            return $champs->makerender();
                        },$this->getchamps()
                    ))  
                    ."
                </div>
                    ".
                    implode('',array_map(
                        function($ligne){
                            return $ligne->makerender();
                        },$this->getlignes()
                    ))  
                    ."
            </div>
            ";
        }
        function addchamps($titre,$type){
            return $this->champs->createNew($titre,$this->get('id'),$type);
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