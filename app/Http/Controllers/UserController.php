<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Afficher la liste des utilisateurs (Admin uniquement)
     */
    public function index()
    {
        // Vérifier que l'utilisateur est admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return Inertia::render('Users/Index', [
            'users' => $users
        ]);
    }

    /**
     * Afficher le formulaire de création d'utilisateur (Admin uniquement)
     */
    public function create()
    {
        // Vérifier que l'utilisateur est admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        return Inertia::render('Users/Create');
    }

    /**
     * Créer un nouvel utilisateur (Admin uniquement)
     */
    public function store(Request $request)
    {
        // Vérifier que l'utilisateur est admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:admin,user',
        ]);

        try {
            // Garder le mot de passe en clair pour l'email
            $plainPassword = $validated['password'];

            // Créer l'utilisateur
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($plainPassword),
                'role' => $validated['role'],
            ]);

            // Envoyer l'email de bienvenue
            Mail::to($user->email)->send(new WelcomeUser($user, $plainPassword));

            return redirect()->route('users.index')
                ->with('success', 'Utilisateur créé avec succès ! Un email de bienvenue a été envoyé.');

        } catch (\Exception $e) {
            return back()->withErrors([
                'error' => 'Erreur lors de la création de l\'utilisateur : ' . $e->getMessage()
            ])->withInput();
        }
    }

    /**
     * Afficher le formulaire d'édition d'un utilisateur (Admin uniquement)
     */
    public function edit(User $user)
    {
        // Vérifier que l'utilisateur est admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        return Inertia::render('Users/Edit', [
            'user' => $user
        ]);
    }

    /**
     * Mettre à jour un utilisateur (Admin uniquement)
     */
    public function update(Request $request, User $user)
    {
        // Vérifier que l'utilisateur est admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];

        // Mettre à jour le mot de passe uniquement s'il est fourni
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur modifié avec succès !');
    }

    /**
     * Supprimer un utilisateur (Admin uniquement)
     */
    public function destroy(User $user)
    {
        // Vérifier que l'utilisateur est admin
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Accès non autorisé');
        }

        // Empêcher un admin de se supprimer lui-même
        if ($user->id === auth()->id()) {
            return back()->withErrors([
                'error' => 'Vous ne pouvez pas supprimer votre propre compte.'
            ]);
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Utilisateur supprimé avec succès !');
    }
}
