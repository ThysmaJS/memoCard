<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function check(Request $request)
    {
        // Validation des entrées
        $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
        ]);

        // Tentative de connexion
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            // Authentification réussie, récupération de l'utilisateur authentifié
            $user = Auth::user();

            // Réponse en JSON
            return response()->json([
                'status' => true,
                'message' => "Login Successful",
                'user' => $user,
            ]);
        }

        // Authentification échouée
        return response()->json([
            'status' => false,
            'message' => "Invalid Email or Password",
        ], 401);
    }
}
