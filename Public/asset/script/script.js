
function ajouterIngredient(event) {
    event.preventDefault();

    let nomIngredient = document.getElementById("nom_ingredient").value;
    let quantiteIngredient = document.getElementById("quantite_ingredient").value;
    let uniteIngredient = document.getElementById("unite_ingredient").value;
    if (nomIngredient !== "" && quantiteIngredient !== "" && uniteIngredient !== "") {
        let nouvelIngredient = document.createElement("li");
        nouvelIngredient.textContent = quantiteIngredient + " " + uniteIngredient + " de " + nomIngredient;
//dans la balise li je lui demande de m'ecrire ma quantité mon unite et mon nomingredient je concatene 
        let croixIcon = document.createElement("span");
        croixIcon.textContent = "❎";
        croixIcon.style.cursor = "pointer" 

        croixIcon.addEventListener("click", function() {
            // Appelle la fonction pour supprimer l'élément et l'input hidden
            supprimerIngredient(nomIngredient, nouvelIngredient);
            // Supprime l'élément de la liste
            nouvelIngredient.remove();
        });
        
        nouvelIngredient.appendChild(croixIcon);

        createHiddenInput('ingredient[]', JSON.stringify({name: nomIngredient, quantity: quantiteIngredient, unit: uniteIngredient}));
//ici je vide les inputs
        document.getElementById("ingredientList").appendChild(nouvelIngredient);
        document.getElementById("nom_ingredient").value = "";
        document.getElementById("quantite_ingredient").value = "";
        document.getElementById("unite_ingredient").value = "";
    } else {
        alert("Veuillez remplir tous les champs avant d'ajouter un ingrédient.");
    }
}


function createHiddenInput(name, value) {
    // Create a hidden input element
    let hiddenInput = document.createElement('input');
    hiddenInput.type = 'hidden';
    hiddenInput.name = name;
    hiddenInput.value = value;
    console.log(hiddenInput);
    
    // Append it to the form
    document.getElementById('form1').appendChild(hiddenInput);
    console.log(document.getElementById('form1'));
}

function supprimerIngredient(nomIngredient, element) {
    let hiddenInput = document.querySelector('input[name="ingredient[]"][value*="' + nomIngredient + '"]');
    if (hiddenInput) {
        hiddenInput.remove();
    }
    element.remove();
}