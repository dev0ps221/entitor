class EntitorBuilder{
    tableau = null
    createtableau(titre){
        const actualvolet = this.client.actualvolet
        this.client.actualvolet = volet
        this.client.createtableau(
            titre
        )
    }
    renametableau(titre){

    }
    constructor(client,target,volet){
        this.client = client
        this.target = target
        this.volet = volet
    }
}