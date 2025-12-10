<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\Storage;

class UtilisateurController extends Controller
{
    public function getUser()
    {
        $utilisateur = Utilisateur::all();
        return view('liste-user', ['data' => $utilisateur]);
    }

    public function deleteUser($id)
    {
        $utilisateur = Utilisateur::find($id);
        $utilisateurName = $utilisateur->nom . ' ' . $utilisateur->prenom;
        $utilisateur->delete();

        return redirect('/liste-user')
               ->with('deleted_message', 'L\'utilisateur "'.$utilisateurName.'" est supprimé')
               ->with('alert_class', 'alert-danger');
    }

    public function addUser(Request $req)
    {
        $utilisateur = new Utilisateur;
        $utilisateur->nom = $req->nom;
        $utilisateur->prenom = $req->prenom;
        $utilisateur->statut = $req->statut;

        if($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('images/utilisateurs'), $imageName);
            $utilisateur->image = $imageName;
        }

        $utilisateur->save();

        return redirect('/liste-user')->with('success', 'Utilisateur bien ajouté');
    }

    public function getUserId($id){
        $utilisateur=Utilisateur::find($id);
        return view('update-user', ['data'=>$utilisateur]);
    }
    public function updateUser(Request $req)
    {
        $utilisateur = Utilisateur::findOrFail($req->id);
        $utilisateur->nom = $req->nom;
        $utilisateur->prenom = $req->prenom;

        $utilisateur->statut = $req->statut;

        $utilisateur->save();

        return redirect('/liste-user')
               ->with('success', 'Utilisateur mis à jour avec succès');
    }
    public function toggleBlock($id)
{
    $utilisateur = Utilisateur::findOrFail($id);
    $utilisateur->bloque = !$utilisateur->bloque;
    $utilisateur->save();

    return redirect()->back()->with('success', $utilisateur->bloque ? 'Utilisateur bloqué.' : 'Utilisateur débloqué.');
}

}
