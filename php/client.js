class EntitorClient {

    actualtable = 1
    actualcanedit = 1
    Builder = class EntitorBuilder{
        constructor(target){
            this.target
        }
    }
    _ajaxpost_(action,data,cb){
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
    renderTable(id,target,canedit){
        const data = {id,canedit}
        this._ajaxpost_(
            'rendertable',
            data,
            (e,req)=>{
                target.innerHTML = req.response
            }
        )
    }
    updatecolonne(colonne,valeur){
        const updatedata = {colonne,valeur}
        this._ajaxpost_(
            'updatecolonne',updatedata,(e,req)=>{
                this.refreshTable()
            }
        )
    }
    addligne(){
        this._ajaxpost_(
            'addligne',{id:this.actualtable},(e,req)=>{
                this.refreshTable()
            }
        )
    }
    addcolonne(){
        this._ajaxpost_(
            'addcolonne',{id:this.actualtable},(e,req)=>{
                this.refreshTable()
            }
        )
    }
    createtableau(titre){
        this._ajaxpost_(
            'createtableau',{titre},(e,req)=>{
                this.actualtable = req.response
                this.refreshTable()
            }
        )
    }
    refreshTable(canedit){
        this.renderTable(this.actualtable,document.querySelector('#view'),this.actualcanedit)
    }
    previewTableOn(target){
        this.target = target
        this.renderTable(this.actualtable,this.target)
    }
    constructor(){
        this.refreshTable()
    }

}