<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        // Validation des entrées
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string', // La confirmation du mot de passe est une bonne pratique
        ]);

        // Récupération des entrées validées
        $input = $request->only('name', 'email', 'password');

        // Création de l'utilisateur
        User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'daily_reminder' => false, // Valeur par défaut
            'review_level' => 0, // Valeur par défaut
        ]);

        // Réponse en JSON
        return response()->json([
            'status' => true,
            'message' => "Registration Successful",
        ]);
    }
}
