<?php
    include('core/entitor.php');
    $entitor        = new Entitor([]);
    $entites        = $entitor->getmod('entites');
    
    $id = 1;
    $tableau = $entites->select($id);
    $ligne = $tableau->addligne();
    print_r($ligne);

?>