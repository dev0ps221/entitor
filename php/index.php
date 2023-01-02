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
        display:grid;
    }
    .ligne{
        display: grid;
        grid-template-columns:var(--columns);
    }
    .ligne .colonne{
        border:1px solid #399;
    }
</style>
<?php
    include('core/entitor.php');
    $entitor        = new Entitor([]);
    $entites        = $entitor->getmod('entites');
    
    $id = 1;
    $tableau = $entites->select($id);
    $tableau->getlignes()[0]->editentree(1,'test');
    $tableau->getlignes()[0]->editentree(2,'test2');
    $tableau->getlignes()[0]->editentree(3,'test3');
    $tableau->getlignes()[0]->editentree(4,'test4');
    $tableau->getlignes()[0]->editentree(5,'test5');
    echo $tableau->makerender();

?>
</body>
</html>