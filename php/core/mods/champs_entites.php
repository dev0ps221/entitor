<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorChampsEntites extends EntitorModule{
        
        function createNew($titre,$entite,$type,$reftable=null){
            $id = $this->db->request('insert_into_champs_entites',['titre'=>$titre,'entite'=>$entite,'type'=>$type,'reftable'=>$reftable]);
            return $id;
        }
        function delete($id){
            return $this->db->request('delete_champs_entites_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_champs_entites_entries');
        }
        function deletebytitre($entite,$titre){
            return array_filter($this->db->request('delete_champs_entites_entry_by_entite',$entite),function ($elem){ return $elem['titre'] == $titre;});
        }
        function select($id){
            $champsentiteclass = $this->entitor->getobj('champs_entite');
            $champsentite = $this->db->request('select_champs_entites_entry',$id);
            $champsentite = $champsentite ? new $champsentiteclass($this, $champsentite[0]) : null;
            return $champsentite;
        }
        function selectAll($entite){
            return $this->db->request('select_champs_entites_entry_by_entite',$entite);
        }
        function selectbytitre($entite,$titre){
            return array_filter($this->db->request('select_champs_entites_entry_by_entite',$entite),function ($elem){ return $elem['titre'] == $titre;});
        }
        function updatefield($id,$field,$value){
            $action = "update_champs_entites_$field";
            return $this->db->request($action,"'$value'");    
        }
        function getfeed($entite){
            $feed = [];
            $champsentiteclass = $this->entitor->getobj('champs_entite');
            $champssentite = $this->selectAll($entite);
            if($champssentite and count($champssentite)){
                foreach($champssentite as $champsentite){
                    array_push($feed,new $champsentiteclass($this,$champsentite));
                }
            }
            return $feed;
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>