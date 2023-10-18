<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use OpenAI;
use App\Http\Requests\ItineraireRequest;

class GenerationController extends Controller
{
    public function generate(ItineraireRequest $request)
    {

        $openAIClient = OpenAI::client(config('openai.api-key'));
        $itineraireContent = $request->input('content');
        $nb_personnes = $request->input('number');
        $nb_jours = $request->input('days');
        $budget = $request->input('budget');
        $type = $request->input('type');


        $itineraire = $openAIClient->chat()->create([
            "model" => "gpt-3.5-turbo",
            "messages" => [[
                'role' => "user",
                'content' => "Agis en tant qu'agence de voyage, écris une suggestion d'itinéraire pour {$nb_jours} jours et pour {$nb_personnes} personnes dans ce lieu : {$itineraireContent}, le type de voyage est : {$type} et pour un budget d'environ : {$budget}€. Attention, si tu ne connais pas ce lieu, préviens moi et ne propose pas d'itinéraire.",
            ]],
            "max_tokens" => 1000, 
        ]);


        $activities = $openAIClient->chat()->create([
            "model" => "gpt-3.5-turbo",
            "messages" => [[
                'role' => "user",
                'content' => "Génère sous forme de liste numérotée ( 1)xxxx 2)xxxx 3)xxxx ) 10 adresses à conseiller comme des restaurants , bars , hotels, activités et endroits insolite dans ce lieu : {$itineraireContent}.",
            ]],
        ]);

    
        // return view('dashboard', [
        //     'itineraire' => trim($itineraire['choices'][0]['message']['content']),
        //     'activities' => trim($activities['choices'][0]['message']['content']),
        //     'lieu' => $itineraireContent,
        //     'nb_personnes' => $nb_personnes,
        //     'nb_jours' => $nb_jours,
        //     'type' => $type,
        //     'budget' =>$budget,
        // ]);

        $data = [
            'itineraire' => trim($itineraire['choices'][0]['message']['content']),
            'activities' => trim($activities['choices'][0]['message']['content']),
            'lieu' => $itineraireContent,
            'nb_personnes' => $nb_personnes,
            'nb_jours' => $nb_jours,
            'type' => $type,
            'budget' => $budget,
        ];


        return response()->json($data);

    }
}
