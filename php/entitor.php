<?php
    class EntitorDatabase{
        private $tablestructure = [
            ['entites',[['name'=>'id','type'=>'int','extra'=>'auto_increment','null'=>null,'default'=>null,'keys'=>'primary key']]],
            ['champs_entites',[['name'=>'id','type'=>'int','extra'=>'auto_increment','null'=>null,'default'=>null,'keys'=>'primary key']]]
        ];


        function createTableReq($name,$fields){
            $req = " CREATE TABLE $name (";
            foreach ($fields as $key => $field) {
                $fieldname = $field['name'];
                $fieldtype = $field['type'];
                $fieldextra = $field['extra'];
                $fieldnull = $field['null'];
                $fielddefault = $field['default'];
                $fieldkeys = $field['keys'];
                $req = "$req ".($key==0?'':',')."$fieldname $fieldtype ".($fieldnull?'':'not null')." $fieldextra ".(($fielddefault)?"default $fielddefault ":'')." $fieldkeys";
            }
            $req = "$req)";
            return $req;
        }

        function createTable($name,$fields){
            return $this->dbconnection->getconn()->query($this->createTableReq($name,$fields));
        }

        function checkTables(){
            foreach($this->tablestructure as $table){
                $name = $table[0];
                $fields = $table[1];
                if(!$this->dbconnection->gettabledata($name)){
                    
                    print_r($fields);
                    $this->createTable($name,$fields);
                }
            }
        }

        function dbstuff(){
            include("$this->herepath/crud/crudconnection.php");
            $this->dbconnection = new CrudConnection();
            $this->dbconnection->__connect();
            $this->checkTables();
            return $this->dbconnection;
        }

        function __construct($databasecreds){
            $this->dbcreds = $databasecreds;
            $this->herepath = dirname(__FILE__);
            $this->dbstuff();
        }
    }
    class Entitor{
        private $modules = [];
        private $herepath=null;
        private $dbconnection=null;
        private $modulespath=null;
        function dbstuff(){
            $this->dbconnection = new EntitorDatabase($this->dbcreds);
        }
        function __construct($databasecreds){
            $this->dbcreds = $databasecreds;
            $this->herepath = dirname(__FILE__);
            $this->modulespath = "$this->herepath/mods";
            $this->dbstuff();
            echo json_encode($this->dbconnection);
        }
        

    }


?>