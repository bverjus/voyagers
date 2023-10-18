import './bootstrap';

import Alpine from 'alpinejs';

import $ from 'jquery';
window.jQuery = $;
window.$ = $;

window.Alpine = Alpine;

Alpine.start();

const itineraireContent = document.getElementById('itineraire');
const editButton = document.getElementById('edit-button');
const saveButton = document.getElementById('save-button');
let isEditing = false;
let itineraireBackup = ''; // Stocker la copie de l'itinéraire original

editButton.addEventListener('click', () => {
    if (!isEditing) {
        // Sauvegarder l'itinéraire original
        itineraireBackup = itineraireContent.innerHTML;
        
        // Créer un textarea
        const textarea = document.createElement('textarea');
        textarea.id = 'itineraireTextarea';
        textarea.name = 'itineraire';
        textarea.className = 'min-h-[800px] w-full mx-auto rounded-md border-gray-300 shadow-sm focus:border-bleu focus:ring-bleu';
        textarea.value = itineraireContent.innerText;
        
        // Remplacer l'élément <p> par le <textarea>
        itineraireContent.replaceWith(textarea);

        itineraireContent.style.display = 'none';
        
        textarea.focus();
        editButton.classList.add('hidden');
        saveButton.classList.remove('hidden');
    } else {
        // Récupérer la valeur du textarea
        const textarea = document.getElementById('itineraireTextarea');
        const updatedItineraire = textarea.value;

        // Remplacer le textarea par l'élément <p> avec la nouvelle valeur
        itineraireContent.innerHTML = updatedItineraire;
        itineraireContent.style.display = 'block';

        // Supprimer le textarea
        textarea.remove();

        // Sauvegardez les modifications ici, vous devrez envoyer ces données au serveur
        // par le biais d'une requête AJAX ou d'un formulaire.
        
        editButton.textContent = 'Modifier';
    }
    isEditing = !isEditing;
});


const ActivityListContent = document.querySelector('.activity');
const editButtonActivity = document.getElementById('edit-button-activites');
const saveButtonActivity = document.getElementById('save-button-activites');
let isEditingActivity = false;
let ActivityListBackup = ''; // Stocker la copie de l'itinéraire original

console.log(ActivityListContent);

editButtonActivity.addEventListener('click', () => {
    if (!isEditingActivity) {
        // Sauvegarder l'itinéraire original
        ActivityListBackup = ActivityListContent.innerHTML;
        
        // Créer un textarea
        const textarea = document.createElement('textarea');
        textarea.id = 'activityTextarea';
        textarea.name = 'activites';
        textarea.className = 'min-h-[800px] w-full mx-auto rounded-md border-gray-300 shadow-sm focus:border-bleu focus:ring-bleu';
        textarea.value = ActivityListContent.innerText;
        
        // Remplacer l'élément <p> par le <textarea>
        ActivityListContent.replaceWith(textarea);

        ActivityListContent.style.display = 'none';
        
        textarea.focus();
        editButtonActivity.classList.add('hidden');
        saveButtonActivity.classList.remove('hidden');
    } else {
        // Récupérer la valeur du textarea
        const textarea = document.getElementById('activityTextarea');
        const updatedActivity = textarea.value;

        // Remplacer le textarea par l'élément <p> avec la nouvelle valeur
        ActivityListContent.innerHTML = updatedActivity;
        ActivityListContent.style.display = 'block';

        // Supprimer le textarea
        textarea.remove();

        // Sauvegardez les modifications ici, vous devrez envoyer ces données au serveur
        // par le biais d'une requête AJAX ou d'un formulaire.
        
        editButtonActivity.textContent = 'Modifier';
    }
    isEditingActivity = !isEditingActivity;
});