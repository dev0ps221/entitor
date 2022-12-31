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
        function deletebytitre($entite,$titre){
            return array_filter($this->db->request('delete_lignes_entry_by_entite',$entite),function ($elem){ return $elem['titre'] == $titre;});
        }
        function select($id){
            return $this->db->request('select_lignes_entry',$id);
        }
        function selectAll($entite){
            return $this->db->request('select_lignes_entry_by_entite',$entite);
        }
        function selectbytitre($entite,$titre){
            return array_filter($this->db->request('select_lignes_entry_by_entite',$entite),function ($elem){ return $elem['titre'] == $titre;});
        }
        function updatefield($id,$field,$value){
            $action = "update_lignes_$field";
            return $this->db->request($action,"'$value'");    
        }
        function getfeed($entite){
            $feed = [];
            $champsentiteclass = $this->entitor->getobj('ligne');
            foreach($this->selectAll($entite) as $champsentite){
                array_push($feed,new $champsentiteclass($this,$champsentite));
            }
            return $feed;
        }
        function deletebyentite($entite){
            return $this->db->request('delete_lignes_entry_by_entite',"$entite");
        }
        function selectbyentite($entite){
            return $this->db->request('select_lignes_entry_by_entite',"$entite");
        }
        function __construct($entitor,$name,$conn){
            parent::__construct($entitor,$name,$conn);
        }
    }
?>