<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorLignes extends EntitorModule{
        function createNew($entite){
            return $this->select($this->db->request('insert_into_lignes',['entite'=>$entite]));
        }
        function delete($id){
            return $this->db->request('delete_lignes_entry',$id);
        }
        function deleteAllByEntite($entite){
            return $this->db->request('delete_lignes_entry_by_entite',$entite);
        }
        function deleteAll(){
            return $this->db->request('delete_lignes_entries');
        }
        function select($id){
            $ligneentiteclass = $this->entitor->getobj('ligne');
            $ligne =  $this->db->request('select_lignes_entry',$id);
            $ligne = $ligne ? new $ligneentiteclass($this, $ligne[0]) : null;
            return $ligne;
        }
        function selectAllByEntite($entite){
            return $this->db->request('select_lignes_entry_by_entite',$entite);
        }
        function selectAll(){
            return $this->db->request('select_lignes_entries');
        }
        function getfeed($entite){
            $feed = [];
            $ligneentiteclass = $this->entitor->getobj('ligne');
            $lignesentite = $this->selectAllByEntite($entite);
            if($lignesentite and count($lignesentite)){
                foreach($lignesentite as $ligneentite){
                    array_push($feed,new $ligneentiteclass($this,$ligneentite));
                }
            }
            return $feed;
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>