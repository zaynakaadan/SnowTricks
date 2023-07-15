// Chercher le lien 
let links = document.querySelectorAll("[data-delete]");

//console.log(links);

// Boucle sur les liens
for(let link of links){
    // Met un écouteur d'événements
    link.addEventListener("click", function(e){
        // Empeche la navigation (pas envoyer vers la page delete)
        e.preventDefault();

        // Demande confirmation
        if(confirm("Voulez-vous supprimer cette image ?")){
            // Envoie la requete
            fetch(this.getAttribute("href"), {
                method: "DELETE",
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({"_token": this.dataset.token})
            }).then(response => response.json())
            .then(data => {
                if(data.success){
                    this.parentElement.remove();
                }else{
                    alert(data.error);
                }
            })
        }
    });
}