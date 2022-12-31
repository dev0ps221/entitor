<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorChampsEntite extends EntitorObject{
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            print_r($data);
        }
    }
?>