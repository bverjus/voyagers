<x-app-layout>
    <x-slot name="header"></x-slot>

    
    <h1 class="text-center text-2xl lg:text-3xl font-display font-bold text-bleu mt-12 mb-10 xl:mb-20 w-[80%] mx-auto">Mes itinéraires de voyage  </h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10 w-[90%] mx-auto pb-10">
        <div class="w-full h-48 border-2 border-orange rounded-3xl flex flex-col items-center justify-center relative hover:scale-105 ease-in-out duration-500">
            <a href="{{route('dashboard')}}" class="absolute top-0 left-0 w-full h-full z-20"></a>
            <svg xmlns="http://www.w3.org/2000/svg" height="60" viewBox="0 -960 960 960" width="60" fill="#0F1248"><path d="M440-440H200v-80h240v-240h80v240h240v80H520v240h-80v-240Z"/></svg>
            <p class="text-xl text-bleu font-display">Ajouter un nouvel itinéraire</p>
        </div>

        @foreach ($voyages as $voyage )
        <div class="w-full h-48 border-2 border-orange  rounded-3xl relative hover:scale-105 ease-in-out duration-500">
            <a href="{{route('itineraire.show', ['id' => $voyage->id])}}" class="absolute top-0 left-0 w-full h-full z-20"></a>
            <h2 class="text-xl text-bleu font-display text-center my-4">Voyage à  <span class="font-medium">{{ $voyage->lieu }}<span></h2>
            <ul class="ml-[10%] space-y-1 text-bleu font-display bg-bleu-opacity">
                <li>Type : <span class="font-medium">{{ $voyage->type }}</span></li>
                <li>Nombre de personnes : <span class="font-medium">{{ $voyage->nombre_personnes }}</span></li>
                <li>Nombres de jours : <span class="font-medium">{{ $voyage->nombre_jours }}</span></li>
                <li>Budget : <span class="font-medium">{{ $voyage->budget }}€</span></li>
            </ul>
        </div>
        @endforeach

    </div>

</x-app-layout>
@include('partials.footer')