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
<script>
    function _ajaxpost_(action,data,cb){
        const req = new XMLHttpRequest()
        const formdata = new FormData()
        formdata.append('action',action)
        Object.keys(data).forEach(
            key=>{
                formdata.append(key,data[key])
            }
        )
        req.addEventListener(
            'load',e=>cb(e,req)
        )
        req.open('post','/app.php')
        req.send(formdata)
    }
    function renderTable(id,target,canedit){
        const data = {id,canedit}
        _ajaxpost_(
            'rendertable',
            data,
            (e,req)=>{
                target.innerHTML = req.response
            }
        )
    }
    function updateentree(colonne,valeur){
        console.log(colonne,valeur)
    }
    renderTable(1,document.querySelector('#view'),1)
    
</script>
</body>
</html>