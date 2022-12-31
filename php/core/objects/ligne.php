<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorLigne extends EntitorObject{
        private $champs = null;
        
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            $this->champs = $manager->entitor->getmod('champs_entites');
        }
    }
?>