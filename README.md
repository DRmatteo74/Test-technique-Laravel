# Test technique : Réseau social (sous Laravel)


## Importer le projet

### Prérequis :
- Le projet (via git)
- Serveur MySQL

### Installation de Laravel

- Commencez par installer [WAMP](https://www.wampserver.com/) (Windows Apache MySQL PHP) ou MAMP (MAC .....) ou XAMPP (multi-plateforme)
- Ensuite installer [Composer](https://getcomposer.org/)
- Clonez le projet via git
- Accédez au répertoire du projet et ouvrez un terminal
- Dans le terminal entrez la commande ``` composer install ```
- Installez également [NodeJS](https://nodejs.org/en) 

### Initialisation du projet

- Créez un fichier ```.env``` en copiant le fichier ```.env.example```
- Entrez la configuration de votre serveur MySQL
- Exécutez les migrations pour créer les tables en base de données : ```php artisan migrate```
- Si vous souhaitez des données de test, vous pouvez exécuter la commande suivante : ```php artisan db:seed```
- Installez les dépendances Front-end : ```npm install```
- Compilation des ressources front-end (si nécessaire) : ```npm run dev```
- Démarrez le projet : ```php artisan serve```
