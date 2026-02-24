<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bilan MPI Phase 1 - {{ $bilan->nom_complet }}</title>
    <style>
        @page {
            margin: 12mm 12mm 25mm 12mm;
        }
        
        body {
            font-family: 'DejaVu Sans', 'Arial', sans-serif;
            font-size: 9pt;
            line-height: 1.3;
            color: #000000;
            padding-bottom: 20mm;
        }
        
        /* En-tête fixe */
        .header-box {
            border: 2px solid #000000;
            margin-bottom: 8px;
            overflow: hidden;
        }
        
        .header-content {
            display: table;
            width: 100%;
        }
        
        .header-left {
            display: table-cell;
            width: 50%;
            padding: 6px 8px;
            vertical-align: middle;
            border-right: 1px solid #000000;
        }
        
        .header-right {
            display: table-cell;
            width: 50%;
            padding: 6px 8px;
            vertical-align: middle;
            text-align: right;
        }
        
        .header-left .org-name {
            font-weight: bold;
            font-size: 10pt;
            margin-bottom: 1px;
        }
        
        .header-left .address {
            font-size: 8pt;
            line-height: 1.2;
        }
        
        .header-right .logo-placeholder {
            display: inline-block;
            width: 100px;
            height: 35px;
            background: #f0f0f0;
            border: 1px solid #cccccc;
            text-align: center;
            line-height: 35px;
            font-size: 7pt;
            color: #666666;
            margin: 2px;
        }
        
        /* Titre principal */
        .main-title {
            text-align: center;
            margin: 8px 0 3px 0;
        }
        
        .main-title h1 {
            font-size: 13pt;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        
        .subtitle {
            text-align: center;
            font-size: 8pt;
            margin-bottom: 8px;
        }
        
        /* Informations de formation */
        .formation-info {
            margin-bottom: 8px;
            font-size: 8pt;
            line-height: 1.3;
        }
        
        .formation-info .info-label {
            font-weight: bold;
        }
        
        .formation-info ul {
            margin: 1px 0 1px 15px;
            padding: 0;
        }
        
        .formation-info li {
            margin: 1px 0;
        }
        
        /* Encadré gris pour le nom */
        .nom-box {
            background-color: #E8E8E8;
            padding: 5px 8px;
            margin-bottom: 8px;
            font-weight: bold;
            font-size: 9pt;
        }
        
        /* Questions et réponses */
        .question-block {
            margin-bottom: 8px;
            page-break-inside: avoid;
        }
        
        .question-title {
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 2px;
            text-decoration: underline;
        }
        
        .question-content {
            font-size: 8pt;
            text-align: justify;
            line-height: 1.3;
            margin: 0;
        }
        
        /* Modules */
        .module-block {
            margin-bottom: 6px;
            page-break-inside: avoid;
        }
        
        .module-title {
            font-weight: bold;
            font-size: 8pt;
            margin-bottom: 2px;
        }
        
        .module-content {
            font-size: 8pt;
            text-align: justify;
            line-height: 1.3;
            margin: 0;
        }
        
        /* Tableau d'impact */
        .impact-table {
            width: 100%;
            border-collapse: collapse;
            margin: 6px 0;
            font-size: 7pt;
        }
        
        .impact-table th {
            background-color: #E8E8E8;
            border: 1px solid #000000;
            padding: 3px;
            text-align: center;
            font-weight: bold;
        }
        
        .impact-table td {
            border: 1px solid #000000;
            padding: 3px;
            text-align: left;
        }
        
        .impact-table .checkbox-cell {
            text-align: center;
            width: 15%;
        }
        
        /* Footer professionnel - FIXE EN BAS */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            height: 18mm;
            background-color: white;
            border-top: 0.5pt solid #CCCCCC;
            z-index: 1000;
        }
        
        .footer-content {
            text-align: center;
            font-size: 6pt;
            color: #666666;
            line-height: 1.3;
            padding-top: 2mm;
        }
        
        .footer-content .footer-line {
            margin: 0.5mm 0;
        }
        
        .page-number {
            position: absolute;
            bottom: 2mm;
            right: 12mm;
            font-size: 7pt;
            color: #666666;
        }
        
        .page-number:after {
            /* content: "Page " counter(page) " / 4"; */
            content: "Page " counter(page);
        }
        
        /* Séparateur de ligne */
        hr {
            border: none;
            border-top: 1px solid #000000;
            margin: 2px 0;
        }
    </style>
