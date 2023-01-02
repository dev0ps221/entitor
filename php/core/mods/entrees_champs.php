<?php
    include_once(dirname(__FILE__)."/modskel.php");
    class EntitorEntreesChamps extends EntitorModule{
        function createNew($valeur,$champs,$ligne,$type){
            return $this->select($this->db->request('insert_into_entrees_champs_entites',['valeur'=>$valeur,'champs'=>$champs,'ligne'=>$ligne,'type'=>$type]));
        }
        function delete($id){
            return $this->db->request('delete_entrees_champs_entites_entry',$id);
        }
        function deleteAll(){
            return $this->db->request('delete_entrees_champs_entites_entries');
        }
        function deletebyvaleur($champs,$valeurchamps){
            return array_filter($this->db->request('delete_entrees_champs_entites_entry_by_ligne',$champs),function ($elem){ return $elem['valeur'] == $valeur;});
        }
        function select($id){
            $entreeclass = $this->entitor->getobj('entree_champs');
            $entree = $this->db->request('select_entrees_champs_entites_entry',$id);;
            $entree = $entree ? new $entreeclass($this, $entree[0]) : null;
            return $entree;
        }
        function selectAll($ligne){
            return $this->db->request('select_entrees_champs_entites_entry_by_ligne',$ligne);
        }
        function selectbyvaleur($champs,$valeur){
            return array_filter($this->db->request('select_entrees_champs_entites_entry_by_ligne',$champs),function ($elem){ return $elem['valeur'] == $valeur;});
        }
        function updatefield($id,$field,$value){
            $action = "update_entrees_champs_entites_$field";
            return $this->db->request($action,"'$value'","id = $id");    
        }
        function updateval($id,$value){
            $action = "update_entrees_champs_entites_valeur";
            return $this->db->request($action,"'$value'","id = $id");    
        }
        function getfeed(){
            $feed = [];
            $entreeclass = $this->entitor->getobj('entree_champs');
            foreach($this->selectAll($this->get('ligne')) as $entree){
                array_push($feed,new $entreeclass($this,$entree));
            }
            return $feed;
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>