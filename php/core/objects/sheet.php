<?php
    include_once(dirname(__FILE__)."/objskel.php");
    include_once(dirname(__FILE__)."/../phpoffice/phpexcel/Classes/PHPExcel.php");
    class EntitorSheet extends EntitorObject{
        private $width = 0;
        private $height = 0;
        private $map = [];
        function setup(){
            $this->learnDimensions();
            $this->setMap();
            $this->fillMap($this->entite);
            // echo "<pre>";
            // print_r($this->map);
            // echo "</pre>";
        }
        function mapToFile($filename){
            $tempfile = 'xlstmp_'.time().".xlsx";
            $f = fopen($tempfile,'w');
            fclose($f);
            $reader = PHPExcel_IOFactory::createReader('Excel2007');
            $phpExcel = $reader->load("./$tempfile");
            // Get the first sheet
            
            $sheet = $phpExcel->createSheet();
            $sheet = $phpExcel->getActiveSheet();
            
            $sheet->setTitle($this->get('titre'));
            $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            
            foreach($this->map as $ligne){
                foreach($ligne as $column){
                    if(count($column)){
                        $column['coords'];
                        $column['coords'];
                        $sheet->setCellValue($column['coords'],$column['valeur']);
                    }
                }
                
            }
            $writer->save("./$tempfile");
            rename($tempfile,$filename);
        
        }
        function setMap(){
            $x = 0;
            $y = 0;
            while($y < $this->height){
               $this->map[$y] = [];
               while($x < $this->width){
                $this->map[$y][$x] = [];
                $x++;
               }
               $x = 0;
               $y++; 
            }
        }
        function fillMap($entite){
            $x = 0;
            $y = 0;
            $lignes = $entite->getlignes();
            $champs = $entite->getchamps();
            $this->setAt($y,$x,'ligne', $y);    
            $this->setAt($y,$x,'colonne', $x);        
            $this->setAt($y,$x,'coords', chr(ord('a')+($x))."".($y+1));    
            $this->setAt($y,$x,'valeur', $this->entite->get('titre'));
            $y++;
            foreach($champs as $champs){
                $this->setAt($y,$x,'ligne', $y);    
                $this->setAt($y,$x,'colonne', $x);        
                $this->setAt($y,$x,'coords', chr(ord('a')+($x))."".($y+1));    
                $this->setAt($y,$x,'valeur', $champs->get('titre'));   
                $x++;
            }
            $y++;
            foreach($lignes as $ligne){
                $entrees = $ligne->getentree();
                foreach($entrees as $entree){
                    if($entree->get('type') == 'entree'){
                        $entreesentree = $this->manager->entitor->getmod('lignes')->select($entree->get('valeur'))->getentree();
                        $champsentree = $this->manager->entitor->getmod('lignes')->select($entree->get('valeur'))->getchamps();
                        $this->setAt($y,$x,'ligne', $y);    
                        $this->setAt($y,$x,'colonne', $x);        
                        $this->setAt($y,$x,'coords', chr(ord('a')+($x))."".($y+1));    
                        $this->setAt($y,$x,'valeur', $entree->get('titre'));
                        $y++;
                        foreach($champsentree as $champs){
                            $this->setAt($y,$x,'ligne', $y);    
                            $this->setAt($y,$x,'colonne', $x);        
                            $this->setAt($y,$x,'coords', chr(ord('a')+($x))."".($y+1));    
                            $this->setAt($y,$x,'valeur', $champs->get('titre'));   
                            $x++;
                        }
                        $y++;
                        foreach($entreesentree as $entree){
                            $this->setAt($y,$x,'ligne', $y);    
                            $this->setAt($y,$x,'colonne', $x);    
                            $this->setAt($y,$x,'coords', chr(ord('a')+($x))."".($y+1));    
                            $this->setAt($y,$x,'valeur', $entree->get('valeur'));    
                            $x++;
                        } 
                    }else{
                        $this->setAt($y,$x,'ligne', $y);    
                        $this->setAt($y,$x,'colonne', $x);
                        $this->setAt($y,$x,'coords', chr(ord('a')+($x))."".($y+1));
                        $this->setAt($y,$x,'valeur', $entree->get('valeur'));
                        $x++;
                    }
                }
                $x = 0;
                $y++;
            }
        }
        function getAt($ligne,$colonne){
            return $this->map[$ligne][$colonne];
        }
        function setAt($ligne,$colonne,$champs,$valeur){
            $this->map[$ligne][$colonne][$champs] = $valeur;    
        }
        function countlignes(){
            return count($this->entite->getlignes());
        }
        function countcolonnes($entite=null){
            if($entite == null){
                $entite = $this->entite;
            }
            $fields =$entite->getchamps();
            $count = count($fields);
            foreach($fields as $field){
                if($field->get('type') == 'tableau'){
                    $count--;
                    $count+=$this->countcolonnes($field->reftable);
                }
            }
            return $count;
        }
        function learnDimensions(){
            $this->learnHeight();
            $this->width = $this->countcolonnes();
        }
        function learnHeight(){
            $this->height = $this->countlignes()+2; 
            $fields = $this->entite->getchamps();
            foreach($fields as $field){
                if($field->get('type') == 'tableau'){
                    $this->height +=2;
                }
            } 
        }
        function __construct($manager,$data,$entite){
            parent::__construct($manager,$data);
            $this->sheets = $manager;
            $this->entite = $entite;
        }
    }
?>