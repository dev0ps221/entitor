<?php
    include_once(dirname(__FILE__)."/entitordatabase.php");
    include_once(dirname(__FILE__)."/entitormodules.php");
    include_once(dirname(__FILE__)."/entitorobjects.php");
    class Entitor{
        private $modules = null;
        private $objects = null;
        private $herepath=null;
        private $dbconnection=null;
        private $modulespath=null;
        private $objectspath=null;
        function getmod($name){
            return $this->mods()->getmod($name);
        }
        function getmods(){
            return $this->mods()->getmods();
        }
        function mods(){
            return $this->modules;
        }
        function getobjs(){
            return $this->objs()->getobjs();
        }
        function getobj($name){
            return $this->objs()->getobj($name);
        }
        function objs(){
            return $this->objects;
        }
        function getconnection(){
            return $this->dbconnection;
        }
        function dbstuff(){
            $this->dbconnection = new EntitorDatabase($this->dbcreds);
        }
        function getmodulespath(){
            return $this->modulespath;
        }
        function getobjectspath(){
            return $this->objectspath;
        }
        function __construct($databasecreds){
            $this->dbcreds = $databasecreds;
            $this->herepath = dirname(__FILE__);
            $this->modulespath = "$this->herepath/mods";
            $this->objectspath = "$this->herepath/objects";
            $this->dbstuff();
            $this->modules = new EntitorModules($this);
            $this->objects = new EntitorObjects($this);
        }
        

    }


?>