<?php
    include_once(dirname(__FILE__)."/modskel.php");
     
    class EntitorVolets extends EntitorModule{
        function createNew($titre){
            return $this->db->request('insert_into_volets',['titre'=>$titre]);
        }
        function delete($id){
            return $this->db->request('delete_volets_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_volets_entries');
        }
        function deletebytitre($titre){
            return $this->db->request('delete_volets_entry_by_titre',"$titre");
        }
        function select($id){
            $voletclass = $this->entitor->getobj('volet');
            $volet = $this->db->request('select_volets_entry',$id);
            $volet = $volet ? new $voletclass($this, $volet[0]) : null;
            return $volet;
        }
        function selectAll(){
            return $this->db->request('select_volets_entries');
        }
        function selectbytitre($titre){
            return $this->db->request('select_volets_entry_by_titre',"$titre");
        }
        function updatefield($id,$field,$value){
            $action = "update_volets_$field";
            return $this->db->request($action,"'$value'","id = $id");
        }
        function setfeed(){
            $voletclass = $this->entitor->getobj('volet');
            $feed = [];
            foreach($this->selectAll() as $volet){
                array_push($feed,new $voletclass($this,$volet));
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