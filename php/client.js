
class EntitorClient {
    actualvolet = null
    actualtable = null
    actualcanedit = 1
    _builders = []
    _tables = []
    Builder = (typeof EntitorBuilder != 'undefined') ? EntitorBuilder : null
    newBuilder(target,volet){
        if(this.Builder){
            volet = volet ? volet : this.actualvolet
            const builder = new this.Builder(this,target,volet)
            this._builders.push(builder)
            return builder
        }
        console.log('EntitorBuilder support is not loaded')
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
    addcolonne(titre,type,ref,cb=(e,req)=>{this.refreshTable()}){
        if(this.actualtable){
            this._ajaxpost_(
                'addcolonne',{id:this.actualtable,volet:this.actualvolet,titre,type,ref},cb
            )
        }
    }
    createtableau(titre,cb=(e,req)=>{this.actualtable = req.response;this.refreshTable()}){
        if(this.actualvolet){
            this._ajaxpost_(
                'createtableau',{titre,id:this.actualvolet},cb
            )
        }
    }
    createvolet(titre,cb=(e,req)=>{this.actualvolet = req.response;}){
        this._ajaxpost_(
            'createvolet',{titre},(e,req)=>{
                this.actualvolet = req.response
                cb(e,req)
            }
        )
    }
    refreshTable(canedit){
        if(this.actualtable){
            this.renderTable(this.actualtable,document.querySelector('#view'),this.actualcanedit)
        }
    }
    previewTableOn(target){
        if(this.actualtable){
            this.target = target
            this.renderTable(this.actualtable,this.target)
        }
    }
    getTables(cb){
        this._ajaxpost_(
            'tables',{},(e,req)=>{
                this._tables = JSON.parse(req.response)
                cb(this._tables)
            }
        )
    }
    constructor(){
        this.refreshTable()
    }

}