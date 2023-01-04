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
        function clone($id,$titre,$volet){
            $entiteclass = $this->entitor->getobj('entite');
            $entite = $this->db->request('select_entites_entry',$id);
            $entite = $entite ? new $entiteclass($this, $entite[0]) : null;
            $cloneid  = $this->createNew($titre,$volet);
            $clone = $this->select($cloneid);
            $clone->set('id',$cloneid);
            foreach($entite->getchamps() as $champs){
                $clone->addchamps($champs->get('titre'),$champs->get('type'),($champs->get('reftable')?$champs->get('reftable'):'null'));
            }
            foreach($entite->getlignes() as $ligne){
                $clone->addligne();
            }
            $lignesclone = $clone->getlignes();
            foreach($lignesclone as $idx=>$ligneclone){
                $lignes = $entite->getlignes();
                $entree = $ligneclone->getentree();
                $entreeligne = $lignes[$idx]->getentree();
                foreach($entreeligne as $entree){
                    $ligne->addentree();
                    echo count($entree);
                }
            }
            return $clone;
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
        function setfeedvolet($volet){
            $entiteclass = $this->entitor->getobj('entite');
            $feed = [];
            foreach($this->selectbyvolet($volet) as $entite){
                array_push($feed,new $entiteclass($this,$entite));
            }
            $this->feed = $feed;
            return $feed;
        }
        function getfeedvolet($volet){
            return $this->setfeedvolet($volet);
        }
        function setfeed(){
            $entiteclass = $this->entitor->getobj('entite');
            $feed = [];
            foreach($this->selectAll() as $entite){
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