class EntitorBuilder{
    tableau = null
    tables = []
    createtableau(titre){
        const actualvolet = this.client.actualvolet
        this.client.actualvolet = this.volet
        this.client.createtableau(
            titre,(e,req)=>{
                this.tableau = req.response
                this.client.actualvolet = actualvolet
            }
        )
    }
    ajouter_champs(titre,type,ref){
        if(this.volet){
            if(this.tableau){
                if(titre){
                    if(type){
                        const actualtable = this.client.actualtable
                        const actualvolet = this.client.actualvolet
                        this.client.actualtable = this.tableau
                        this.client.actualvolet = this.volet
                        this.client.addcolonne(
                            titre,type,ref,(e,req)=>{
                                this.client.actualtable = actualtable
                                this.client.actualvolet = actualvolet
                                this.renderTable()
                            }
                        )
                    }
                }
            }
        }
    }
    updateColonne(colonne,valeur,cb=(e,req)=>{this.client.refreshTable()}){
        this.client.updatecolonne(colonne,valeur,cb)
    }
    ajouter_champs_elem(){
        const ajouter_champs = document.createElement('div')
        ajouter_champs.id = 'ajouter_champs'
        const label_ajouter_champs = document.createElement('h3')
        label_ajouter_champs.innerHTML = 'créer un champs'
        const titrebox = document.createElement('div')
        titrebox.classList.add('option')
        const typebox = document.createElement('div')
        typebox.classList.add('option')
        const refbox = document.createElement('div')
        refbox.classList.add('option')
        
        const label_titre = document.createElement('label')
        label_titre.innerHTML = 'titre du champs' 
        label_titre.for = 'titre_champs'
        const titre = document.createElement('input')
        titre.name = 'titre_champs' 
        titre.type = 'text'
        
        const label_type = document.createElement('label')
        label_type.innerHTML = 'type du champs' 
        label_type.for = 'type_champs'
        const type = document.createElement('select')
        const textoption = document.createElement('option')
        textoption.value = 'texte'
        textoption.innerHTML = 'texte'
        
        const tableoption = document.createElement('option')
        tableoption.value = 'tableau'
        tableoption.innerHTML = 'tableau'
        type.appendChild(textoption)
        type.appendChild(tableoption)


        const label_reference = document.createElement('label')
        label_reference.innerHTML = 'reference du champs' 
        label_reference.for = 'type_champs'
        const ref = document.createElement('select')
        this.client.getTables(
            tables=>{
                tables.forEach(
                    table=>{
                        const tableoption = document.createElement('option')
                        tableoption.value = table.id
                        tableoption.innerHTML = table.titre
                        ref.appendChild(tableoption)
                    }
                )
            }
        )
        
        

        const action = document.createElement('button')
        action.innerHTML = 'ajouter' 
        action.addEventListener(
            'click',e=>this.ajouter_champs(titre.value,type.value,type.value=='texte'?'null':ref.value)
        )
        ajouter_champs.appendChild(label_ajouter_champs)
        titrebox.appendChild(label_titre)
        titrebox.appendChild(titre)
        typebox.appendChild(label_type)
        typebox.appendChild(type)
        refbox.appendChild(label_reference)
        refbox.appendChild(ref)
        ajouter_champs.appendChild(titrebox)
        ajouter_champs.appendChild(typebox)
        ajouter_champs.appendChild(refbox)
        ajouter_champs.appendChild(action)
        return ajouter_champs;
    }
    ajouter_ligne(){
        if(this.volet){
            if(this.tableau){
                const actualtable = this.client.actualtable
                this.client.actualtable = this.tableau
                this.client.addligne(
                    (e,req)=>{
                        this.client.actualtable = actualtable
                        this.renderTable()
                    }
                )
            }
        }
    }
    ajouter_ligne_elem(){
        const ajouter_ligne = document.createElement('div')
        ajouter_ligne.id = 'ajouter_ligne'
        const label_ajouter_ligne = document.createElement('h3')
        label_ajouter_ligne.innerHTML = 'créer un ligne'
        const action = document.createElement('button')
        action.innerHTML = 'ajouter' 
        action.addEventListener(
            'click',e=>this.ajouter_ligne() 
        )
        ajouter_ligne.appendChild(label_ajouter_ligne)
        ajouter_ligne.appendChild(action)
        return ajouter_ligne;
    }
    renderTable(tableau=null){
        tableau = tableau != null ? tableau : this.tableau
        if(tableau){
            this.client.renderTable(tableau,this.target,1)
        }
    }
    settableau(id){
        this.tableau = id
    }
    renametableau(titre){

    }
    constructor(client,target,volet){
        this.client = client
        this.target = target
        this.volet = volet
        this.client.getTables(tables=>{
            this.tables = tables
        })
    }
}