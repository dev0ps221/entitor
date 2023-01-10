<?php
    include_once(dirname(__FILE__)."/objskel.php");
    include_once(dirname(__FILE__)."/../phpoffice/phpexcel/Classes/PHPExcel.php");
    class EntitorSheet extends EntitorObject{
        private $width = 0;
        private $height = 0;
        private $map = [];
        private $mergecoords = ['x'=>[],'y'=>[]];
        function getheight(){
            return $this->height;
        }
        function getwidth(){
            return $this->width;
        }
        function colonnename($x){
            $number  = $x; 
            $name = "";
            if($number >= 26){
                $turns   = 0;
                while ( $number >= 26){
                    $turns++;
                    $number = $number - 26;
                }
                $name = chr(ord("a")+$turns).chr(ord("a")+$number);
            }else{
                if($x>=26){
                    $xcount = intval(ceil($x ? 26/$x : $x));
                    $x = $x ? 26%$x : $x;
                    for($i = 0 ; $i < $xcount ; $i++){
                        $name = chr(ord("a")+$i);
                    }
                    $name = "$name".chr(ord("a")+$x);
                }else{
                    $name = chr(ord("a")+$x);
                }
            }
            return $name;
        }
        function setup(){
            $this->learnDimensions();
            $this->setMap();
            $this->fillMap($this->entite);
        }
        function areaBorder($sheet,$coords){
            $stle = array(
                'borders'=>array(
                    'allborders'=>array(
                        'style'=>PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            $sheetstyle = $sheet->getStyle($coords);
            $sheetstyle->ApplyFromArray($stle);
            unset($stle);
        }
        function mapToFile($filename,$starty=20){
            $filename = "exports/$filename";
            $f = fopen($filename,'a+');
            fclose($f);
            $reader = PHPExcel_IOFactory::createReader('Excel2007');
            
            $phpExcel = $reader->load("./$filename");
            // Get the first sheet
            
            $sheet = $phpExcel->getSheetByName($this->get('titre')) ? $phpExcel->getSheetByName($this->get('titre'))  : $phpExcel->createSheet();
            $sheet->setTitle($this->get('titre'));
            
            $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            
            foreach($this->map as $ligne){
                foreach($ligne as $column){
                    if(count($column)){
                        // $column['coords'][-1] = $column['coords'][-1]+$starty;
                        $column['coords'] = substr($column['coords'],-2,strlen($column)-1).($column['coords'][-1]+$starty);
                        $sheet->setCellValue($column['coords'],$column['valeur']);
                    }
                }
                
            }
            $firstx = 0;
            $firsty = $starty+1;
            $lastx  = $this->width-1;
            $lasty  = $starty+count($this->map);
            $coords = $this->colonnename($firstx).$firsty.":".$this->colonnename($lastx).$lasty;
            $writer->save("./$filename");

            $phpExcel = $reader->load("./$filename");
            // Get the first sheet
            $sheet = $phpExcel->getSheetByName($this->get('titre')) ? $phpExcel->getSheetByName($this->get('titre'))  : $phpExcel->createSheet();
            $writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");
            $this->areaBorder($sheet,$coords);
            $writer->save("./$filename");   
            
            // rename($tempfile,$filename);
        
        }
        function setMap(){
            $x = 0;
            $y = 0;
            while($y+1 < $this->height){
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
            $coords=$this->colonnename($x)."".($y+1);
            $this->setAt($y,$x,'coords', $coords);    
            $this->setAt($y,$x,'valeur', $this->entite->get('titre'));
            $y++;
            $process = function($champs,$x,$y,$self,$process){                      
                foreach($champs as $champs){
                    $self->setAt($y,$x,'ligne', $y);    
                    $self->setAt($y,$x,'colonne', $x);        
                    $coords=$self->colonnename($x)."".($y+1);
                    if($champs->get('type') == 'tableau'){
                        $self->setAt($y,$x,'coords', $coords);    
                        $self->setAt($y,$x,'valeur', $champs->get('titre'));
                        $self->setAt($y,$x,'horizontal_merge', $coords.":".( $this->colonnename($x+$champs->reftable->sheet->getheight()).$y+1 ));
                        $processed = $process($champs->champs,$x,$y+1,$self,$process);
                        $x = $processed[0];
                        $x--;
                    }else{
                        $self->setAt($y,$x,'vertical_merge',  $coords.":".$self->colonnename($x)."".($y+1+$this->manager->entitor->getmod('entites')->select($champs->get('entite'))->labelheight()));    
                        $self->setAt($y,$x,'coords', $coords);    
                        $self->setAt($y,$x,'valeur', $champs->get('titre'));   
                    }
                    $x++;   
                }
                $y++;
                return [$x,$y];
            };
            $processed = $process($champs,$x,$y,$this,$process);
            $x = 0;
            $y = $processed[1];
            $y++;
            foreach($lignes as $ligne){
                $entrees = $ligne->getentree();
                foreach($entrees as $entree){
                    if($entree->get('type') == 'entree'){
                        $entreesentree = $this->manager->entitor->getmod('lignes')->select($entree->get('valeur'))->getentree();
                        $champsentree = $this->manager->entitor->getmod('lignes')->select($entree->get('valeur'))->getchamps();
                        $this->setAt($y,$x,'ligne', $y);    
                        $this->setAt($y,$x,'colonne', $x);        
                        $coords=$this->colonnename($x)."".($y+1);
                        $this->setAt($y,$x,'coords', $coords);    
                        $this->setAt($y,$x,'valeur', $entree->get('titre'));
                        foreach($entreesentree as $entree){
                            $this->setAt($y,$x,'ligne', $y);    
                            $this->setAt($y,$x,'colonne', $x);    
                            $coords=$this->colonnename($x)."".($y+1);
                            $this->setAt($y,$x,'coords', $coords);    
                            $this->setAt($y,$x,'valeur', $entree->get('valeur'));    
                            $x++;
                        } 
                    }else{
                        $this->setAt($y,$x,'ligne', $y);    
                        $this->setAt($y,$x,'colonne', $x);
                        $coords=$this->colonnename($x)."".($y+1);
                        $this->setAt($y,$x,'coords', $coords);
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