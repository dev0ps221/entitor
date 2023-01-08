
<?php
    include('core/entitor.php');
    if(isset($_POST['action'])){
        $entitor        = new Entitor([]);
        $entitor->ajax->processaction($_POST);

    }

?>