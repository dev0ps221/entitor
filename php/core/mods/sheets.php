<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorSheets extends EntitorModule{
        private $sheets;
        function __newSheet($entite){
            $sheetclass = $this->entitor->getobj('sheet');
            $data = $entite->retrieveData();
            $sheet = new $sheetclass($this,$data,$entite);
            return $this->__addsheet(
                $entite->get('titre'),
                $sheet
            );
        }
        function __addsheet($name,$sheet){
            $sheet->set('name',$name);
            $this->sheets[$name] = $sheet;
            return $sheet;
        }
        
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>