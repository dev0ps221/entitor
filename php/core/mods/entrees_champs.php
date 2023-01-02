<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorEntreesChamps extends EntitorModule{
        function createNew($valeur,$champs,$type){
            return $this->db->request('insert_into_entrees_champs_entites',['valeur'=>$valeur,'champs'=>$champs,'type'=>$type]);
        }
        function delete($id){
            return $this->db->request('delete_entrees_champs_entites_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_entrees_champs_entites_entries');
        }
        function deletebyvaleur($champs,$valeur){
            return array_filter($this->db->request('delete_entrees_champs_entites_entry_by_entite',$champs),function ($elem){ return $elem['valeur'] == $valeur;});
        }
        function select($id){
            return $this->db->request('select_entrees_champs_entites_entry',$id);
        }
        function selectAll($champs){
            return $this->db->request('select_entrees_champs_entites_entry_by_entite',$champs);
        }
        function selectbyvaleur($champs,$valeur){
            return array_filter($this->db->request('select_entrees_champs_entites_entry_by_entite',$champs),function ($elem){ return $elem['valeur'] == $valeur;});
        }
        function updatefield($id,$field,$value){
            $action = "update_entrees_champs_entites_$field";
            return $this->db->request($action,"'$value'","id = $id");    
        }
        function getfeed($champs){
            $feed = [];
            $champsentiteclass = $this->entitor->getobj('champs_entite');
            foreach($this->selectAll($champs) as $champsentite){
                array_push($feed,new $champsentiteclass($this,$champsentite));
            }
            return $feed;
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>