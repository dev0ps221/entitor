<?php
    class EntitorObject{
        private $dataset = [];
        
        function assignData(){
            foreach($this->data as $key=>$value){
                $this->set($key,$value);
            }
        }

        function set($name,$value){
            $this->dataset[$name] = $value;
        }

        function get($name){
            return array_key_exists($name,$this->dataset);
        }

        function __construct($manager,$data){
            $this->manager = $manager;
            $this->data = $data;
        }
    }

?>