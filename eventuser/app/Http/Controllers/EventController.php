<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct() {
        // Sécuriser toutes les routes avec authentification
        $this->middleware('auth');
    }

    public function getEvent() {
        $event = Event::all();
        return view('liste-event', ['data' => $event]);
    }

    public function deleteEvent($id) {
        $event = Event::findOrFail($id);
        $eventName = $event->titre;

        // Suppression de l'image si elle existe
        if ($event->image && Storage::exists('public/'.$event->image)) {
            Storage::delete('public/'.$event->image);
        }

        $event->delete();

        return redirect('/liste-event')
               ->with('deleted_message', 'L\'événement "'.$eventName.'" est supprimé')
               ->with('alert_class', 'alert-danger');
    }

    public function getEventId($id) {
        $event = Event::find($id);
        return view('update-event', ['data' => $event]);
    }

    public function UpdateEvent(Request $req) {
        $event = Event::find($req->id);
        $event->titre = $req->titre;
        $event->categorie = $req->categorie;
        $event->location = $req->location;
        $event->description = $req->description;
        $event->Cree_par =$req->Cree_par;
        // Optionnel : Gérer l'image lors de la mise à jour (à améliorer si besoin)
        if ($req->hasFile('image')) {
            $imageName = 'event_'.time().'.'.$req->image->extension();
            $req->image->move(public_path('images/events'), $imageName);
            $event->image = $imageName;
        }

        $event->date_debut = $req->date_debut;
        $event->date_fin = $req->date_fin;

        // Ne pas modifier Cree_par ici
        $event->save();

        return redirect('/liste-event')->with('message', 'Événement modifié');
    }

    public function AddEvent(Request $req) {
        $event = new Event;
        $event->titre = $req->titre;
        $event->categorie = $req->categorie;
        $event->location = $req->location;
        $event->description = $req->description;


        $event->Cree_par =$req->Cree_par;

        // Gestion de l'image
        if ($req->hasFile('image')) {
            $imageName = 'event_'.time().'.'.$req->image->extension();
            $req->image->move(public_path('images/events'), $imageName);
            $event->image = $imageName;
        }

        $event->date_debut = $req->date_debut;
        $event->date_fin = $req->date_fin;
        $event->save();

        return redirect('/liste-event')->with('success', 'Événement ajouté');
    }

    public function showCalendar() {
        $events = Event::select(
                    'id',
                    'titre as title',
                    'date_debut as start',
                    'date_fin as end',
                    'description',
                    'location',
                    'categorie'
                )
                ->whereNotNull('date_debut')
                ->get()
                ->map(function ($event) {
                    return [
                        'id' => $event->id,
                        'title' => $event->title,
                        'start' => $event->start,
                        'end' => $event->end,
                        'color' => $this->getCategoryColor($event->categorie),
                        'extendedProps' => [
                            'description' => $event->description,
                            'location' => $event->location
                        ]
                    ];
                });

        return view('calendar', compact('events'));
    }

    private function getCategoryColor($category) {
        $colors = [
            'conférence' => '#4361ee',
            'atelier' => '#38b000',
            'webinaire' => '#4cc9f0',
            'default' => '#ff9e00'
        ];
        return $colors[strtolower($category)] ?? $colors['default'];
    }
    public function inscrire($id)
{
    $event = Event::findOrFail($id);
    $user = auth()->user();

    // Option 1 : avec contains()
    if (!$user->events->contains($event->id)) {
        $user->events()->attach($event->id);
    }

    // Option 2 : plus simple (évite les doublons)
    // $user->events()->syncWithoutDetaching([$event->id]);

    return redirect()->route('events.list')->with('success', 'Vous êtes inscrit à l\'événement : ' . $event->titre);
}

public function listeInscriptions()
{
    $user = auth()->user(); // Utilisateur connecté
    $events = $user->events; // Récupère les événements auxquels il est inscrit

    return view('liste-evenementinscrit', compact('events'));
}

public function gererMesEvents() {
    // Récupère le nom de l'utilisateur connecté
    $userName = Auth::user()->name;

    // Filtrer les événements où le champ 'Cree_par' correspond au nom de l'utilisateur connecté
    $events = Event::where('Cree_par', $userName)->get();

    // Passe les événements filtrés à la vue
    return view('gerer-event', ['data' => $events]);
}

}
