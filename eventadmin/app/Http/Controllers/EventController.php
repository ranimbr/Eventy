<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getEvent()
    {
        $events = Event::all();
        return view('liste-event', ['data' => $events]);
    }

    public function deleteEvent($id)
    {
        $event = Event::findOrFail($id);
        $eventName = $event->titre;

        // Suppression de l'image associée
        if ($event->image && Storage::exists('public/' . $event->image)) {
            Storage::delete('public/' . $event->image);
        }

        $event->delete();

        return redirect('/liste-event')
            ->with('deleted_message', 'L\'événement "' . $eventName . '" est supprimé')
            ->with('alert_class', 'alert-danger');
    }

    public function getEventId($id)
    {
        $event = Event::findOrFail($id);
        return view('update-event', ['data' => $event]);
    }

    public function UpdateEvent(Request $req)
    {
        $event = Event::findOrFail($req->id);

        $event->titre = $req->titre;
        $event->categorie = $req->categorie;
        $event->location = $req->location;
        $event->description = $req->description;
        $event->Cree_par = $req->Cree_par;
        $event->date_debut = $req->date_debut;
        $event->date_fin = $req->date_fin;

        // Gestion de l'image si nouvelle image
        if ($req->hasFile('image')) {
            $imageName = 'event_' . time() . '.' . $req->image->extension();
            $req->image->move(public_path('images/events'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return redirect('/liste-event')->with('message', 'Événement modifié');
    }

    public function AddEvent(Request $req)
    {
        $event = new Event;

        $event->titre = $req->titre;
        $event->categorie = $req->categorie;
        $event->location = $req->location;
        $event->description = $req->description;
        $event->Cree_par = $req->Cree_par;
        $event->date_debut = $req->date_debut;
        $event->date_fin = $req->date_fin;

        // Gestion de l'image
        if ($req->hasFile('image')) {
            $imageName = 'event_' . time() . '.' . $req->image->extension();
            $req->image->move(public_path('images/events'), $imageName);
            $event->image = $imageName;
        }

        $event->save();

        return redirect('/liste-event')->with('success', 'Événement ajouté');
    }

    public function showCalendar()
    {
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

    private function getCategoryColor($category)
    {
        $colors = [
            'conférence' => '#4361ee',
            'atelier' => '#38b000',
            'webinaire' => '#4cc9f0',
            'default' => '#ff9e00'
        ];

        return $colors[strtolower($category)] ?? $colors['default'];
    }

    
}
