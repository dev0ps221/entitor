<?php
    class EntitorAjax{
        function processaction($post){
            extract($post);
            if($action == 'rendertable'){
                $entites = $this->entitor->getmod('entites');
                $tableau = $entites->select($id);
                echo $tableau->makerender(isset($canedit)?$canedit:null);
            }
        }
        function __construct($entitor){
            $this->entitor = $entitor;
        }
    }
?>