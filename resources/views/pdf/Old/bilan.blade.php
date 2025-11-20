<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Bilan de Formation</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11pt;
            line-height: 1.6;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4F46E5;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #4F46E5;
            margin: 0;
            font-size: 24pt;
        }
        .info-box {
            background: #F3F4F6;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .label {
            font-weight: bold;
            color: #6B7280;
        }
        .value {
            color: #111827;
        }
        .section {
            margin-bottom: 25px;
        }
        .section-title {
            background: #4F46E5;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 14pt;
        }
        .section-content {
            padding: 15px;
            background: #F9FAFB;
            border-left: 4px solid #4F46E5;
            text-align: justify;
        }
        .note-globale {
            text-align: center;
            font-size: 28pt;
            color: #4F46E5;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 9pt;
            color: #9CA3AF;
            border-top: 1px solid #E5E7EB;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BILAN DE FORMATION</h1>
        <p style="color: #6B7280; margin: 5px 0;">Généré automatiquement avec l'IA</p>
    </div>

    <div class="info-box">
        <div class="info-row">
            <span class="label">Stagiaire :</span>
            <span class="value">{{ $bilan->stagiaire_prenom }} {{ $bilan->stagiaire_nom }}</span>
        </div>
        <div class="info-row">
            <span class="label">Formation :</span>
            <span class="value">{{ $bilan->formation_titre }}</span>
        </div>
        <div class="info-row">
            <span class="label">Période :</span>
            <span class="value">
                Du {{ $bilan->formation_date_debut->format('d/m/Y') }} 
                au {{ $bilan->formation_date_fin->format('d/m/Y') }}
            </span>
        </div>
    </div>

    <div class="note-globale">
        {{ $bilan->note_globale }}/20
    </div>

    <div class="section">
        <div class="section-title">OBJECTIFS ATTEINTS</div>
        <div class="section-content">
            {{ $bilan->objectifs_atteints }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">COMPÉTENCES ACQUISES</div>
        <div class="section-content">
            {{ $bilan->competences_acquises }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">POINTS FORTS</div>
        <div class="section-content">
            {{ $bilan->points_forts }}
        </div>
    </div>

    <div class="section">
        <div class="section-title">AXES D'AMÉLIORATION</div>
        <div class="section-content">
            {{ $bilan->axes_amelioration }}
        </div>
    </div>

    @if($bilan->observations_generales)
    <div class="section">
        <div class="section-title">OBSERVATIONS GÉNÉRALES</div>
        <div class="section-content">
            {{ $bilan->observations_generales }}
        </div>
    </div>
    @endif

    <div class="footer">
        Document généré le {{ now()->format('d/m/Y à H:i') }} | Australe Formation CFA
    </div>
</body>
</html>