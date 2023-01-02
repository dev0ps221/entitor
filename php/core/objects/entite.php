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
        function renamechamps($titre){
            return $this->champs->updatefield($this->get('id'),'titre',$titre);
        }
        function updatetypechamps($titre){
            return $this->champs->updatefield($this->get('id'),'titre',$titre);
        }
        function getlignes(){
            return $this->lignes->getfeed($this->get('id'));
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->lignes = $manager->entitor->getmod('lignes');
            $this->champs = $manager->entitor->getmod('champs_entites');
        }
    }
?>