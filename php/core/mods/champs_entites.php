<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorChampsEntites extends EntitorModule{
        
        function createNew($titre,$entite,$type){
            return $this->db->request('insert_into_champs_entites',['titre'=>$titre,'entite'=>$entite,'type'=>$type]);
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
            return $this->db->request('select_champs_entites_entry',$id);
        }
        function selectAll($ligne){
            return $this->db->request('select_champs_entites_entry_by_ligne',$ligne);
        }
        function selectbytitre($ligne,$titre){
            return array_filter($this->db->request('select_champs_entites_entry_by_ligne',$ligne),function ($elem){ return $elem['titre'] == $titre;});
        }
        function updatefield($id,$field,$value){
            $action = "update_champs_entites_$field";
            return $this->db->request($action,"'$value'");    
        }
        function getfeed($entite){
            $feed = [];
            $champsentiteclass = $this->entitor->getobj('champs_entite');
            foreach($this->selectAll($entite) as $champsentite){
                array_push($feed,new $champsentiteclass($this,$champsentite));
            }
            return $feed;
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>