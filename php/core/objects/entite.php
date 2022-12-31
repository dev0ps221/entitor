<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntite extends EntitorObject{
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            // print_r($this->data);
        }
    }
?>