+++

MemoCard
Ce projet est une application web utilisant VueJS pour le front-end et Laravel pour le back-end dans le cadre d'un projet scolaire. 
Les données sont générées à l'aide de factories et seeders, et l'ensemble du projet est dockerisé pour une configuration facile.

Prérequis
Docker
Docker Compose
Installation et Configuration
1. Cloner le dépôt

git clone https://github.com/ThysmaJS/memoCard.git

cd votre-repo

3. Configuration des variables d'environnement
4. 
Copiez le fichier .env.example pour créer votre fichier .env :

cp .env.example .env

3. Construire et lancer les conteneurs Docker

docker-compose up --build -d
4. Installer les dépendances

Backend Laravel

docker-compose exec app composer install
docker-compose exec app php artisan key:generate

Frontend VueJS

docker-compose exec frontend npm install

5. Générer les données avec les Seeders

docker-compose exec app php artisan migrate --seed

6. Création de l'utilisateur spécifique
Un utilisateur spécifique avec les informations suivantes est créé automatiquement :

Email: gary@gary.com
Mot de passe: gary

Utilisation
Accéder à l'application
Frontend : http://localhost:8081
Backend API : http://localhost:8000

Commandes Utiles

Démarrer les conteneurs :

docker-compose up -d

Arrêter les conteneurs :

docker-compose down

+++
