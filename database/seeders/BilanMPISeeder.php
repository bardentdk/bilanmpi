<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BilanMPI;
use Illuminate\Support\Facades\DB;

class BilanMPISeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Désactiver les vérifications de clés étrangères temporairement
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Vider la table
        BilanMPI::truncate();
        
        // Réactiver les vérifications
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $prénoms = [
            'Marie', 'Sophie', 'Julie', 'Laura', 'Emma', 'Léa', 'Chloé', 'Manon', 'Camille', 'Sarah',
            'Thomas', 'Lucas', 'Nathan', 'Hugo', 'Mathis', 'Antoine', 'Alexandre', 'Maxime', 'Nicolas', 'Julien',
            'Yasmine', 'Fatima', 'Amina', 'Khadija', 'Aïcha', 'Nadia', 'Samira', 'Leïla', 'Soraya', 'Hafsa',
            'Mohamed', 'Ahmed', 'Ibrahim', 'Youssef', 'Omar', 'Ali', 'Hassan', 'Karim', 'Malik', 'Samir',
            'Océane', 'Jade', 'Lou', 'Zoé', 'Inès', 'Clara', 'Anaïs', 'Charlotte', 'Lucie', 'Marion',
            'Baptiste', 'Théo', 'Louis', 'Gabriel', 'Arthur', 'Enzo', 'Paul', 'Victor', 'Clément', 'Raphaël'
        ];

        $noms = [
            'MARTIN', 'BERNARD', 'DUBOIS', 'THOMAS', 'ROBERT', 'RICHARD', 'PETIT', 'DURAND', 'LEROY', 'MOREAU',
            'SIMON', 'LAURENT', 'LEFEBVRE', 'MICHEL', 'GARCIA', 'DAVID', 'BERTRAND', 'ROUX', 'VINCENT', 'FOURNIER',
            'MOREL', 'GIRARD', 'ANDRE', 'LEFEVRE', 'MERCIER', 'DUPONT', 'LAMBERT', 'BONNET', 'FRANCOIS', 'MARTINEZ',
            'PAYET', 'HOARAU', 'GRONDIN', 'FONTAINE', 'RIVIERE', 'Boyer', 'NATIVEL', 'HOAREAU', 'LALLEMAND', 'TÉCHER',
            'LEGRAND', 'GARNIER', 'FAURE', 'ROUSSEAU', 'BLANC', 'GUERIN', 'MULLER', 'HENRY', 'ROUSSEL', 'NICOLAS',
            'PERRIN', 'MORIN', 'MATHIEU', 'CLEMENT', 'GAUTHIER', 'DUMONT', 'LOPEZ', 'FONTAINE', 'CHEVALIER', 'ROBIN'
        ];

        $cips = [
            'Benjamin SINAMA',
            'Christine CORRAL',
            'Stéphanie PAYET',
            'Ansoitti Ali',
            'Marie-Claude TÉCHER',
            'Jean-Paul HOARAU',
            'Sandrine LALLEMAND',
            'Patrick GRONDIN'
        ];

        $formateurs = [
            'Benjamin SINAMA, Ansoitti Ali, Stéphanie PAYET, Christine CORRAL',
            'Stéphanie PAYET, Christine CORRAL, Benjamin SINAMA',
            'Christine CORRAL, Marie-Claude TÉCHER, Jean-Paul HOARAU',
            'Benjamin SINAMA, Sandrine LALLEMAND, Patrick GRONDIN',
            'Ansoitti Ali, Stéphanie PAYET, Marie-Claude TÉCHER'
        ];

        $this->command->info('🚀 Génération de 100 bilans MPI...');
        $progressBar = $this->command->getOutput()->createProgressBar(100);
        $progressBar->start();

        for ($i = 1; $i <= 100; $i++) {
            $prenom = $prénoms[array_rand($prénoms)];
            $nom = $noms[array_rand($noms)];
            $cip = $cips[array_rand($cips)];
            $formateursListe = $formateurs[array_rand($formateurs)];
            
            $notesExemples = [
                "Stagiaire très motivé, bases en informatique, assiduité excellente. Bonnes compétences numériques. Modules techniques réussis. Projet final : site web responsive. Validé pour formation développement web.",
                "Apprenant sérieux, quelques difficultés en français écrit. Très bon en pratique. Assiduité correcte avec 2 absences justifiées. Progression notable en communication. Objectif : CAP cuisine.",
                "Excellente candidate, autonome et rigoureuse. Très bonne maîtrise du français et des outils bureautiques. Projet professionnel clair : assistante administrative. Stage validé avec succès.",
                "Stagiaire timide au départ, a gagné en confiance. Difficultés en mathématiques compensées par motivation. Bon esprit d'équipe. Objectif : métiers du service à la personne.",
                "Apprenant dynamique, créatif. Quelques retards liés au transport. Excellent en dessin et communication visuelle. Projet : formation en graphisme. Potentiel confirmé.",
                "Candidate avec enfants en bas âge, organisation exemplaire. Bonne évolution en français. Objectif ADVF (Assistante De Vie aux Familles). Stage probant en EHPAD.",
                "Stagiaire ayant quitté l'école sans diplôme, rattrapage réussi. Très bon en numérique. Assiduité parfaite. Orientation vers formation technicien informatique.",
                "Apprenant sportif, bon esprit d'équipe. Progression en expression écrite. Quelques difficultés d'attention en cours théoriques. Objectif : BPJEPS (animation sportive).",
                "Candidate migrante, apprentissage rapide du français. Diplômes étrangers validés. Excellente motivation. Projet : aide-soignante. Immersion en structure médicale réussie.",
                "Stagiaire en reconversion professionnelle, 35 ans. Expérience vie active valorisée. Objectif : formation comptabilité. Très sérieux, résultats excellents."
            ];
            
            $noteBrute = $notesExemples[array_rand($notesExemples)];

            // Générer un bilan réaliste
            $bilanGenere = [
                'Nom de l\'apprenant' => strtoupper($nom) . ' ' . ucfirst($prenom),
                'Formateurs' => "L'accompagnement pédagogique de " . ($this->getGenre($prenom) === 'F' ? 'Madame' : 'Monsieur') . " " . strtoupper($nom) . " a été assuré par une équipe pluridisciplinaire composée de " . $formateursListe . ".",
                'Parcours' => $this->genererParcours($prenom, $nom),
                'Conditions' => $this->genererConditions(),
                'Méthodes' => $this->genererMethodes(),
                'Module 1' => $this->genererModule('estime de soi'),
                'Module 2' => $this->genererModule('dessin'),
                'Module 3' => $this->genererModule('interculturalité'),
                'Module 4' => rand(0, 10) > 7 ? "Ce module ne s'appliquait pas à la situation particulière de l'apprenant. Sans objet." : $this->genererModule('addictions'),
                'Module 5' => rand(0, 10) > 8 ? "L'apprenant n'est pas en situation de handicap reconnu. Ce module n'était pas applicable dans son cas. Sans objet." : $this->genererModule('handicap'),
                'Module 6' => $this->genererModule('français'),
                'Module 7' => $this->genererModule('numérique'),
                'Module 8' => $this->genererModule('posture professionnelle'),
                'Module 9' => rand(0, 10) > 5 ? 'N/A' : $this->genererModuleClea(),
                'Module 10' => rand(0, 10) > 6 ? 'N/A' : $this->genererModuleClea(),
                'Module 11' => $this->genererModule('mobilité'),
                'Module 12' => $this->genererModule('insertion'),
                'Module 13' => $this->genererModule('recherche emploi'),
                'Arrêt' => rand(0, 10) > 9 ? $this->genererArret() : "L'apprenant a suivi l'intégralité du parcours de Phase 1 sans interruption, démontrant ainsi sa capacité à s'engager pleinement sur la durée des 300 heures réglementaires. Cette assiduité témoigne de sa motivation et de son investissement dans son projet professionnel.",
            ];

            $impacts = ['pas_du_tout', 'moyennement', 'beaucoup', 'au_dela'];

            BilanMPI::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'cip' => $cip,
                'formateurs' => $formateursListe,
                'notes_brutes' => $noteBrute,
                'bilan_genere' => $bilanGenere,
                'impact_efficacite' => $impacts[array_rand($impacts)],
                'impact_marche_travail' => $impacts[array_rand($impacts)],
                'impact_insertion_sociale' => $impacts[array_rand($impacts)],
                'created_at' => now()->subDays(rand(0, 180)),
                'updated_at' => now()->subDays(rand(0, 30)),
            ]);

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine();
        $this->command->info('✅ 100 bilans MPI générés avec succès !');
    }

    private function getGenre($prenom)
    {
        $prenomsF = ['Marie', 'Sophie', 'Julie', 'Laura', 'Emma', 'Léa', 'Chloé', 'Manon', 'Camille', 'Sarah', 
                     'Yasmine', 'Fatima', 'Amina', 'Khadija', 'Aïcha', 'Nadia', 'Samira', 'Leïla', 'Soraya', 'Hafsa',
                     'Océane', 'Jade', 'Lou', 'Zoé', 'Inès', 'Clara', 'Anaïs', 'Charlotte', 'Lucie', 'Marion'];
        return in_array($prenom, $prenomsF) ? 'F' : 'M';
    }

    private function genererParcours($prenom, $nom)
    {
        $parcours = [
            "Au commencement de la Phase 1, {$prenom}, sorti(e) du système scolaire sans diplôme, a rejoint le dispositif MPI avec une motivation fluctuante et un besoin urgent de réorienter sa trajectoire professionnelle. Dès les premières séances, l'apprenant(e) a montré des difficultés d'assiduité, notamment deux absences justifiées liées à des contraintes familiales. Les premières interactions ont révélé une anxiété notable en groupe, se manifestant par un retrait et une participation limitée aux ateliers. Au fil des semaines, grâce à des stratégies d'accompagnement individualisé et un soutien empathique, {$prenom} a progressivement retrouvé confiance, en s'impliquant davantage lors des mises en situation professionnelles. En conclusion, la Phase 1 a permis de clarifier le projet d'insertion, de surmonter des obstacles personnels et de développer des compétences fondamentales.",
            
            "{$prenom} a intégré le dispositif MPI avec un projet professionnel déjà esquissé mais nécessitant consolidation. L'apprenant(e) présentait des acquis scolaires fragiles, notamment en mathématiques et en expression écrite, compensés par une forte motivation et une excellente capacité d'adaptation. Durant les premiers mois, plusieurs ajustements pédagogiques ont été nécessaires pour répondre aux besoins spécifiques identifiés. La progression observée sur l'ensemble de la phase 1 témoigne d'un investissement constant et d'une réelle volonté de réussite. Les immersions en entreprise ont confirmé l'adéquation entre le projet professionnel et les aptitudes développées.",
            
            "L'accompagnement de {$prenom} dans le cadre de la Phase 1 MPI a débuté par une phase d'observation permettant d'identifier les freins socioprofessionnels. L'apprenant(e) a fait preuve d'une grande ouverture aux apprentissages proposés, malgré un parcours antérieur marqué par des ruptures. Les ateliers collectifs ont permis de travailler sur la confiance en soi et les compétences transversales. Une attention particulière a été portée sur l'accompagnement individualisé pour lever les freins périphériques. À l'issue de ces 300 heures, le projet professionnel est clairement défini et les démarches d'orientation sont engagées avec détermination.",
        ];
        
        return $parcours[array_rand($parcours)];
    }

    private function genererConditions()
    {
        $conditions = [
            "Les conditions d'accueil ont été organisées dans un cadre bienveillant, avec un rythme pédagogique adapté aux besoins individuels. L'assiduité a été satisfaisante avec quelques retards occasionnels liés aux contraintes de transport. L'engagement dans les activités collectives a été progressif, nécessitant parfois un accompagnement spécifique pour favoriser la prise de parole. L'atmosphère du groupe a évolué vers une dynamique inclusive, facilitant les échanges et le soutien mutuel. Les conditions matérielles et l'environnement pédagogique ont contribué à créer un cadre propice aux apprentissages.",
            
            "Le déroulement pédagogique s'est effectué dans des conditions optimales, favorisant l'engagement et la progression de l'ensemble du groupe. L'assiduité a été exemplaire, témoignant d'une réelle motivation. Les séances ont alterné temps collectifs et accompagnement individualisé, permettant de répondre aux besoins spécifiques. La dynamique de groupe positive a facilité les apprentissages collaboratifs. Les adaptations nécessaires ont été mises en œuvre rapidement pour garantir l'accessibilité des contenus à tous les apprenants.",
            
            "Les conditions de formation ont nécessité quelques ajustements en cours de parcours pour s'adapter aux contraintes personnelles de certains apprenants. Un travail spécifique sur la gestion du temps et l'organisation a été mené. L'assiduité globalement satisfaisante a parfois été impactée par des situations personnelles complexes, prises en compte dans l'accompagnement. L'ambiance de groupe bienveillante a favorisé l'entraide et la persévérance. Les outils pédagogiques diversifiés ont permis de maintenir l'engagement.",
        ];
        
        return $conditions[array_rand($conditions)];
    }

    private function genererMethodes()
    {
        $methodes = [
            "Le dispositif a adopté une approche pédagogique centrée sur l'apprentissage actif, intégrant des ateliers pratiques, des jeux de rôle et des études de cas pour renforcer la compréhension. Des séances de tutorat individualisé ont été organisées pour accompagner les difficultés spécifiques. La pédagogie différenciée a été systématiquement mise en œuvre, ajustant la durée des séances et la complexité des tâches. L'accent a également été mis sur l'apprentissage par projet, encourageant l'application des compétences dans des contextes réels. Cette approche holistique vise à favoriser l'autonomie et la préparation concrète à l'insertion professionnelle.",
            
            "Les méthodes pédagogiques déployées ont combiné enseignement magistral adapté et pédagogie active. L'utilisation du numérique a permis de diversifier les supports et d'individualiser certains parcours d'apprentissage. Des temps de co-construction des savoirs ont été privilégiés, valorisant l'expérience et les acquis de chacun. L'innovation a résidé dans l'intégration systématique de mises en situation professionnelle réalistes. Le suivi individualisé a permis d'ajuster en continu les modalités pédagogiques aux besoins identifiés.",
            
            "La démarche pédagogique a privilégié une approche par compétences, articulant savoirs théoriques et mises en pratique. Les outils numériques collaboratifs ont favorisé le travail de groupe et le développement de l'autonomie. Des intervenants extérieurs professionnels ont enrichi les apprentissages par leurs témoignages. La dimension innovante s'est exprimée dans la personnalisation des parcours et l'adaptation continue des modalités pédagogiques. L'évaluation formative régulière a permis de mesurer les progrès et d'ajuster les objectifs.",
        ];
        
        return $methodes[array_rand($methodes)];
    }

    private function genererModule($type)
    {
        $degres = ['faible', 'moyen', 'bon', 'très bon'];
        $degre = $degres[array_rand($degres)];
        
        $textes = [
            "Au début de ce module, l'apprenant présentait des appréhensions liées à son parcours antérieur. Le contenu proposé a permis d'aborder progressivement les compétences visées à travers des exercices adaptés et des mises en situation concrètes. L'attitude de l'apprenant s'est révélée constructive, avec une participation active aux échanges collectifs. Les difficultés initiales ont été progressivement surmontées grâce à un accompagnement individualisé et des supports pédagogiques variés. La progression observée témoigne d'un réel investissement dans les apprentissages. À l'issue du module, les acquis sont consolidés et permettent d'envisager la suite du parcours sereinement. Degré d'atteinte des objectifs : {$degre}.",
            
            "Le démarrage du module a mis en évidence un niveau initial hétérogène nécessitant une différenciation pédagogique. Les activités proposées ont favorisé l'engagement et la montée en compétence progressive. L'apprenant a démontré une capacité d'adaptation satisfaisante face aux exigences du module. Les obstacles rencontrés ont été traités méthodiquement, permettant une évolution notable des acquis. L'implication constante dans les travaux proposés a facilité l'atteinte des objectifs pédagogiques. Les compétences développées constituent une base solide pour la poursuite du projet professionnel. Degré d'atteinte des objectifs : {$degre}.",
            
            "Au commencement de ce module, l'apprenant a exprimé un intérêt marqué pour la thématique abordée. Le contenu pédagogique a été dispensé selon une progression adaptée, alternant apports théoriques et exercices pratiques. La participation aux activités collectives a été dynamique, enrichissant les échanges du groupe. Les difficultés ponctuelles ont été rapidement identifiées et traitées par un accompagnement ciblé. La progression réalisée démontre l'efficacité des méthodes déployées et l'investissement personnel. Les objectifs du module sont atteints de manière satisfaisante, ouvrant des perspectives positives. Degré d'atteinte des objectifs : {$degre}.",
        ];
        
        return $textes[array_rand($textes)];
    }

    private function genererModuleClea()
    {
        $textes = [
            "L'apprenant a entrepris la démarche de certification CléA durant la Phase 1. Le positionnement initial a permis d'identifier les domaines à renforcer. Un accompagnement spécifique a été mis en place pour travailler les compétences requises. Les évaluations intermédiaires ont montré une progression constante sur l'ensemble des domaines. L'apprenant a fait preuve de sérieux et de régularité dans la préparation. À l'issue du parcours, le dossier de certification a été constitué et transmis pour validation. Degré d'atteinte des objectifs : bon.",
            
            "La certification CléA a été intégrée au parcours de formation avec l'accord de l'apprenant. Les sept domaines de compétences ont été travaillés de manière progressive et structurée. Les ateliers collectifs et individuels ont permis de combler les lacunes identifiées lors du positionnement. L'investissement de l'apprenant dans cette démarche a été remarquable. Les évaluations réalisées attestent de l'acquisition des compétences fondamentales. La certification devrait être obtenue dans les prochains mois. Degré d'atteinte des objectifs : très bon.",
        ];
        
        return $textes[array_rand($textes)];
    }

    private function genererArret()
    {
        $raisons = [
            "L'apprenant a interrompu son parcours à 180 heures pour raisons personnelles impérieuses (problèmes de santé familiale). Cette décision mûrement réfléchie a été accompagnée par l'équipe pédagogique. Les acquis développés durant cette période restent valorisables. Une reprise du parcours reste envisageable ultérieurement.",
            
            "L'abandon du parcours est intervenu après 220 heures suite à une opportunité d'emploi en CDI correspondant au projet professionnel. Cette issue positive témoigne de l'efficacité de l'accompagnement mis en œuvre. Les compétences développées ont directement contribué à cette insertion réussie.",
            
            "L'interruption du parcours à 150 heures résulte de difficultés personnelles cumulées (problèmes de logement et de mobilité). Malgré les solutions proposées par l'équipe, la poursuite n'a pas été possible. Un accompagnement vers les services sociaux a été assuré pour traiter les freins périphériques.",
        ];
        
        return $raisons[array_rand($raisons)];
    }
}