<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorEntreesLignes extends EntitorModule{
        function createNew($valeur,$ligne,$type){
            return $this->db->request('insert_into_entrees_lignes',['valeur'=>$valeur,'ligne'=>$ligne,'type'=>$type]);
        }
        function delete($id){
            return $this->db->request('delete_entrees_lignes_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_entrees_lignes_entries');
        }
        function deletebyvaleur($ligne,$valeur){
            return array_filter($this->db->request('delete_entrees_lignes_entry_by_entite',$ligne),function ($elem){ return $elem['valeur'] == $valeur;});
        }
        function select($id){
            return $this->db->request('select_entrees_lignes_entry',$id);
        }
        function selectAll($ligne){
            return $this->db->request('select_entrees_lignes_entry_by_entite',$ligne);
        }
        function selectbyvaleur($ligne,$valeur){
            return array_filter($this->db->request('select_entrees_lignes_entry_by_entite',$ligne),function ($elem){ return $elem['valeur'] == $valeur;});
        }
        function updatefield($id,$field,$value){
            $action = "update_entrees_lignes_$field";
            return $this->db->request($action,"'$value'","id = $id");    
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