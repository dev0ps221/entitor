<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntite extends EntitorObject{
        private $champs = null;
        function addentite($titre){
            return  $this->entites->createNew($titre,$this->get('id'));
            
        }
        function makerender($canedit=true,$buildedit=null){
            $entites = [];
            foreach($this->getentites() as $entite){
                array_push($entites,$entite->makerender($canedit));
            };
            return "";
        }
        function getentites(){
            return $this->entites->getfeed($this->get('id'));
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->entites = $manager->entitor->getmod('entites');
        }
    }
?>