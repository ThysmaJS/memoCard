
# 📚 MemoCard

Ce projet est une application web utilisant **VueJS** pour le front-end et **Laravel** pour le back-end dans le cadre d'un projet scolaire. Les données sont générées à l'aide de factories et seeders, et l'ensemble du projet est dockerisé pour une configuration facile.

## 🔧 Prérequis

- 🐳 Docker
- 🐳 Docker Compose

## 🚀 Installation et Configuration

### 1. Cloner le dépôt

```sh
git clone https://github.com/ThysmaJS/memoCard.git
cd memoCard
```

### 2. Configuration des variables d'environnement

Copiez le fichier `.env.example` pour créer votre fichier `.env` :

```sh
cp .env.example .env
```

### 3. Construire et lancer les conteneurs Docker

```sh
docker-compose up --build -d
```

### 4. Installer les dépendances

#### Backend Laravel

```sh
docker-compose exec app composer install
docker-compose exec app php artisan key:generate
```

#### Frontend VueJS

```sh
docker-compose exec frontend npm install
```

### 5. Générer les données avec les Seeders

```sh
docker-compose exec app php artisan migrate --seed
```

### 6. 🌟 Création de l'utilisateur spécifique

Pour le bon déroulement de l'application, utilisez ces identifiants pour vous connecter à l'application :

- **Email**: gary@gary.com
- **Mot de passe**: gary

## 🌐 Utilisation

- **Frontend** : [http://localhost:8081](http://localhost:8081)
- **Backend API** : [http://localhost:8000](http://localhost:8000)

## 🔍 Commandes Utiles

### ▶️ Démarrer les conteneurs

```sh
docker-compose up -d
```

### ⏹️ Arrêter les conteneurs

```sh
docker-compose down
```