</head>
<body>
    <!-- Footer automatique sur toutes les pages -->
    <div class="footer">
        <div class="footer-content">
            <div class="footer-line">CAB EXPERT - AUSTRALE FORMATION | 68 rue TESSAN SAINTE-CLOTILDE 97490 | Numéro SIRET: 91021832000026 | N° TVA: FR18910218320 |</div>
            <div class="footer-line">Numéro de déclaration d'activité: 04973564797 (RÉUNION)</div>
            <div class="footer-line">Cet enregistrement ne vaut pas l'agrément de l'État</div>
        </div>
        <div class="page-number"></div>
    </div>

    <!-- PAGE 1 -->
    <div class="header-box">
        <div class="header-content">
            <div class="header-left">
                <div class="org-name">AUSTRALE FORMATION</div>
                <div class="address">
                    68 rue TESSAN<br>
                    97490<br>
                    SAINTE-CLOTILDE<br>
                    Email : formacabex@gmail.com<br>
                    Tel : +262693831032
                </div>
            </div>
            <div class="header-right">
                <img src="{{ public_path('images/logo-region-reunion.png') }}" style="height: 120px; margin-bottom: 5px;" alt="Région Réunion">
            </div>
        </div>
    </div>

    <div class="main-title">
        <h1>MPI - PHASE 1 - BILAN DE FORMATION</h1>
    </div>
    <div class="subtitle">Questionnaire pour managers</div>

    <div class="formation-info">
        <div><span class="info-label">Action de formation :</span> MPI-{{ $bilan->bilan_genere['Nom de l\'apprenant'] }}</div>
        <div><span class="info-label">Lieu de la formation :</span> Australe Formation - Sainte-Clotilde</div>
        <div><span class="info-label">Date du dispositif phase 1 :</span> du 16/10/2023 au 30/11/2025</div>
        <div><span class="info-label">Formateur(s) :</span></div>
        <ul>
            <li>{{ $bilan->bilan_genere['Formateurs'] }}</li>
        </ul>
    </div>

    <div class="nom-box">
        Nom : {{ $bilan->bilan_genere['Nom de l\'apprenant'] }}
    </div>

    <div class="question-block">
        <div class="question-title">
            Décrivez le parcours mis en place - les objectifs, les évolutions / adaptations et résultats, jusqu'à la fin de la Phase 1
        </div>
        <hr>
        <div class="question-content">
            {{ $bilan->bilan_genere['Parcours'] }}
        </div>
    </div>

    <div class="question-block">
        <div class="question-title">
            Décrivez les conditions de déroulement pédagogique de la Phase 1
        </div>
        <hr>
        <div class="question-content">
            {{ $bilan->bilan_genere['Conditions'] }}
        </div>
    </div>

    <!-- PAGE 2 -->
    <div style="page-break-before: always;"></div>

    <div class="header-box">
        <div class="header-content">
            <div class="header-left">
                <div class="org-name">AUSTRALE FORMATION</div>
                <div class="address">
                    68 rue TESSAN<br>
                    97490<br>
                    SAINTE-CLOTILDE<br>
                    Email : formacabex@gmail.com<br>
                    Tel : +262693831032
                </div>
            </div>
            <div class="header-right">
                <img src="{{ public_path('images/logo-region-reunion.png') }}" style="height: 120px; margin-bottom: 5px;" alt="Région Réunion">
            </div>
        </div>
    </div>

    <div class="question-block">
        <div class="question-title">
            Décrivez et Expliquez les méthodes pédagogiques mises en œuvre et leur part d'innovation
        </div>
        <hr>
        <div class="question-content">
            {{ $bilan->bilan_genere['Méthodes'] }}
        </div>
    </div>

    @php
        $allModuleTitles = [
            'Module 1' => 'MODULE 1 - Estime de soi et confiance en soi / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 2' => 'MODULE 2 - Exprimer ses rêves et ses ambitions par le Dessin / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 3' => 'MODULE 3 - Interculturalité / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 4' => 'MODULE 4 - Se Libérer de ses addictions / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 5' => 'MODULE 5 - Accompagnement Personnalisé Handicap / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 6' => 'MODULE 6 - Apprentissage du Français, de la lecture et de l\'écriture / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 7' => 'MODULE 7 - Remise à Niveau Numérique / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 8' => 'MODULE 8 - Apprendre la posture professionnelle et s\'apprêter pour celle-ci/ Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 9' => 'MODULE 9 - CLEA / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 10' => 'MODULE 10 - CLEA Numérique / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 11' => 'MODULE 11 - Lever ses freins liés à la Mobilité / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 12' => 'MODULE 12 - Accompagnement personnalisé à l\'Insertion Socio-Pro / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
            'Module 13' => 'MODULE 13 - Accompagnement à la recherche d\'une entreprise ou d\'un CFA + Stage / Degré d\'atteinte des objectifs prévus dans le projet d\'action',
        ];
    @endphp

    @foreach($allModuleTitles as $moduleKey => $moduleTitle)
        @php
            $moduleContent = $bilan->bilan_genere[$moduleKey] ?? null;
        @endphp
        
        @if($moduleContent && $moduleContent !== 'Non renseigné')
            <div class="module-block">
                <div class="module-title">{{ $moduleTitle }}</div>
                <hr>
                <div class="module-content">{{ $moduleContent }}</div>
            </div>
        @endif
    @endforeach

    <!-- PAGE 3 (automatique si débordement) -->
    <div style="page-break-before: always;"></div>

    <div class="header-box">
        <div class="header-content">
            <div class="header-left">
                <div class="org-name">AUSTRALE FORMATION</div>
                <div class="address">
                    68 rue TESSAN<br>
                    97490<br>
                    SAINTE-CLOTILDE<br>
                    Email : formacabex@gmail.com<br>
                    Tel : +262693831032
                </div>
            </div>
            <div class="header-right">
                <img src="{{ public_path('images/logo-region-reunion.png') }}" style="height: 120px; margin-bottom: 5px;" alt="Région Réunion">
            </div>
        </div>
    </div>

    <!-- Remplacer le tableau d'impact existant par celui-ci -->

    <div class="question-block" style="margin-top: 8px;">
        <div class="question-title">Impact de la formation sur l'apprenant</div>
        <table class="impact-table">
            <thead>
                <tr>
                    <th style="width: 40%; text-align: left;">Cochez une case par ligne</th>
                    <th class="checkbox-cell">Pas du tout</th>
                    <th class="checkbox-cell">Moyennement</th>
                    <th class="checkbox-cell">Beaucoup</th>
                    <th class="checkbox-cell">Au-delà des attentes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ce dispositif a t-il accru son efficacité ?</td>
                    <td class="checkbox-cell">{{ $bilan->impact_efficacite === 'pas_du_tout' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_efficacite === 'moyennement' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_efficacite === 'beaucoup' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_efficacite === 'au_dela' ? '✓' : '' }}</td>
                </tr>
                <tr>
                    <td>Ce dispositif a t-il accru sa valeur sur le marché du travail (interne ou externe) ?</td>
                    <td class="checkbox-cell">{{ $bilan->impact_marche_travail === 'pas_du_tout' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_marche_travail === 'moyennement' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_marche_travail === 'beaucoup' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_marche_travail === 'au_dela' ? '✓' : '' }}</td>
                </tr>
                <tr>
                    <td>Ce dispositif a-t-il permis une meilleure insertion sociale ?</td>
                    <td class="checkbox-cell">{{ $bilan->impact_insertion_sociale === 'pas_du_tout' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_insertion_sociale === 'moyennement' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_insertion_sociale === 'beaucoup' ? '✓' : '' }}</td>
                    <td class="checkbox-cell">{{ $bilan->impact_insertion_sociale === 'au_dela' ? '✓' : '' }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="question-block">
        <div class="question-title">
            L'apprenant a-t-il arrêté la phase 1 avant l'atteinte des 300 heures ? Si oui en précisez les raisons
        </div>
        <hr>
        <div class="question-content">
            {{ $bilan->bilan_genere['Arrêt'] }}
        </div>
    </div>

    <!-- PAGE 4 -->
    <div style="page-break-before: always;"></div>

    <div class="header-box">
        <div class="header-content">
            <div class="header-left">
                <div class="org-name">AUSTRALE FORMATION</div>
                <div class="address">
                    68 rue TESSAN<br>
                    97490<br>
                    SAINTE-CLOTILDE<br>
                    Email : formacabex@gmail.com<br>
                    Tel : +262693831032
                </div>
            </div>
            <div class="header-right">
                <img src="{{ public_path('images/logo-region-reunion.png') }}" style="height: 120px; margin-bottom: 5px;" alt="Région Réunion">
            </div>
        </div>
    </div>

    <div class="question-block" style="margin-bottom:40px;">
        <div class="question-title">
            L'apprenant est-il allé jusqu'au bout des 300 heures . Si oui, précisez ce qu'il a décidé de faire à l'issue de la phase 1 du Dispositif MPI
        </div>
        <hr>
        <div class="question-content">
            <!-- L'apprenant est bien allé au bout de ses 300 heures. Il a continué sa phase 2 au sein d'Australe Formation. -->
        </div>
    </div>

    <div class="question-block">
        <div class="question-title">Autres remarques</div>
        <hr>
        <div class="question-content">
            <!-- Document généré automatiquement le {{ $bilan->created_at->format('d/m/Y à H:i') }} -->
        </div>
    </div>

</body>
</html>