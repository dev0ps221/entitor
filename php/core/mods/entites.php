<?php
    include_once(dirname(__FILE__)."/modskel.php");
     
    class EntitorEntites extends EntitorModule{
        function createNew($titre,$volet){
            return $this->db->request('insert_into_entites',['titre'=>$titre,'volet'=>$volet]);
        }
        function delete($id){
            return $this->db->request('delete_entites_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_entites_entries');
        }
        function deletebytitre($titre){
            return $this->db->request('delete_entites_entry_by_titre',"$titre");
        }
        function select($id){
            $entiteclass = $this->entitor->getobj('entite');
            $entite = $this->db->request('select_entites_entry',$id);
            $entite = $entite ? new $entiteclass($this, $entite[0]) : null;
            return $entite;
        }
        function selectAll(){
            return $this->db->request('select_entites_entries');
        }
        function selectbytitre($titre){
            return $this->db->request('select_entites_entry_by_titre',"$titre");
        }
        function selectbyvolet($volet){
            return $this->db->request('select_entites_entry_by_volet',"$volet");
        }
        function updatefield($id,$field,$value){
            $action = "update_entites_$field";
            return $this->db->request($action,"'$value'","id = $id");
        }
        function setfeed($volet){
            $entiteclass = $this->entitor->getobj('entite');
            $feed = [];
            foreach($this->selectbyvolet($volet) as $entite){
                array_push($feed,new $entiteclass($this,$entite));
            }
            $this->feed = $feed;
            return $feed;
        }
        function getfeed(){
            return $this->setfeed();
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>