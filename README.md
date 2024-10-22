# Projet Symfony API Pokémon

## Configuration de l'environnement

Pour que l'application fonctionne correctement, vous devez configurer un fichier `.env` contenant les variables d'environnement nécessaires.

### Étapes de configuration

1. **Copiez le fichier `.env.dist` en `.env`**  

APP_SECRET : Générez une clé secrète unique pour la sécurité. Vous pouvez utiliser la commande suivante pour générer une clé aléatoire :

php -r 'echo bin2hex(random_bytes(16));'

DATABASE_URL : Configurez l'URL de votre base de données

CORS_ALLOW_ORIGIN : Ce paramètre est déjà configuré pour accepter les requêtes provenant de localhost et 127.0.0.1. Vous n'avez pas besoin de le modifier si vous travaillez en local.

## Installation

cd api

docker-compose up --build

docker-compose exec app php bin/console doctrine:migrations:migrate

http://localhost:8000/fetch-pokemons :  Cela exécute la méthode pour récupérer les Pokémon et devrait afficher un message en réponse.

http://localhost:8000/api  :  Cette documentation permet de tester les endpoints et de découvrir les différentes fonctionnalités de l'API.