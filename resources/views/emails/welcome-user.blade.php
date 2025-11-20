<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue sur BilanMPI</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f3f4f6;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            padding: 40px 30px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .header p {
            color: #e0e7ff;
            font-size: 16px;
        }

        .logo {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            margin: 0 auto 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo svg {
            width: 48px;
            height: 48px;
            color: white;
        }

        .content {
            padding: 40px 30px;
        }

        .greeting {
            font-size: 24px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 20px;
        }

        .text {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .info-box {
            background: linear-gradient(135deg, #eff6ff 0%, #e0e7ff 100%);
            border-left: 4px solid #3b82f6;
            padding: 25px;
            margin: 30px 0;
            border-radius: 8px;
        }

        .info-box h3 {
            color: #1e40af;
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .credential {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            padding: 12px;
            background: white;
            border-radius: 6px;
        }

        .credential-label {
            font-weight: 600;
            color: #374151;
            font-size: 14px;
        }

        .credential-value {
            font-family: 'Courier New', monospace;
            background: #f3f4f6;
            padding: 6px 12px;
            border-radius: 4px;
            color: #1f2937;
            font-size: 14px;
            font-weight: 600;
        }

        .button-container {
            text-align: center;
            margin: 35px 0;
        }

        .button {
            display: inline-block;
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            color: white;
            padding: 16px 40px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(37, 99, 235, 0.3);
            transition: all 0.3s ease;
        }

        .button:hover {
            box-shadow: 0 6px 12px rgba(37, 99, 235, 0.4);
            transform: translateY(-2px);
        }

        .warning-box {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 25px 0;
            border-radius: 8px;
        }

        .warning-box p {
            color: #92400e;
            font-size: 14px;
            margin: 0;
        }

        .warning-box strong {
            color: #78350f;
        }

        .features {
            margin: 30px 0;
        }

        .feature {
            display: flex;
            align-items: start;
            margin-bottom: 16px;
        }

        .feature-icon {
            width: 24px;
            height: 24px;
            background: linear-gradient(135deg, #2563eb 0%, #4f46e5 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .feature-icon::before {
            content: "✓";
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .feature-text {
            color: #4b5563;
            font-size: 15px;
            padding-top: 2px;
        }

        .footer {
            background: #f9fafb;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            color: #6b7280;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .footer-links {
            margin-top: 15px;
        }

        .footer-links a {
            color: #3b82f6;
            text-decoration: none;
            font-size: 13px;
            margin: 0 10px;
        }

        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e5e7eb, transparent);
            margin: 25px 0;
        }

        @media only screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }

            .header {
                padding: 30px 20px;
            }

            .greeting {
                font-size: 20px;
            }

            .credential {
                flex-direction: column;
                align-items: flex-start;
            }

            .credential-value {
                margin-top: 8px;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h1>BilanMPI</h1>
            <p>Australe Formation CFA - La Réunion</p>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="greeting">
                Bonjour {{ $user->name }} 👋
            </div>

            <p class="text">
                Nous sommes ravis de vous accueillir sur la plateforme <strong>BilanMPI</strong> d'Australe Formation CFA !
            </p>

            <p class="text">
                Votre compte a été créé avec succès. Vous pouvez dès maintenant accéder à la plateforme pour générer et gérer vos bilans MPI Phase 1.
            </p>

            <!-- Credentials Box -->
            <div class="info-box">
                <h3>🔐 Vos identifiants de connexion</h3>
                <div class="credential">
                    <span class="credential-label">Email</span>
                    <span class="credential-value">{{ $user->email }}</span>
                </div>
                <div class="credential">
                    <span class="credential-label">Mot de passe</span>
                    <span class="credential-value">{{ $password }}</span>
                </div>
            </div>

            <!-- Warning -->
            <div class="warning-box">
                <p>
                    <strong>⚠️ Important :</strong> Pour votre sécurité, veuillez changer votre mot de passe dès votre première connexion en accédant à votre profil.
                </p>
            </div>

            <!-- CTA Button -->
            <div class="button-container">
                <a href="{{ config('app.url') }}/login" class="button">
                    Se connecter à BilanMPI
                </a>
            </div>

            <div class="divider"></div>

            <!-- Features -->
            <div class="features">
                <h3 style="color: #1f2937; font-size: 18px; margin-bottom: 20px; font-weight: 600;">
                    Ce que vous pouvez faire :
                </h3>

                <div class="feature">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>Créer des bilans MPI</strong> avec l'assistance de l'intelligence artificielle
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>Gérer vos bilans</strong> : consultation, modification, suppression
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>Télécharger en PDF</strong> vos bilans pour transmission aux partenaires
                    </div>
                </div>

                <div class="feature">
                    <div class="feature-icon"></div>
                    <div class="feature-text">
                        <strong>Accéder à l'historique</strong> de tous vos bilans générés
                    </div>
                </div>
            </div>

            <div class="divider"></div>

            <p class="text">
                Si vous avez des questions ou besoin d'aide, n'hésitez pas à contacter l'équipe d'Australe Formation CFA.
            </p>

            <p class="text" style="margin-bottom: 0;">
                À très bientôt sur la plateforme ! 🚀
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Australe Formation CFA</strong></p>
            <p>Dispositif MPI - Mobilisation vers la Professionnalisation et l'Insertion</p>
            <p style="margin-top: 15px; color: #9ca3af; font-size: 12px;">
                Cet email a été envoyé automatiquement, merci de ne pas y répondre.
            </p>
            <div class="footer-links">
                <a href="{{ config('app.url') }}">Accéder à la plateforme</a>
                <span style="color: #d1d5db;">|</span>
                <a href="mailto:support@australeformation.re">Support</a>
            </div>
        </div>
    </div>
</body>
</html>
