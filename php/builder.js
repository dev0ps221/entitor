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
    addchampsrender(){
        
        const render = `<div id='ajouter_champs'>
                <h3>
                    creer un champs
                </h3>
                <div class='option'>
                    <label for='titre_champs'> titre un champs</label>
                    <input type='text' name='titre_champs' placeholder='nouveau_champs'>
                </div>
                <button onclick='ajouterchamps(${this->tableau})'>
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