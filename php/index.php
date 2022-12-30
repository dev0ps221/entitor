<?php
    include('core/entitor.php');
    $entitor        = new Entitor([]);
    $entites        = $entitor->getmod('entites');
    $champs_entites = $entitor->getmod('champs_entites');
    $entrees_champs = $entitor->getmod('entrees_champs');
    $entites->createNew('tableau un');
?>