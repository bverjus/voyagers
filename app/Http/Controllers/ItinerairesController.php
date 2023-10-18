<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voyage;
use App\Http\Requests\ItineraireRequest;
use Illuminate\Support\Facades\Auth;

use Dompdf\Dompdf;
use Dompdf\Options;


class ItinerairesController extends Controller
{

    public function index()
    {
            
        $user = Auth::user();

        $voyages = Voyage::where('user_id', $user->id)->get();

        return view('itineraires', compact('voyages'));
    }

    public function sauvegarderItineraire(Request $request)
    {
        // Récupère l'itinéraire et les activités depuis la requête
        $itineraire = $request->input('itineraire');
        $activites = $request->input('activites');
        $lieu = $request->input('lieu');
        $nb_jours = $request->input('nb_jours');
        $nb_personnes = $request->input('nb_personnes');
        $type = $request->input('type');
        $budget = $request->input('budget');

        // Sauvegarde dans la base de données
        $voyage = new Voyage();
        $voyage->itineraires = $itineraire;
        $voyage->recommandation = $activites;
        $voyage->type = $type;
        $voyage->lieu = $lieu;  
        $voyage->nombre_jours = $nb_jours;
        $voyage->nombre_personnes = $nb_personnes;
        $voyage->budget = $budget;
        $voyage->user_id = auth()->id(); // Associe le voyage à l'utilisateur connecté
        $voyage->save();

        
        return redirect()->route('itineraires.index')->with('success', 'Itinéraire sauvegardé avec succès !');
    }

    public function show($id)
    {
        
        $itineraire = Voyage::find($id);

        if (!$itineraire) {
            return redirect()->route('itineraires.index');
        }

        
        return view('itineraire', ['itineraire' => $itineraire]);
    }

    public function destroy($id)
    {
        
        $itineraire = Voyage::find($id);

        
        if (!$itineraire) {
            return redirect()->back()->with('error', 'Le voyage n\'existe pas.');
        }

        
        $itineraire->delete();

        return redirect()->route('itineraires.index')->with('success', 'Le voyage a été supprimé avec succès.');
    }

    public function update(Request $request, $id)
    {

        $itineraire = Voyage::find($id);

        $itineraire_updated = $request->input('itineraire');
        $activites_updated = $request->input('activites');

        if($itineraire_updated != null){
            $itineraire->itineraires = $itineraire_updated;
        }

        if($activites_updated != null){
            $itineraire->recommandation = $activites_updated;
        }
      
        $itineraire->save();

        return redirect()->route('itineraire.show', ['id' => $id])->with('success', 'Itinéraire mis à jour avec succès.');
    }

    public function generatePDF($id)
    {
        
        $itineraire = Voyage::find($id);

        
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new  Dompdf($options);

        // Contenu HTML du PDF
        $html = '<html><head>';
        $html .= '<style>';
        $html .= '.title { font-size: 48px; color: #0F1248; font-weight: bold; text-align: center;}';
        $html .= 'body { max-width: 90%; margin: auto; }';
        $html .= '.activity { margin-top: 50px; }';
        $html .= '</style>';
        $html .= '</head><body>';
        $html .= "<h1 class='title'>Voyager's Guide</h1>";
        $html .= '<h2>Itinéraire pour ' . $itineraire->lieu . '</h2>';
        $html .= '<p>' . nl2br($itineraire->itineraires) . '</p>';
        $html .= '<h2 class="activity">Les activités recommandées :</h2>';
        $activityList = preg_split('/\s(?=\d+\))/u', $itineraire->recommandation);
        foreach ($activityList as $activity) {
            $html .= '<p>' . $activity . '</p>';
        }
        $html .= '</body></html>';

        
        $dompdf->loadHtml($html);

        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        // Affichez le PDF dans un nouvel onglet du navigateur
        $dompdf->stream();
        return redirect()->route('itineraire.show', ['id' => $id])->with('success', 'PDF généré avec succès.');
    }
}
