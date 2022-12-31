<?php
    class EntitorObjects{
        private $excludenames = ['objskel','.','..'];
        private $objects = [];
        private $objectspath=null;
        function objectClassName($filename){
            return "Entitor".join(
                '',array_map(function ($elem){
                    return ucfirst($elem);
                },explode('_',$filename))
            );
            
        }
        function walkobjects(){
            $objsrep = [];
            foreach(scandir($this->objectspath) as $filename){
                $filepath = $this->objectspath."/".$filename;
                $filename = basename(basename($filepath),'.php');
                $className=$this->objectClassName($filename);
                if(!in_array($filename,$this->excludenames)){
                    include_once($filepath);
                    if(class_exists($className)){
                        array_push($objsrep,[$filename,$className]);
                    }
                }
            }
            return $objsrep;
        }
        function loadobjects(){
            $objs = $this->walkobjects();
            foreach ($objs as $key => $obj) {
                $this->loadobject($obj[0],$obj[1]);
            }
        }
        function loadobject($name,$objectClass){
            $this->objects[$name] = $objectClass;
        }
        function obj_exists($name){
            return array_key_exists($name,$this->objects);
        }
        function getobj($name){
            return $this->obj_exists($name) ? $this->objects[$name] : null;
        }
        function getobjs(){
            return $this->objects;
        }
        function __construct($entitor){
            $this->entitor = $entitor;
            $this->objectspath = $this->entitor->getobjectspath();
            $this->loadobjects();
        }
    }
?>