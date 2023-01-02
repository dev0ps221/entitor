<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorLignes extends EntitorModule{
        function createNew($entite){
            return $this->db->request('insert_into_lignes',['entite'=>$entite]);
        }
        function delete($id){
            return $this->db->request('delete_lignes_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_lignes_entries');
        }
        function select($id){
            return $this->db->request('select_lignes_entry',$id);
        }
        function selectAll($ligne){
            return $this->db->request('select_lignes_entry_by_entite',$ligne);
        }
        function getfeed($ligne){
            $feed = [];
            $ligneentiteclass = $this->entitor->getobj('ligne');
            foreach($this->selectAll($ligne) as $ligneentite){
                array_push($feed,new $ligneentiteclass($this,$ligneentite));
            }
            return $feed;
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>