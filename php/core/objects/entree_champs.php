<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntreeChamps extends EntitorObject{
        
        function updateval($value){
            return $this->manager->updateval($this->get('id'),$value);
            
        }
        function makeentreerender($canedit){
            $entrees = [];
            error_log(json_encode($this->entree));
            foreach($this->entree as $i=>$entree){
                array_push($entrees,$entree->makerender($canedit));
            }
            return"
                <div id='ligne".$this->get("id")."' class='ligne' style='--columns:repeat(".count($entrees).",1fr)'>
                    ".
                    implode('',$entrees)  
                    ."
                </div>
            ";
        }
        function makerender($canedit){
            return ($this->get('type') == 'entree') ? $this->makeentreerender($canedit) :"
            <div id='entree_champs_".$this->get("id")."' class='colonne'>
                ".(
                    $canedit    ?
                            "<input type='text' onchange='if(typeof builder !=".'"undefined"'."){builder.updateColonne(".$this->get('id').",event.target.value)}' value='".$this->get('valeur')."'/>"
                        :
                            $this->get('valeur')
                )."  
            </div>
            ";
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
            if($this->get('type') == 'entree'){
                $this->entree = $this->manager->entitor->getmod('lignes')->select($this->get('valeur'))->getentree();
            }
        }
    }
?>