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
        min-width:800px;
        overflow: scroll;
        border:3px double #1cc;
    }
    .table *{
        display: grid;
    }
    .ligne{
        grid-template-columns:var(--columns);
    }
    .ligne .colonne{
        border:3px double #1dd;
        background:#3992;
        min-height:20px;
        padding:2.5%;
    }
</style>
<section id="view">

</section>
<script src='/client.js'>
</script>
<script src='/builder.js'>
</script>
<script>
    const entitor = new EntitorClient()
    const builder = entitor.newBuilder(document.querySelector('#view'),1)
</script>
</body>
</html>