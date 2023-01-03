class EntitorClient {

    actualtable = 1
    actualcanedit = 1
    _builders = []
    Builder = class EntitorBuilder{
        constructor(client,target){
            this.client = client
            this.target = target
        }
    }
    newBuilder(target){
        const builder = new this.Builder(this,target)
        this._builders.push(builder)
        return builder
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
    updatecolonne(colonne,valeur,cb=(e,req)=>{this.refreshTable()}){
        const updatedata = {colonne,valeur}
        this._ajaxpost_(
            'updatecolonne',updatedata,cb
        )
    }
    addligne(cb=(e,req)=>{this.refreshTable()}){
        this._ajaxpost_(
            'addligne',{id:this.actualtable},cb
        )
    }
    addcolonne(cb=(e,req)=>{this.refreshTable()}){
        this._ajaxpost_(
            'addcolonne',{id:this.actualtable},cb
        )
    }
    createtableau(titre,cb=(e,req)=>{this.actualtable = req.response;this.refreshTable()}){
        this._ajaxpost_(
            'createtableau',{titre},cb
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