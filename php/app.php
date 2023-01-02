
<?php
    include('core/entitor.php');
    if($_POST['action']){
        $entitor        = new Entitor([]);
        $entitor->ajax->processaction($_POST);

    }

?>