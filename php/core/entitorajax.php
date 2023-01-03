<?php
    class EntitorAjax{
        function processaction($post){
            extract($post);
            if($action == 'rendertable'){
                $entites = $this->entitor->getmod('entites');
                $tableau = $entites->select($id);
                echo $tableau->makerender(isset($canedit)?$canedit:null);
            }
            if($action == 'renamecolonne'){
                
            }
            if($action == 'updatecolonne'){
                $champs = $this->entitor->getmod('entrees_champs')->select($colonne);
                echo $champs->updateval($valeur);
            }
            if($action == 'addcolonne'){
                $entites = $this->entitor->getmod('entites');
                $tableau = $entites->select($id);
                echo $tableau->addchamps($titre,$type);
            }
            if($action == 'addligne'){
                $entites = $this->entitor->getmod('entites');
                $tableau = $entites->select($id);
                echo $tableau->addligne();
            }
            if($action == 'createtableau'){
                echo $this->entitor->getmod('entites')->createNew($titre);
            }
        }
        function __construct($entitor){
            $this->entitor = $entitor;
        }
    }
?>