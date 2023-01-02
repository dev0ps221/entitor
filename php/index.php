<?php
    include('core/entitor.php');
    $entitor        = new Entitor([]);
    $entites        = $entitor->getmod('entites');
    
    $id = $entites->create('test');
    echo $id;
    print_r($entites->getfeed());

?>