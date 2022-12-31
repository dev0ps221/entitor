<?php
    include_once(dirname(__FILE__)."/modskel.php");
     
    class EntitorLignes extends EntitorModule{
        private $dataset = [
            'lignes'=>[]
        ];
        function createNew($titre){
            return $this->db->request('insert_into_lignes',['entite'=>$entite]);
        }
        function delete($id){
            return $this->db->request('delete_lignes_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_lignes_entries');
        }
        function deletebyentite($entite){
            return $this->db->request('delete_lignes_entry_by_entite',"$entite");
        }
        function select($id){
            return $this->db->request('select_lignes_entry',$id);
        }
        function selectAll(){
            return $this->db->request('select_lignes_entries');
        }
        function selectbyentite($entite){
            return $this->db->request('select_lignes_entry_by_entite',"$entite");
        }
        function updatefield($id,$field,$value){
            $action = "update_lignes_$field";
            return $this->db->request($action,"$value");    
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