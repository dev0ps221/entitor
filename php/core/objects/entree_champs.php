<?php
    include_once(dirname(__FILE__)."/objskel.php");
    class EntitorEntreeChamps extends EntitorObject{
        
        function updateval($value){
            return $this->manager->updateval($this->get('id'),$value);
            
        }
        function makerender($canedit){
            return "
            <div id='entree_champs_".$this->get("id")."' class='colonne'>
                ".(
                    $canedit    ?
                            "<input type='text' value='".$this->get('valeur')."'/>"
                        :
                            $this->get('valeur')
                )."  
            </div>
            ";
        }
        function __construct($manager,$data){
            parent::__construct($manager,$data);
        }
    }
?>