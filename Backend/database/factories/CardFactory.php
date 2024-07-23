<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Theme;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition()
    {
        $theme = Theme::inRandomOrder()->first();

        $questionsAndAnswers = [
            'Trivia divers' => [
                ['Quelle est la capitale de la France ?', 'Paris'],
                ['Combien de continents y a-t-il ?', '7'],
                ['Quel est le plus long fleuve du monde ?', 'Le Nil'],
                ['Qui a peint la Joconde ?', 'Leonard de Vinci'],
                ['Quelle est la langue la plus parlée au monde ?', 'Le mandarin']
            ],
            'Faits insolites' => [
                ['Quel animal détient le record de la plus longue migration ?', 'Le stern arctique'],
                ['Quelle est la seule partie du corps qui ne peut pas se réparer toute seule ?', 'Les dents'],
                ['Combien de temps faut-il pour que la lumière du soleil atteigne la Terre ?', 'Environ 8 minutes et 20 secondes'],
                ['Quelle est la substance la plus dure dans le corps humain ?', 'L\'émail des dents'],
                ['Combien de temps dure une année sur Mercure ?', '88 jours terrestres']
            ],
            'Culture populaire' => [
                ['Quel super-héros est aussi connu sous le nom de Bruce Wayne ?', 'Batman'],
                ['Quel est le nom du bateau de Jack Sparrow dans "Pirates des Caraïbes" ?', 'Le Black Pearl'],
                ['Quel est le titre de la chanson thème de "Titanic" ?', 'My Heart Will Go On'],
                ['Quel acteur joue le rôle principal dans "Iron Man" ?', 'Robert Downey Jr.'],
                ['Quelle série télévisée met en scène un trône de fer ?', 'Game of Thrones']
            ],
            'Physique' => [
                ['Quelle est la formule de la vitesse ?', 'Distance / Temps'],
                ['Qui a découvert la gravité ?', 'Isaac Newton'],
                ['Quelle est l\'unité de force ?', 'Newton'],
                ['Quelle est la vitesse de la lumière ?', '299,792 km/s'],
                ['Quel est le symbole chimique de l\'eau ?', 'H2O']
            ],
            'Chimie' => [
                ['Quel est le numéro atomique de l\'hydrogène ?', '1'],
                ['Quelle est la formule chimique du sel de table ?', 'NaCl'],
                ['Qui est considéré comme le père de la chimie moderne ?', 'Antoine Lavoisier'],
                ['Quel gaz est utilisé dans les enseignes lumineuses ?', 'Néon'],
                ['Quelle est la substance la plus acide ?', 'L\'acide fluorantimonique']
            ],
            'Biologie' => [
                ['Quelle est la plus grande cellule du corps humain ?', 'L\'ovule'],
                ['Quel organe produit l\'insuline ?', 'Le pancréas'],
                ['Quel est le plus grand organe du corps humain ?', 'La peau'],
                ['Combien d\'os y a-t-il dans le corps humain adulte ?', '206'],
                ['Quel est le plus grand mammifère ?', 'La baleine bleue']
            ],
            'Guerres mondiales' => [
                ['Quand a commencé la Première Guerre mondiale ?', '1914'],
                ['Qui était le président des États-Unis pendant la Seconde Guerre mondiale ?', 'Franklin D. Roosevelt'],
                ['Quelle bataille a marqué le tournant de la Seconde Guerre mondiale ?', 'La bataille de Stalingrad'],
                ['Quelle conférence a divisé l\'Europe après la Seconde Guerre mondiale ?', 'La conférence de Yalta'],
                ['Quel traité a mis fin à la Première Guerre mondiale ?', 'Le traité de Versailles']
            ],
            'Rois et reines' => [
                ['Qui était la reine de France pendant la Révolution française ?', 'Marie-Antoinette'],
                ['Quel roi anglais a eu six épouses ?', 'Henri VIII'],
                ['Qui est le monarque actuel du Royaume-Uni ?', 'Charles III'],
                ['Quel roi a été connu comme le Roi-Soleil ?', 'Louis XIV'],
                ['Quelle reine est associée à la phrase "Let them eat cake" ?', 'Marie-Antoinette']
            ],
            'Événements majeurs' => [
                ['Quand a eu lieu la chute du mur de Berlin ?', '1989'],
                ['Quel événement a déclenché la Seconde Guerre mondiale ?', 'L\'invasion de la Pologne par l\'Allemagne'],
                ['Quel a été le premier homme à marcher sur la lune ?', 'Neil Armstrong'],
                ['Quelle ville a été la cible de la première bombe atomique ?', 'Hiroshima'],
                ['Quel événement a marqué le début du Moyen Âge ?', 'La chute de l\'Empire romain']
            ],
            'Capitale du monde' => [
                ['Quelle est la capitale de l\'Australie ?', 'Canberra'],
                ['Quelle est la capitale du Canada ?', 'Ottawa'],
                ['Quelle est la capitale de l\'Italie ?', 'Rome'],
                ['Quelle est la capitale de l\'Inde ?', 'New Delhi'],
                ['Quelle est la capitale du Brésil ?', 'Brasilia']
            ],
            'Pays et continents' => [
                ['Quel est le plus grand pays du monde ?', 'La Russie'],
                ['Quel continent a le plus grand nombre de pays ?', 'L\'Afrique'],
                ['Quel pays est surnommé le "Pays du Soleil Levant" ?', 'Le Japon'],
                ['Quel pays est le plus peuplé au monde ?', 'La Chine'],
                ['Quel pays a le plus grand nombre de volcans actifs ?', 'L\'Indonésie']
            ],
            'Relief et climat' => [
                ['Quel est le plus haut sommet d\'Afrique ?', 'Le Kilimandjaro'],
                ['Quel désert est le plus vaste au monde ?', 'Le Sahara'],
                ['Quel est le fleuve le plus long d\'Amérique du Sud ?', 'L\'Amazonie'],
                ['Quel est le climat prédominant en Amazonie ?', 'Tropical humide'],
                ['Quel est le point le plus bas sur Terre ?', 'La mer Morte']
            ],
            'Football' => [
                ['Qui a remporté la Coupe du Monde de la FIFA en 2018 ?', 'La France'],
                ['Quel joueur a remporté le plus de Ballons d\'Or ?', 'Lionel Messi'],
                ['Quel est le stade le plus grand du monde ?', 'Le Rungrado May Day Stadium'],
                ['Quel club a remporté le plus de Ligues des Champions ?', 'Real Madrid'],
                ['Qui est connu comme le "Roi du football" ?', 'Pelé']
            ],
            'Olympiques' => [
                ['Quand ont eu lieu les premiers Jeux Olympiques modernes ?', '1896'],
                ['Quel athlète a remporté le plus de médailles olympiques ?', 'Michael Phelps'],
                ['Quel pays a organisé les Jeux Olympiques de 2008 ?', 'La Chine'],
                ['Quel est le symbole des Jeux Olympiques ?', 'Les cinq anneaux entrelacés'],
                ['Quel sport a été ajouté aux Jeux Olympiques de 2020 ?', 'Le skateboard']
            ],
            'Records sportifs' => [
                ['Quel est le record du monde du 100 mètres ?', '9,58 secondes'],
                ['Quel est le plus long match de tennis de l\'histoire ?', '11 heures et 5 minutes'],
                ['Quel est le plus grand nombre de points marqués en un seul match de NBA ?', '100 points'],
                ['Quel athlète a remporté le plus de Tour de France ?', 'Lance Armstrong (avant disqualification)'],
                ['Quel est le record du monde du saut en hauteur ?', '2,45 mètres']
            ],
            'Cinéma' => [
                ['Quel film a remporté l\'Oscar du meilleur film en 2020 ?', 'Parasite'],
                ['Qui joue le rôle principal dans "Iron Man" ?', 'Robert Downey Jr.'],
                ['Quel film a pour réplique célèbre "May the Force be with you" ?', 'Star Wars'],
                ['Quel est le réalisateur de "Titanic" ?', 'James Cameron'],
                ['Quel est le film le plus rentable de tous les temps ?', 'Avengers: Endgame']
            ],
            'Séries télé' => [
                ['Qui est le créateur de la série "Breaking Bad" ?', 'Vince Gilligan'],
                ['Quelle série se déroule à Westeros ?', 'Game of Thrones'],
                ['Quel acteur joue Sherlock Holmes dans la série "Sherlock" ?', 'Benedict Cumberbatch'],
                ['Quelle série met en scène un chimiste devenu fabricant de drogue ?', 'Breaking Bad'],
                ['Quelle série a pour slogan "Winter is coming" ?', 'Game of Thrones']
            ],
            'Jeux vidéo' => [
                ['Quel jeu vidéo a été le plus vendu de tous les temps ?', 'Minecraft'],
                ['Quel personnage de jeu vidéo est un plombier ?', 'Mario'],
                ['Quel jeu est connu pour la réplique "The cake is a lie" ?', 'Portal'],
                ['Quel jeu de course a été développé par Nintendo ?', 'Mario Kart'],
                ['Quel jeu de tir à la première personne est développé par Activision ?', 'Call of Duty']
            ],
            'Peinture' => [
                ['Qui a peint "La Nuit étoilée" ?', 'Vincent van Gogh'],
                ['Quel artiste est connu pour ses œuvres cubistes ?', 'Pablo Picasso'],
                ['Qui a peint "La Joconde" ?', 'Leonard de Vinci'],
                ['Quel mouvement artistique est associé à Claude Monet ?', 'L\'impressionnisme'],
                ['Quel artiste a peint la Chapelle Sixtine ?', 'Michel-Ange']
            ],
            'Sculpture' => [
                ['Quel artiste a sculpté "Le David" ?', 'Michel-Ange'],
                ['Qui est le créateur du "Thinker" ?', 'Auguste Rodin'],
                ['Quel sculpteur est connu pour ses mobiles ?', 'Alexander Calder'],
                ['Qui a sculpté "La Pietà" ?', 'Michel-Ange'],
                ['Quel sculpteur est associé au mouvement Art Nouveau ?', 'Antoni Gaudí']
            ],
            'Architecture' => [
                ['Quel architecte a conçu le Fallingwater ?', 'Frank Lloyd Wright'],
                ['Qui a dessiné le dôme de la basilique Saint-Pierre ?', 'Michel-Ange'],
                ['Quel est le style architectural de la Tour Eiffel ?', 'Architecture du fer'],
                ['Quel architecte est connu pour ses œuvres modernistes à Barcelone ?', 'Antoni Gaudí'],
                ['Quel est le plus grand bâtiment du monde ?', 'Burj Khalifa']
            ],
            'Romans célèbres' => [
                ['Qui a écrit "Les Misérables" ?', 'Victor Hugo'],
                ['Quel est le titre du premier livre de la série "Harry Potter" ?', 'Harry Potter à l\'école des sorciers'],
                ['Quel roman commence par "Call me Ishmael" ?', 'Moby Dick'],
                ['Qui est l\'auteur de "Pride and Prejudice" ?', 'Jane Austen'],
                ['Quel roman se déroule dans la dystopie de "Gilead" ?', 'The Handmaid\'s Tale']
            ],
            'Auteurs' => [
                ['Qui est l\'auteur de "Don Quixote" ?', 'Miguel de Cervantes'],
                ['Quel auteur est connu pour ses œuvres de science-fiction ?', 'Isaac Asimov'],
                ['Qui a écrit "1984" ?', 'George Orwell'],
                ['Quel auteur a créé le personnage de Sherlock Holmes ?', 'Arthur Conan Doyle'],
                ['Qui est l\'auteur de "The Catcher in the Rye" ?', 'J.D. Salinger']
            ],
            'Poésie' => [
                ['Qui a écrit "Les Fleurs du mal" ?', 'Charles Baudelaire'],
                ['Quel poète est connu pour son œuvre "The Raven" ?', 'Edgar Allan Poe'],
                ['Qui est l\'auteur du poème "Ode to a Nightingale" ?', 'John Keats'],
                ['Quel poète a écrit "Le Bateau ivre" ?', 'Arthur Rimbaud'],
                ['Qui a écrit "La Divine Comédie" ?', 'Dante Alighieri']
            ],
            'Innovations' => [
                ['Qui a inventé l\'ampoule électrique ?', 'Thomas Edison'],
                ['Quel est le nom de la première voiture de série ?', 'La Ford Model T'],
                ['Qui a inventé le téléphone ?', 'Alexander Graham Bell'],
                ['Quel est le premier ordinateur grand public ?', 'L\'Apple II'],
                ['Qui a inventé le World Wide Web ?', 'Tim Berners-Lee']
            ],
            'Gadgets' => [
                ['Quel est le nom du premier smartphone ?', 'IBM Simon'],
                ['Quel appareil a révolutionné la musique portable ?', 'L\'iPod'],
                ['Quel gadget est connu sous le nom de "Wearable Technology" ?', 'Les montres intelligentes'],
                ['Quel est le nom de la console de jeux vidéo de Nintendo sortie en 2006 ?', 'Nintendo Wii'],
                ['Quel gadget de réalité virtuelle a été développé par Oculus ?', 'Oculus Rift']
            ],
            'Histoire de la technologie' => [
                ['Quel est le premier moteur de recherche sur Internet ?', 'Archie'],
                ['Quel est le premier site web créé ?', 'info.cern.ch'],
                ['Qui a fondé Microsoft ?', 'Bill Gates et Paul Allen'],
                ['Quel est le premier système d\'exploitation pour ordinateurs personnels ?', 'MS-DOS'],
                ['Quel est le nom du premier satellite artificiel lancé par l\'Union soviétique ?', 'Spoutnik']
            ],
            'Genres musicaux' => [
                ['Quel genre musical est originaire de la Nouvelle-Orléans ?', 'Le jazz'],
                ['Quel genre musical est associé à Bob Marley ?', 'Le reggae'],
                ['Quel genre musical a émergé à Detroit dans les années 1980 ?', 'La techno'],
                ['Quel genre musical est caractérisé par des paroles improvisées ?', 'Le rap'],
                ['Quel genre musical est connu pour l\'utilisation de la guitare électrique ?', 'Le rock']
            ],
            'Instruments' => [
                ['Quel instrument a 88 touches ?', 'Le piano'],
                ['Quel instrument est connu comme le "roi des instruments" ?', 'L\'orgue'],
                ['Quel instrument est utilisé dans le flamenco ?', 'La guitare'],
                ['Quel instrument à vent est utilisé dans le jazz ?', 'Le saxophone'],
                ['Quel instrument de percussion est utilisé dans la samba ?', 'Le tambour']
            ],
            'Artistes célèbres' => [
                ['Qui est le "Roi de la Pop" ?', 'Michael Jackson'],
                ['Quel artiste est connu pour "Purple Rain" ?', 'Prince'],
                ['Qui est la chanteuse principale de Destiny\'s Child ?', 'Beyoncé'],
                ['Quel groupe a chanté "Bohemian Rhapsody" ?', 'Queen'],
                ['Quel compositeur a écrit la symphonie "La Neuvième Symphonie" ?', 'Ludwig van Beethoven']
            ]
        ];

        $themeQuestions = $questionsAndAnswers[$theme->name] ?? [['Question générique ?', 'Réponse générique']];

        $qa = $this->faker->randomElement($themeQuestions);

        return [
            'front' => $qa[0],
            'back' => $qa[1],
            'theme_id' => $theme->id, // Associe la carte à un thème existant
        ];
    }
}
