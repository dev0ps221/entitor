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
        background:red;
        display:grid;
        width:800px;
    }
    .ligne{
        display: grid;
        grid-template-columns:var(--columns);
    }
    .ligne .colonne{
        border:1px solid #399;
        min-height:20px;
        padding:2.5%;
    }
</style>
<?php
    include('core/entitor.php');
    $entitor        = new Entitor([]);
    $entites        = $entitor->getmod('entites');
    
    $tableau = $entites->select(1);
    echo $tableau->makerender();

?>
</body>
</html>