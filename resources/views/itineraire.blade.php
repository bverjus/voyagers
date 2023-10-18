<x-app-layout>
    <x-slot name="header"></x-slot>

    
    <h1 class="text-center text-2xl lg:text-3xl font-display font-bold text-bleu mt-12 mb-12 w-[80%] mx-auto">Voyage à {{$itineraire->lieu}}</h1>

    <div class="w-full mb-10">
        <div class="w-[85%] mx-auto h-full my-auto py-4 px-[2.5%] bg-[#fafafa] rounded-3xl">
            <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 xl:gap-8 mt-10">
                <div class="lg:col-span-2 lg:pr-2 border-b-2 border-orange lg:border-b-0 lg:border-r-2 lg:border-orange" >
                    <form method="POST" action="{{ route('itineraire.update', ['id' => $itineraire->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center mb-10 justify-between">
                            <h2 class="text-[18px] sm:text-xl xl:text-2xl  font-medium text-noir font-display mr-5">Itinéraire personnalisé </h2>
                            <a id="edit-button" class="border border-orange text-bleu px-5 md:px-6 py-1 text-sm font-display rounded  hover:bg-orange hover:text-white mr-6 cursor-pointer">Modifier</a>
                            <button type="submit" id="save-button" class="hidden bg-orange px-5 md:px-6 py-1 text-white font-display text-sm rounded hover:bg-orange_hover mr-6">Enregistrer</button>
                        </div>
                        
                        <div class="mt-1 mb-12">
                            <p
                                id="itineraire"
                                name='itineraire'
                                class="min-h-[800px] w-full mx-auto rounded-md border-gray-300 shadow-sm focus:border-bleu focus:ring-bleu"
                            >{!! nl2br($itineraire->itineraires) !!}
                            </p>
                        </div>
                    </form>
                   
                </div>
                
                <div class="mt-8 lg:mt-0"> 
                    <form method="POST" action="{{ route('itineraire.update', ['id' => $itineraire->id]) }}">
                        @csrf
                        @method('PUT')
                        <div class="flex items-center mb-10 justify-between">
                            <h2 class="text-[18px] sm:text-xl xl:text-2xl  font-medium text-noir font-display mr-5">Recommandations </h2>
                            <a id="edit-button-activites" class="border border-orange text-bleu px-5 md:px-6 py-1 text-sm font-display rounded  hover:bg-orange hover:text-white mr-6 cursor-pointer">Modifier</a>
                            <button type="submit" id="save-button-activites" class="hidden bg-orange px-5 md:px-6 py-1 text-white font-display text-sm rounded hover:bg-orange_hover mr-6">Enregistrer</button>
                        </div>
                    
                        <ul class="mb-12 activity">
                            @php
                                $activityList = preg_split('/\s(?=\d+\))/u', $itineraire->recommandation);
                            @endphp
    
                            @foreach ($activityList as $activity)
                                <li >{!! $activity !!}</li><br>
                            @endforeach
                        </ul>
                    </form>
                </div>
                
            </section>
        </div>
        <div class="flex w-[85%] mx-auto mt-6 space-x-10">
            <form method="POST" action="{{ route('itineraire.destroy', $itineraire->id) }}" class=" ">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-orange px-10 py-2 text-white font-display text-lg rounded hover:bg-orange_hover">Supprimer</button>
            </form>

            <a href="{{ route('itineraire.pdf', ['id' => $itineraire->id]) }}" class="bg-bleu px-10 py-2 text-white font-display text-lg rounded hover:bg-blue-950 target="_blank">PDF</a>

        </div>
    </div>
</x-app-layout>
@include('partials.footer')

{{-- <script>
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
    </script> --}}