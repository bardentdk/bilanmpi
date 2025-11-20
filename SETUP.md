# Configuration du système de sécurité - BilanMPI

## Améliorations de sécurité implémentées

Ce projet a été sécurisé avec les améliorations critiques suivantes :

### ✅ Authentification requise
- Toutes les routes sont maintenant protégées par authentification
- Les utilisateurs doivent se connecter pour accéder aux bilans

### ✅ Système de rôles
- **Admin** : Peut voir TOUS les bilans, gérer les utilisateurs
- **User** : Peut voir uniquement SES bilans

### ✅ Rate limiting
- Maximum 10 générations de bilans par heure par utilisateur
- Protection contre l'abus de l'API Groq

### ✅ Soft deletes
- Les bilans supprimés peuvent être restaurés
- Protection contre les suppressions accidentelles

---

## 📋 Instructions de mise à jour

### 1. Exécuter les migrations

```bash
php artisan migrate
```

Cette commande va créer les nouvelles colonnes :
- `role` dans la table `users`
- `user_id` et `deleted_at` dans la table `bilans_mpi`

### 2. Configurer les variables d'environnement

Copiez les nouvelles variables de `.env.example` vers votre `.env` :

```bash
# Configuration Groq API
GROQ_API_KEY=votre_clé_api_groq
GROQ_MODEL=llama-3.3-70b-versatile
```

**Important** : Obtenez votre clé API sur https://console.groq.com/keys

### 3. Créer le premier compte administrateur

```bash
php artisan db:seed --class=AdminUserSeeder
```

Ceci va créer un compte admin avec :
- **Email** : `admin@australeformation.re`
- **Mot de passe** : `password`

**⚠️ IMPORTANT** : Changez ce mot de passe immédiatement après la première connexion !

### 4. Connexion et gestion des utilisateurs

1. Connectez-vous avec le compte admin créé
2. Allez dans **Gestion utilisateurs** (visible dans le menu)
3. Créez de nouveaux utilisateurs (admin ou standard)

---

## 🔐 Rôles et permissions

### Administrateur (`admin`)
- ✅ Voir TOUS les bilans (de tous les utilisateurs)
- ✅ Créer/modifier/supprimer n'importe quel bilan
- ✅ Accéder à la gestion des utilisateurs
- ✅ Créer de nouveaux utilisateurs (admin ou standard)
- ✅ Modifier/supprimer des utilisateurs

### Utilisateur standard (`user`)
- ✅ Voir uniquement SES bilans
- ✅ Créer/modifier/supprimer SES bilans
- ❌ Pas d'accès à la gestion des utilisateurs
- ❌ Ne peut pas voir les bilans des autres utilisateurs

---

## 🚀 Migration des données existantes

Si vous avez des bilans existants dans votre base de données, ils n'ont pas de `user_id`. Vous devez :

**Option 1 : Assigner tous les anciens bilans à l'admin**
```bash
php artisan tinker
```
```php
BilanMPI::whereNull('user_id')->update(['user_id' => 1]);
```

**Option 2 : Créer un script de migration personnalisé**
Si vous voulez assigner les bilans à différents utilisateurs selon le CIP, créez un seeder custom.

---

## 📝 Utilisation quotidienne

### Pour les administrateurs
1. Connectez-vous
2. Vous verrez tous les bilans de tous les CIP
3. Vous pouvez créer des bilans
4. Menu "Gestion utilisateurs" pour gérer les comptes

### Pour les utilisateurs standard
1. Connectez-vous
2. Vous verrez uniquement vos bilans
3. Vous pouvez créer des bilans
4. Pas d'accès à la gestion des utilisateurs

---

## 🔧 Dépannage

### Erreur "Policy not found"
Si vous obtenez une erreur de Policy, exécutez :
```bash
php artisan optimize:clear
php artisan config:cache
```

### Les migrations échouent
Si la migration échoue car la colonne existe déjà :
```bash
php artisan migrate:rollback --step=2
php artisan migrate
```

### Réinitialiser les rôles
Pour changer le rôle d'un utilisateur :
```bash
php artisan tinker
```
```php
$user = User::where('email', 'email@example.com')->first();
$user->role = 'admin'; // ou 'user'
$user->save();
```

---

## 📊 Résumé des modifications

### Fichiers modifiés
- `app/Models/User.php` - Ajout du système de rôles
- `app/Models/BilanMPI.php` - Ajout relation user et soft deletes
- `app/Http/Controllers/BilanMPIController.php` - Ajout autorisations
- `routes/web.php` - Ajout middleware auth et rate limiting
- `resources/js/Layouts/AuthenticatedLayout.vue` - Ajout menu Gestion utilisateurs

### Fichiers créés
- `database/migrations/2025_11_20_051517_add_role_to_users_table.php`
- `database/migrations/2025_11_20_051518_add_user_id_and_soft_deletes_to_bilans_mpi_table.php`
- `app/Policies/BilanMPIPolicy.php`
- `app/Http/Controllers/UserController.php`
- `database/seeders/AdminUserSeeder.php`
- `resources/js/Pages/Users/Index.vue`
- `resources/js/Pages/Users/Create.vue`
- `resources/js/Pages/Users/Edit.vue`

---

## 🛡️ Sécurité

Toutes les vulnérabilités critiques ont été corrigées :
- ✅ Authentification requise
- ✅ Autorisation par Policy
- ✅ Rate limiting sur l'API
- ✅ Soft deletes pour récupération
- ✅ Séparation des données par utilisateur

**Le projet est maintenant sécurisé et prêt pour la production !** 🚀
