<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorSheets extends EntitorModule{
        
        function __setentites(){
            $this->entites = $this->entitor->getmod('entites');
        }
        
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>