// Fonction pour ouvrir le formulaire en mode "ajout"
const openForm = () => {
    document.getElementById("formPopup").style.display = "block";
    document.getElementById("action").value = "add";
    document.getElementById("id").value = ""; 
    document.getElementById("nom_congre").value = "";
    document.getElementById("prenom").value = "";
    document.getElementById("adresse").value = "";
    document.getElementById("tel").value = "";
    document.getElementById("date_inscription").value = "";
    document.getElementById("num_organisme").value = "";
    document.getElementById("num_hotel").value = "";

    // Remplir la liste des organismes
    const organismeSelect = document.getElementById("num_organisme");
    organismeSelect.innerHTML = '<option value="">Sélectionner un organisme</option>';
    organismes.forEach(organisme => {
        const option = document.createElement("option");
        option.value = organisme.id;
        option.textContent = organisme.nom;
        organismeSelect.appendChild(option);
    });

    // Remplir la liste des hôtels
    const hotelSelect = document.getElementById("num_hotel");
    hotelSelect.innerHTML = '<option value="">Sélectionner un hôtel</option>';
    hotels.forEach(hotel => {
        const option = document.createElement("option");
        option.value = hotel.id;
        option.textContent = hotel.nom_hotel;
        hotelSelect.appendChild(option);
    });

    // Remplir la liste des sessions
    const sessionsSelect = document.getElementById("sessions");
    sessionsSelect.innerHTML = ""; // Réinitialiser
    sessions.forEach(session => {
        const option = document.createElement("option");
        option.value = session.id;
        option.textContent = `${session.nom_session} (${session.date_session})`;
        sessionsSelect.appendChild(option);
    });
};



// Fonction pour ouvrir le formulaire en mode "modification"
const openEditForm = (id, nom, prenom, adresse, tel, dateInscription, organisme, hotel, sessions) => {
    document.getElementById("formPopup").style.display = "block";
    document.getElementById("action").value = "update";
    document.getElementById("id").value = id; 
    document.getElementById("nom_congre").value = nom;
    document.getElementById("prenom").value = prenom;
    document.getElementById("adresse").value = adresse;
    document.getElementById("tel").value = tel;
    document.getElementById("date_inscription").value = dateInscription;
    document.getElementById("num_organisme").value = organisme;
    document.getElementById("num_hotel").value = hotel;
    
    // Sélectionner les sessions associées au congressiste
    const sessionsSelect = document.getElementById("sessions");
    for (let i = 0; i < sessionsSelect.options.length; i++) {
        sessionsSelect.options[i].selected = sessions.includes(sessionsSelect.options[i].value);
    }
};

// Fonction pour fermer le formulaire
const closeForm = () => {
    document.getElementById("formPopup").style.display = "none";
};

// Fonction de confirmation pour la suppression d'un congressiste
const confirmDelete = (id) => {
    if (confirm("Voulez-vous vraiment supprimer ce congressiste ?")) {
        document.getElementById("action").value = "delete";
        document.getElementById("id").value = id;
        document.forms[0].submit(); 
    }
};
