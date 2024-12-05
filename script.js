// Sélection des éléments HTML nécessaires
const container = document.querySelector(".container"), // Sélectionne l'élément contenant les formulaires (connexion et inscription)
      pwShowHide = document.querySelectorAll(".showHidePw"), // Sélectionne tous les éléments permettant de montrer/cacher le mot de passe
      pwFields = document.querySelectorAll(".password"), // Sélectionne tous les champs de mot de passe
      signUp = document.querySelector(".signup-link"), // Sélectionne le lien pour basculer vers le formulaire d'inscription
      login = document.querySelector(".login-link"); // Sélectionne le lien pour basculer vers le formulaire de connexion

// Code JavaScript pour afficher/masquer le mot de passe et changer l'icône
pwShowHide.forEach(eyeIcon => { // Parcourt chaque icône œil
    eyeIcon.addEventListener("click", () => { // Ajoute un écouteur d'événements au clic sur l'icône
        pwFields.forEach(pwField => { // Parcourt chaque champ de mot de passe
            if (pwField.type === "password") { // Si le type du champ est "password"
                pwField.type = "text"; // Change le type en "text" pour afficher le mot de passe

                pwShowHide.forEach(icon => { // Parcourt toutes les icônes œil
                    icon.classList.replace("uil-eye-slash", "uil-eye"); // Remplace l'icône de l'œil barré par l'œil ouvert
                })
            } else { // Sinon, si le type est autre
                pwField.type = "password"; // Change le type en "password" pour masquer le mot de passe

                pwShowHide.forEach(icon => { // Parcourt toutes les icônes œil
                    icon.classList.replace("uil-eye", "uil-eye-slash"); // Remplace l'icône de l'œil ouvert par l'œil barré
                })
            }
        }) 
    })
})

// Code JavaScript pour faire apparaître les formulaires d'inscription et de connexion
signUp.addEventListener("click", () => { // Ajoute un écouteur d'événements au clic sur le lien d'inscription
    container.classList.add("active"); // Ajoute la classe "active" au conteneur pour afficher le formulaire d'inscription
});
login.addEventListener("click", () => { // Ajoute un écouteur d'événements au clic sur le lien de connexion
    container.classList.remove("active"); // Supprime la classe "active" du conteneur pour afficher le formulaire de connexion
});
