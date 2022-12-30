<?php
    include_once(dirname(__FILE__)."/entitordatabase.php");
    include_once(dirname(__FILE__)."/entitormodules.php");
    class Entitor{
        private $modules = null;
        private $herepath=null;
        private $dbconnection=null;
        private $modulespath=null;
        function mods(){
            return $this->modules;
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
        function __construct($databasecreds){
            $this->dbcreds = $databasecreds;
            $this->herepath = dirname(__FILE__);
            $this->modulespath = "$this->herepath/mods";
            $this->dbstuff();
            $this->modules = new EntitorModules($this);
        }
        

    }


?>