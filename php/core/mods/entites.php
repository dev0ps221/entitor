<?php
    include_once(dirname(__FILE__)."/modskel.php");
     
    class EntitorEntites extends EntitorModule{
        private $dataset = [
            'entites'=>[]
        ];
        function createNew($titre){
            return $this->db->request('insert_into_entites',['titre'=>$titre]);
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
            return $this->db->request('select_entites_entry',$id);
        }
        function selectAll(){
            return $this->db->request('select_entites_entries');
        }
        function selectbytitre($titre){
            return $this->db->request('select_entites_entry_by_titre',"$titre");
        }
        function updatefield($id,$field,$value){
            $action = "update_entites_$field";
            return $this->db->request($action,"'$value'","id = $id");
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