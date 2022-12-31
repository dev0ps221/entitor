<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorChampsEntites extends EntitorModule{
        
        function createNew($titre){
            return $this->db->request('insert_into_champs_entites',['titre'=>$titre]);
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
        function selectAll($entite){
            return $this->db->request('select_champs_entites_entries_by_entite',$entite);
        }
        function selectbytitre($entite,$titre){
            return array_filter($this->db->request('select_champs_entites_entry_by_entite',$entite),function ($elem){ return $elem['titre'] == $titre;});
        }
        function updatefield($id,$field,$value){
            $action = "update_champs_entites_$field";
            return $this->db->request($action,"'$value'");    
        }
        function setfeed(){
            $feed = [];
            $entiteclass = $this->entitor->getobj('entite');
            foreach($this->selectAll() as $entite){
                array_push($feed,new $entiteclass($this,$entite));
            }
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>