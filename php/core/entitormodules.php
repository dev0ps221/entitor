<?php
    class EntitorModules{
        private $excludenames = ['modskel','.','..'];
        private $modules = [];
        private $modulespath=null;
        function moduleClassName($filename){
            return "Entitor".join(
                '',array_map(function ($elem){
                    return ucfirst($elem);
                },explode('_',$filename))
            );
            
        }
        function walkmodules(){
            $modsrep = [];
            foreach(scandir($this->modulespath) as $filename){
                $filepath = $this->modulespath."/".$filename;
                $filename = basename(basename($filepath),'.php');
                $className=$this->moduleClassName($filename);
                if(!in_array($filename,$this->excludenames)){
                    include_once($filepath);
                    if(class_exists($className)){
                        array_push($modsrep,[$filename,$className]);
                    }
                }
            }
            return $modsrep;
        }
        function loadmodules(){
            $mods = $this->walkmodules();
            foreach ($mods as $key => $mod) {
                $this->loadmodule($mod[0],$mod[1]);
            }
        }
        function loadmodule($name,$ModuleClass){
            $this->modules[$name] = new $ModuleClass($this->entitor,$name,$this->entitor->getconnection());
        }
        function mod_exists($name){
            return array_key_exists($name,$this->modules);
        }
        function getmod($name){
            return $this->mod_exists($name) ? $this->modules[$name] : null;
        }
        function getmods(){
            return $this->modules;
        }
        function __construct($entitor){
            $this->entitor = $entitor;
            $this->modulespath = $this->entitor->getmodulespath();
            $this->loadmodules();
        }
    }
?>