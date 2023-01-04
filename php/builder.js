class EntitorBuilder{
    tableau = null
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
    ajouter_champs(event){

    }
    ajouter_champs_elem(){
        const ajouter_champs = document.createElement('div')
        ajouter_champs.id = 'ajouter_champs'
        const label_ajouter_champs = document.createElement('h3')
        label_ajouter_champs.innerHTML = 'créer un champs' 
        label_ajouter_champs.classList.
        const optionbox = document.createElement('div')
        optionbox.id = 
        optionbox.classList.
        const label_titre = document.createElement('label')
        label_titre.id = 
        label_titre.classList.
        const titre = document.createElement('input')
        titre.id = 
        titre.classList.
        const action = document.createElement('button')
        action.id = 
        action.classList.
        const addchamps : `<div id='ajouter_champs'>
                <h3>
                    creer un champs
                </h3>
                <div class='option'>
                    <label for='titre_champs'> titre un champs</label>
                    <input type='text' name='titre_champs' placeholder='nouveau_champs'>
                </div>
                <button onclick='ajouterchamps(event)'>
                    creer
                </button>
            </div>
        `;
        return render;
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
    }
}