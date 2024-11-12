const openForm = () => {
    document.getElementById("formPopup").style.display = "block";
    document.getElementById("action").value = "add";
    document.getElementById("id").value = ""; 
    document.getElementById("nom_congre").value = "";
    document.getElementById("prenom").value = "";
    document.getElementById("adresse").value = "";
    document.getElementById("tel").value = "";

    // Remplir la date d'inscription avec la date du jour
    const today = new Date().toISOString().split('T')[0];
    document.getElementById("date_inscription").value = today;

    // Remplir les listes d’organismes, hôtels, sessions
    const organismeSelect = document.getElementById("num_organisme");
    organismeSelect.innerHTML = '<option value="">Sélectionner un organisme</option>';
    organismes.forEach(organisme => {
        const option = document.createElement("option");
        option.value = organisme.nom;
        option.textContent = organisme.nom;
        organismeSelect.appendChild(option);
    });

    const hotelSelect = document.getElementById("num_hotel");
    hotelSelect.innerHTML = '<option value="">Sélectionner un hôtel</option>';
    hotels.forEach(hotel => {
        const option = document.createElement("option");
        option.value = hotel.nom_hotel;
        option.textContent = hotel.nom_hotel;
        hotelSelect.appendChild(option);
    });

    const sessionsSelect = document.getElementById("sessions");
    sessionsSelect.innerHTML = "";
    sessions.forEach(session => {
        const option = document.createElement("option");
        option.value = session.id;
        option.textContent = `${session.nom_session} (${session.date_session})`;
        sessionsSelect.appendChild(option);
    });
};


// Fonction pour ouvrir le formulaire en mode "modification"
const openEditForm = (id, nom, prenom, adresse, tel, dateInscription, organisme, hotel, selectedSessions) => {
    document.getElementById("formPopup").style.display = "block";
    document.getElementById("action").value = "update";
    document.getElementById("id").value = id; 
    document.getElementById("nom_congre").value = nom;
    document.getElementById("prenom").value = prenom;
    document.getElementById("adresse").value = adresse;
    document.getElementById("tel").value = tel;
    document.getElementById("date_inscription").value = dateInscription;

    // Sélectionner l'organisme par nom
    const organismeSelect = document.getElementById("num_organisme");
    organismeSelect.innerHTML = '<option value="">Sélectionner un organisme</option>';
    organismes.forEach(org => {
        const option = document.createElement("option");
        option.value = org.nom;
        option.textContent = org.nom;
        option.selected = (org.nom === organisme);  // Sélectionner si correspond
        organismeSelect.appendChild(option);
    });

    // Sélectionner l'hôtel par nom
    const hotelSelect = document.getElementById("num_hotel");
    hotelSelect.innerHTML = '<option value="">Sélectionner un hôtel</option>';
    hotels.forEach(h => {
        const option = document.createElement("option");
        option.value = h.nom_hotel;
        option.textContent = h.nom_hotel;
        option.selected = (h.nom_hotel === hotel);  // Sélectionner si correspond
        hotelSelect.appendChild(option);
    });

    // Sélectionner les sessions associées au congressiste
    const sessionsSelect = document.getElementById("sessions");
    sessionsSelect.innerHTML = ""; // Réinitialiser
    sessions.forEach(session => {
        const option = document.createElement("option");
        option.value = session.id;
        option.textContent = `${session.nom_session} (${session.date_session})`;
        option.selected = selectedSessions.includes(session.id.toString()); // Sélection si la session est associée
        sessionsSelect.appendChild(option);
    });
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
