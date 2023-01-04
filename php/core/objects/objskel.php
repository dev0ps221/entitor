<?php
    class EntitorObject{
        private $dataset = [];
        
        function assignData(){
            foreach($this->data as $key=>$value){
                $this->set($key,$value);
            }
        }

        function retrieveData(){
            return $this->dataset;
        }

        function set($name,$value=null){
            $this->dataset[$name] = $value;
        }

        function get($name=null){
            return array_key_exists($name,$this->retrieveData()) ? $this->dataset[$name] : null;
        }

        function __construct($manager,$data){
            $this->manager = $manager;
            $this->data = $data;
            $this->assignData();
        }
    }

?>