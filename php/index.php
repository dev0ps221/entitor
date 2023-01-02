<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<style>
    .table{
        display: grid;
        grid-template-columns:var(--columns);
    }
</style>
<?php
    include('core/entitor.php');
    $entitor        = new Entitor([]);
    $entites        = $entitor->getmod('entites');
    
    $id = 1;
    $tableau = $entites->select($id);
    $tableau->getlignes()[0]->editentree(5,'test');
    echo $tableau->makerender();

?>
</body>
</html>