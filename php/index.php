<?php
    include('core/entitor.php');
    $entitor        = new Entitor([]);
    $entites        = $entitor->getmod('entites');
    
    $id = 1;
    print_r($entites->select($id));

?>