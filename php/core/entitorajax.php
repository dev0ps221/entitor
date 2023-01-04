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
                echo $tableau->addchamps($titre,$type,$ref,$volet);
            }
            if($action == 'addligne'){
                $entites = $this->entitor->getmod('entites');
                $tableau = $entites->select($id);
                echo $tableau->addligne();
            }
            if($action == 'createtableau'){
                $volets = $this->entitor->getmod('volets');
                $volet = $volets->select($id);
                echo $volet->addentite($titre);
            }
            if($action == 'tables'){
                $entites = $this->entitor->getmod('entites');
                $res = [];
                foreach($entites->getfeed() as $table){
                    array_push($res,$table->retrieveData());
                }
                echo json_encode($res);
            }
            if($action == 'createvolet'){
                echo $this->entitor->getmod('volets')->createNew($titre);
            }
        }
        function __construct($entitor){
            $this->entitor = $entitor;
        }
    }
?>