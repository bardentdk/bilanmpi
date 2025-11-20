<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bilan MPI Phase 1 - {{ $bilan->nom_complet }}</title>
    <style>
        @page {
            margin: 20mm 15mm;
        }
        
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10pt;
            line-height: 1.5;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 4px solid #4F46E5;
        }
        
        .header h1 {
            color: #4F46E5;
            margin: 0 0 5px 0;
            font-size: 22pt;
            font-weight: bold;
        }
        
        .header .subtitle {
            color: #6B7280;
            font-size: 11pt;
            margin: 3px 0;
        }
        
        .header .org {
            color: #9CA3AF;
            font-size: 9pt;
            margin-top: 5px;
        }
        
        .info-box {
            background: #F3F4F6;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 15px;
            border-left: 4px solid #4F46E5;
        }
        
        .info-row {
            margin-bottom: 5px;
        }
        
        .label {
            font-weight: bold;
            color: #4B5563;
            display: inline-block;
            width: 100px;
        }
        
        .value {
            color: #111827;
        }
        
        .section {
            margin-bottom: 18px;
            page-break-inside: avoid;
        }
        
        .section-title {
            background: #4F46E5;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            margin-bottom: 8px;
            font-size: 12pt;
            font-weight: bold;
        }
        
        .section-content {
            padding: 10px 12px;
            background: #F9FAFB;
            border-left: 3px solid #4F46E5;
            text-align: justify;
            line-height: 1.6;
        }
        
        .module {
            margin-bottom: 12px;
            page-break-inside: avoid;
        }
        
        .module-title {
            background: #E0E7FF;
            color: #4338CA;
            padding: 6px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 9.5pt;
            margin-bottom: 5px;
        }
        
        .module-content {
            padding: 8px 10px;
            background: #F5F5F5;
            border-left: 3px solid #818CF8;
            font-size: 9.5pt;
            line-height: 1.5;
            text-align: justify;
        }
        
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 8pt;
            color: #9CA3AF;
            border-top: 1px solid #E5E7EB;
            padding-top: 8px;
        }
        
        .page-number:before {
            content: "Page " counter(page);
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BILAN MPI - PHASE 1</h1>
        <div class="subtitle">Mobilisation vers la Professionnalisation et l'Insertion</div>
        <div class="subtitle">{{ $bilan->bilan_genere['Nom de l\'apprenant'] }}</div>
        <div class="org">Australe Formation CFA - La Réunion</div>
    </div>

    <div class="info-box">
        <div class="info-row">
            <span class="label">Apprenant :</span>
            <span class="value">{{ $bilan->bilan_genere['Nom de l\'apprenant'] }}</span>
        </div>
        <div class="info-row">
            <span class="label">CIP :</span>
            <span class="value">{{ $bilan->cip }}</span>
        </div>
        <div class="info-row">
            <span class="label">Date :</span>
            <span class="value">{{ $bilan->created_at->format('d/m/Y à H:i') }}</span>
        </div>
    </div>

    <div class="section">
        <div class="section-title">FORMATEURS</div>
        <div class="section-content">
            {{ $bilan->bilan_genere['Formateurs'] }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">PARCOURS</div>
        <div class="section-content">
            {{ $bilan->bilan_genere['Parcours'] }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">CONDITIONS</div>
        <div class="section-content">
            {{ $bilan->bilan_genere['Conditions'] }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">MÉTHODES PÉDAGOGIQUES</div>
        <div class="section-content">
            {{ $bilan->bilan_genere['Méthodes'] }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">MODULES DE FORMATION</div>
        
        @php
            $moduleTitles = [
                'Module 1' => 'MODULE 1 - Estime de soi et confiance en soi',
                'Module 2' => 'MODULE 2 - Exprimer ses rêves et ses ambitions par le Dessin',
                'Module 3' => 'MODULE 3 - Interculturalité',
                'Module 4' => 'MODULE 4 - Se Libérer de ses addictions',
                'Module 5' => 'MODULE 5 - Accompagnement Personnalisé Handicap',
                'Module 6' => 'MODULE 6 - Apprentissage du Français, de la lecture et de l\'écriture',
                'Module 7' => 'MODULE 7 - Remise à Niveau Numérique',
                'Module 8' => 'MODULE 8 - Apprendre la posture professionnelle et s\'apprêter pour celle-ci',
                'Module 9' => 'MODULE 9 - CLEA',
                'Module 10' => 'MODULE 10 - CLEA Numérique',
                'Module 11' => 'MODULE 11 - Lever ses freins liés à la Mobilité',
                'Module 12' => 'MODULE 12 - Accompagnement personnalisé à l\'Insertion Socio-Pro',
                'Module 13' => 'MODULE 13 - Accompagnement à la recherche d\'une entreprise ou d\'un CFA + Stage',
            ];
        @endphp
        
        @foreach($moduleTitles as $moduleKey => $moduleTitle)
            @php
                $moduleContent = $bilan->bilan_genere[$moduleKey] ?? null;
            @endphp
            
            @if($moduleContent && $moduleContent !== 'Non renseigné')
                <div class="module">
                    <div class="module-title">{{ $moduleTitle }}</div>
                    <div class="module-content">
                        {{ $moduleContent }}
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <div class="section">
        <div class="section-title">ARRÊT OU INTERRUPTION</div>
        <div class="section-content">
            {{ $bilan->bilan_genere['Arrêt'] }}
        </div>
    </div>

    <div class="footer">
        <div class="page-number"></div>
        <div>Document généré automatiquement le {{ now()->format('d/m/Y à H:i') }}</div>
        <div>Australe Formation CFA - Dispositif MPI Phase 1</div>
    </div>
</body>
</html>