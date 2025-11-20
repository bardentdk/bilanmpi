# Configuration du système de sécurité - BilanMPI

## Améliorations de sécurité implémentées

Ce projet a été sécurisé avec les améliorations critiques suivantes :

### ✅ Authentification requise
- Toutes les routes sont maintenant protégées par authentification
- Les utilisateurs doivent se connecter pour accéder aux bilans

### ✅ Système de rôles
- **Admin** : Peut voir TOUS les bilans, gérer les utilisateurs
- **User** : Peut voir uniquement SES bilans

### ✅ Email automatique
- Email de bienvenue envoyé automatiquement à chaque nouvel utilisateur
- Template professionnel avec identifiants de connexion
- Intégration Brevo (300 emails/jour gratuits)

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

#### A. Configuration Groq API

Copiez les variables Groq de `.env.example` vers votre `.env` :

```bash
# Configuration Groq API
GROQ_API_KEY=votre_clé_api_groq
GROQ_MODEL=llama-3.3-70b-versatile
```

**Important** : Obtenez votre clé API sur https://console.groq.com/keys

#### B. Configuration Email Brevo (pour les emails de bienvenue)

1. **Créez un compte gratuit sur Brevo** : https://www.brevo.com/fr/
2. **Obtenez vos identifiants SMTP** : https://app.brevo.com/settings/keys/smtp
3. **Configurez votre `.env`** :

```bash
MAIL_MAILER=smtp
MAIL_HOST=smtp-relay.brevo.com
MAIL_PORT=587
MAIL_USERNAME=votre_email_brevo
MAIL_PASSWORD=votre_clé_smtp_brevo
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@australeformation.re"
MAIL_FROM_NAME="Australe Formation CFA"
```

**💡 Astuce** : En développement local, utilisez `MAIL_MAILER=log` pour voir les emails dans les logs Laravel au lieu de les envoyer réellement.

**Note** : Brevo offre 300 emails/jour gratuitement, largement suffisant pour vos besoins.

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

## 📧 Système d'emails de bienvenue

### Fonctionnement automatique

Lorsqu'un administrateur crée un nouvel utilisateur :

1. **Un email de bienvenue est automatiquement envoyé** contenant :
   - Les identifiants de connexion (email + mot de passe)
   - Un lien direct vers la plateforme
   - Les fonctionnalités disponibles
   - Un rappel de changer le mot de passe

2. **Le template d'email** est professionnel et aux couleurs d'Australe Formation CFA

3. **Confirmation pour l'admin** : Un message de succès confirme l'envoi de l'email

### Aperçu de l'email

```
┌─────────────────────────────────────────┐
│  🎓 BilanMPI                            │
│  Australe Formation CFA                 │
├─────────────────────────────────────────┤
│  Bonjour [Nom] 👋                       │
│                                         │
│  Votre compte a été créé !              │
│                                         │
│  🔐 Vos identifiants :                  │
│  Email: user@example.com                │
│  Mot de passe: ********                 │
│                                         │
│  [Se connecter à BilanMPI]              │
│                                         │
│  ⚠️ Changez votre mot de passe dès      │
│     votre première connexion            │
└─────────────────────────────────────────┘
```

### Test en développement

Pour tester sans envoyer de vrais emails :

```bash
# Dans votre .env
MAIL_MAILER=log
```

Les emails seront visibles dans `storage/logs/laravel.log`

### Dépannage emails

**Les emails ne sont pas envoyés ?**
1. Vérifiez vos credentials Brevo dans `.env`
2. Vérifiez les logs : `tail -f storage/logs/laravel.log`
3. Testez l'envoi manuel :
```bash
php artisan tinker
Mail::raw('Test', fn($msg) => $msg->to('test@example.com')->subject('Test'));
```

**Emails en spam ?**
- Configurez SPF/DKIM dans Brevo
- Utilisez un domaine vérifié

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
- `app/Http/Controllers/UserController.php` - Ajout envoi email de bienvenue
- `routes/web.php` - Ajout middleware auth
- `resources/js/Layouts/AuthenticatedLayout.vue` - Ajout menu Gestion utilisateurs
- `.env.example` - Ajout configuration Brevo

### Fichiers créés
- `database/migrations/2025_11_20_051517_add_role_to_users_table.php`
- `database/migrations/2025_11_20_051518_add_user_id_and_soft_deletes_to_bilans_mpi_table.php`
- `app/Policies/BilanMPIPolicy.php`
- `app/Http/Controllers/UserController.php`
- `app/Mail/WelcomeUser.php`
- `database/seeders/AdminUserSeeder.php`
- `resources/js/Pages/Users/Index.vue`
- `resources/js/Pages/Users/Create.vue`
- `resources/js/Pages/Users/Edit.vue`
- `resources/views/emails/welcome-user.blade.php`

---

## 🛡️ Sécurité

Toutes les vulnérabilités critiques ont été corrigées :
- ✅ Authentification requise
- ✅ Autorisation par Policy
- ✅ Rate limiting sur l'API
- ✅ Soft deletes pour récupération
- ✅ Séparation des données par utilisateur

**Le projet est maintenant sécurisé et prêt pour la production !** 🚀
