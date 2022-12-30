<?php

    class EntitorDatabaseSettings{

        private $tablestructure = [
            [
                'entites'
                ,[
                    ['name'=>'id','type'=>'int','extra'=>'auto_increment','null'=>null,'default'=>null,'keys'=>'primary key'],
                    ['name'=>'titre','type'=>'text','extra'=>null,'null'=>null,'default'=>null,'keys'=>null],
                ]
            ],
            [
                'champs_entites'
                ,[
                    ['name'=>'id','type'=>'int','extra'=>'auto_increment','null'=>null,'default'=>null,'keys'=>'primary key'],
                    ['name'=>'titre','type'=>'text','extra'=>null,'null'=>null,'default'=>null,'keys'=>null],
                    ['name'=>'entite','type'=>'int','extra'=>null,'null'=>null,'default'=>null,'keys'=>null],
                    ['name'=>'type','type'=>'text','extra'=>null,'null'=>null,'default'=>null,'keys'=>null]
                ]
            ],
            [
                'entree_champs_entites'
                ,[
                    ['name'=>'id','type'=>'int','extra'=>'auto_increment','null'=>null,'default'=>null,'keys'=>'primary key'],
                    ['name'=>'valeur','type'=>'text','extra'=>null,'null'=>null,'default'=>null,'keys'=>null],
                    ['name'=>'champs','type'=>'int','extra'=>null,'null'=>null,'default'=>null,'keys'=>null],
                    ['name'=>'type','type'=>'text','extra'=>null,'null'=>null,'default'=>null,'keys'=>null]
                ]
            ]
        ];
        function gettablestructure(){
            return $this->tablestructure;
        }
    }
    class EntitorDatabase{

        private $settings ;

        function request($action,...$args){
            return $this->dbconnection[$action](...$args)
        }

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
            return $this->dbconnection->query($this->createTableReq($name,$fields),null);
        }

        function checkTables(){
            foreach($this->settings->gettablestructure() as $table){
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
            $this->settings = new EntitorDatabaseSettings();
            $this->dbstuff();
        }
    }

?>