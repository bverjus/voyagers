<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-2 w-full">
        <div class="w-full lg:max-w-[80%] lg:mx-auto h-[600px] 2xl:h-[80vh] relative">
            <img src="{{ asset('images/hero-banner.png') }}" alt="" class="w-full h-full rounded-3xl object-cover object-center">
            <div class="bg-bleu bg-opacity-80 absolute top-[5%] sm:top-[25%] 2xl:top-[30%] w-[80%] right-[10%] sm:w-[70%] sm:right-[15%] md:w-[50%] md:right-[25%] mx-auto lg:right-[5%] lg:w-[35%] xl:w-[33%] 2xl:w-[28%] z-10 rounded-3xl p-6 xl:p-10">
                {{-- <form action="{{ route('generation.generate') }}" method="POST" id="generation-form" class="w-full "> --}}
                <form id="generation-form" class="w-full">
                    @csrf
                    <div class="flex flex-col w-full mb-2">
                        <label for="preferences" class="text-sm font-display font-medium text-white mb-1">Lieu</label>
                        <input type="text" id="content" name="content" value="{{ request()->content ?? '' }}" class=" rounded">
                    </div>
                    <div class="flex flex-col sm:flex-row mb-2">
                        <div class="flex flex-col w-full sm:w-1/2 mt-3">
                            <label for="preferences" class="text-sm font-display font-medium text-white mb-1">Type de voyage</label>
                            <select name="type" class="rounded" value="{{ request()->type ?? ''}}">
                                <option value="aventure">Aventure</option>
                                <option value="culturel">Culturel</option>
                                <option value="romantique">Romantique</option>
                                <option value="famille">Famille</option>
                                <option value="detente">Détente</option>
                                <option value="historique">Historique</option>
                                <option value="bien être">Bien-être</option>
                                <option value="festif">Festif</option>
                            </select>
                        </div>
                        <div class="flex flex-col sm:items-center w-full sm:w-1/2 mt-3">
                            <label for="preferences" class="text-sm font-display font-medium text-white mb-1">Nombre de jours</label>
                            <div class="flex items-center space-x-2 sm:justify-center" x-data="{numberOfDays: {{ request()->days ?? 1 }} }">
                                <a @click="numberOfDays = numberOfDays > 1 ? numberOfDays - 1 : 1"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#E28653"><path d="M200-440v-80h560v80H200Z"/></svg></a>
                                <input type="number" id="days" name="days" class="rounded w-1/4 sm:w-1/2" x-model="numberOfDays" x-bind:value="numberOfDays < 1 ? 1 : numberOfDays" readonly>
                                <a @click="numberOfDays = numberOfDays < 15 ? numberOfDays + 1 : 15"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#E28653"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg></a>
                            </div>
                            
                        </div>
                    </div>
                    <div class="flex flex-col sm:flex-row mb-2">
                        <div class="flex flex-col w-full sm:w-[60%] mt-3">
                            <label for="preferences" class="text-sm font-display font-medium text-white mb-1">Nombre de personnes</label>
                            <div class="flex items-center space-x-2" x-data="{numberOfPeople: {{ request()->number ?? 1 }}}">
                                <a @click="numberOfPeople = numberOfPeople > 1 ? numberOfPeople - 1 : 1" ><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#E28653"><path d="M200-440v-80h560v80H200Z"/></svg></a>
                                <input type="number" id="number" class="rounded w-1/4 sm:w-[45%]" name="number" x-model="numberOfPeople" x-bind:value="numberOfPeople < 1 ? 1 : numberOfPeople" readonly>
                                <a @click="numberOfPeople += 1"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#E28653"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg></a>
                            </div>
                            
                        </div>
                        <div class="flex flex-col sm:items-center w-full sm:w-1/2 mt-3 " x-data="{ budgetValue: {{ request()->budget ?? 500 }} }">
                            <label for="preferences" class="text-sm font-display font-medium  text-white mb-1">Budget</label>
                            <input type="range" class="w-[90%] custom-range" id="budget" name="budget" min="0" max="5000" step="100" x-model="budgetValue">
                            <span id="budget-value" class="text-orange text-sm font-display font-medium" x-text="budgetValue"></span>
                        </div>
                    </div>
                    {{-- <button type="submit" class="bg-orange text-white px-12 py-2 rounded-md text-sm font-semibold font-display hover:bg-orange_hover mt-5">Générer</button> --}}
                    <button id="generate-button" type="submit" class="bg-orange text-white px-12 py-2 rounded-md text-sm font-semibold font-display hover-bg-orange_hover mt-5">Générer</button>
                    {{-- <div id="generate-link" data-route="{{ route('generation.generate') }}"></div> --}}
                </form>    
            </div>
            <div role="status" class="loader w-full justify-center mt-4 px-4  items-center bg-gray-500 py-4 md:py-8 bg-opacity-60 absolute bottom-0 z-40 rounded-b-3xl hidden">
                <p class="text-lg sm:text-xl font-display mr-4 md:mr-6 text-white font-semibold text-loader"><span>Nous sommes en train de générer votre itinéraire</p>
                <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-white fill-bleu" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
               
            </div>
        </div>
        
        <div class="w-full mb-10">
            <div class="w-[80%] mx-auto h-full my-auto ">
                <section class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-10">
                    <div class="lg:col-span-2 itineraire-container" >
                        <h2 class="text-2xl font-medium text-gray-700 mb-10">Itinéraire personnalisé : </h2>
                        {{-- @isset($itineraire) --}}
                            <div class="mt-1 mb-12">
                                {{-- <textarea
                                    id="itineraire"
                                    class="min-h-[720px] w-full mx-auto rounded-md border-gray-300 shadow-sm focus:border-bleu focus:ring-bleu"
                                >{{ $itineraire }}</textarea> --}}
                                <div id="itineraire-result" class=" w-full mx-auto ">
                                    
                                </div>
                            </div>
                            
                            {{-- <form method="POST" action="{{ route('sauvegarder') }}">
                                @csrf
                                <input type="hidden" name="itineraire" value="{{ $itineraire }}">
                                <input type="hidden" name="activites" value="{{ $activities }}">
                                <input type="hidden" name="lieu" value="{{$lieu}}">
                                <input type="hidden" name="nb_jours" value="{{$nb_jours}}">
                                <input type="hidden" name="nb_personnes" value="{{$nb_personnes}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="budget" value="{{$budget}}">
                                <button type="submit" class="bg-orange text-white font-display text-md px-10 py-2 mt-8 text-center hover:bg-orange_hover rounded hidden lg:inline">Sauvegarder l'itinéraire</button>
                            </form> --}}
                        {{-- @endisset --}}
                    </div>
                    
                    <div class="mt-8 lg:mt-0"> 
                        <h2 class="text-2xl font-medium text-gray-700 mb-10">Les incontournables : </h2>
                        {{-- @isset($activities) --}}
                        <div id="activities-result" class="w-full mx-auto border-gray-300">
                                    
                        </div>
                            {{-- <ul class="mb-12">
                                @php
                                    $activityList = preg_split('/\s(?=\d+\))/u', $activities);
                                @endphp
        
                                @foreach ($activityList as $activity)
                                    <li>{{ $activity }}</li><br>
                                @endforeach
                            </ul> --}}
                            {{-- <form method="POST" action="{{ route('sauvegarder') }}">
                                @csrf
                                <input type="hidden" name="itineraire" value="{{ $itineraire }}">
                                <input type="hidden" name="activites" value="{{ $activities }}">
                                <input type="hidden" name="lieu" value="{{$lieu}}">
                                <input type="hidden" name="nb_jours" value="{{$nb_jours}}">
                                <input type="hidden" name="nb_personnes" value="{{$nb_personnes}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <input type="hidden" name="budget" value="{{$budget}}">
                                <button type="submit" class="bg-orange text-white font-display text-md px-10 py-2 mt-8 text-center hover:bg-orange_hover rounded lg:hidden">Sauvegarder l'itinéraire</button>
                            </form> --}}
                            {{-- <a class="bg-orange text-white font-display text-md px-10 py-2 mt-8 text-center hover:bg-orange_hover rounded lg:hidden">Sauvegarder l'itinéraire</a> --}}
                        {{-- @endisset --}}
                    </div>
                    
                </section>

                <div id="save-itineraire-container">
                                
                </div>
            </div>
        </div>

    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#generation-form").on("submit", function (e) {
            e.preventDefault();

            console.log('formulaire envoyé');

            $('.loader').removeClass('hidden').addClass('flex');
    
            // Récupérer les données du formulaire
            var formData = $(this).serialize();
    
            // Effectuer l'appel Ajax
            $.ajax({
                type: "POST",
                url: "{{ route('generation.generate') }}", // L'URL de votre route de contrôleur
                data: formData,
                success: function (data) {
                    console.log('réussi' + data.itineraire);
                    // Mettre à jour la vue avec les données reçues
                    $("#itineraire-result").html(data.itineraire);

                    if (data.activities) {
                        var activityList = data.activities.split(/\s(?=\d+\))/);
                        var activitiesHtml = '<ul class="mb-12">';
                        
                        for (var i = 0; i < activityList.length; i++) {
                            activitiesHtml += '<li>' + activityList[i] + '</li><br>';
                        }
                        
                        activitiesHtml += '</ul>';
                        
                        $("#activities-result").html(activitiesHtml);
                    }

                    $('.loader').removeClass('flex').addClass('hidden');

                    $('.itineraire-container').addClass('lg:border-r').addClass(' border-bleu');
                   
                    var saveForm = `
                    <form id="save-itineraire-form" method="POST" action="{{ route('sauvegarder') }}">
                        @csrf
                        <input type="hidden" name="itineraire" value="${data.itineraire}">
                        <input type="hidden" name="activites" value="${data.activities}">
                        <input type="hidden" name="lieu" value="${data.lieu}">
                        <input type="hidden" name="nb_jours" value="${data.nb_jours}">
                        <input type="hidden" name="nb_personnes" value="${data.nb_personnes}">
                        <input type="hidden" name="type" value="${data.type}">
                        <input type="hidden" name="budget" value="${data.budget}">
                        <button type="submit" class="bg-orange text-white font-display text-md px-10 py-2 mt-8 text-center hover:bg-orange_hover rounded">Sauvegarder l'itinéraire</button>
                    </form>
                `;

                // Insérer le formulaire de sauvegarde dans le conteneur
                $("#save-itineraire-container").html(saveForm);

                },
                error: function (error) {
                    // Gérer les erreurs en cas de problème avec l'appel Ajax
                    console.log(error);
                    $('.loader').removeClass('flex').addClass('hidden');
                    $("#itineraire-result").html("Erreur lors de la génération de l'itineraire");
                    $("#activities-result").html("Aucune recommandation disponible");
                },
            });
        });
    });
    </script>
</x-app-layout>
@include('partials.footer')