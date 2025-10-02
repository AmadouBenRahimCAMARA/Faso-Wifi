# Faso Wifi - Système de Gestion de Tickets WiFi

Faso Wifi est une application web conçue pour gérer la vente de tickets d'accès WiFi. Elle permet aux administrateurs de superviser les points d'accès, de définir des tarifs, de générer des tickets, de suivre les paiements et de gérer les utilisateurs.

## Fonctionnalités Principales

- **Gestion des Utilisateurs :** Inscription, connexion et gestion des comptes utilisateurs avec différents niveaux de droits.
- **Gestion des Points d'Accès WiFi :** CRUD (Créer, Lire, Mettre à jour, Supprimer) pour les différents sites ou zones WiFi.
- **Gestion des Tarifs :** CRUD pour les plans tarifaires (par exemple, par heure, par jour, par volume de données) associés à chaque point d'accès.
- **Gestion des Tickets :**
    - Génération de tickets individuels ou en masse.
    - Importation de listes de tickets depuis des fichiers (CSV/Excel).
    - Suivi de l'état des tickets (utilisé, non utilisé, expiré).
- **Système de Paiement :**
    - Intégration de solutions de paiement mobile pour l'achat de tickets.
    - Suivi des transactions et génération de reçus.
- **Génération de PDF :** Création de reçus de paiement au format PDF pour les clients.
- **Gestion des Retraits :** Permet de suivre et de gérer les retraits de fonds effectués.
- **Tableau de Bord :** Une interface d'administration pour visualiser les statistiques de ventes et l'état du système.

## Technologies et Dépendances

- **Framework :** [Laravel 9](https://laravel.com/)
- **PHP :** version 8.0 ou supérieure
- **Base de données :** Compatible avec MySQL, PostgreSQL, etc.
- **Frontend :** Laravel Blade, CSS, JavaScript.
- **Dépendances PHP principales :**
    - `laravel/ui` : Pour le scaffolding de l'authentification.
    - `maatwebsite/excel` : Pour l'importation et l'exportation de données (CSV, Excel).
    - `barryvdh/laravel-dompdf` : Pour la génération de documents PDF.

## Installation

Suivez ces étapes pour installer et configurer le projet sur votre environnement de développement local.

1.  **Cloner le dépôt**
    ```bash
    git clone https://github.com/votre-utilisateur/faso-wifi.git
    cd faso-wifi
    ```

2.  **Installer les dépendances PHP**
    ```bash
    composer install
    ```

3.  **Installer les dépendances JavaScript**
    ```bash
    npm install
    ```

4.  **Configurer l'environnement**
    Copiez le fichier d'exemple pour l'environnement et générez la clé d'application.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

5.  **Configurer la base de données**
    Modifiez le fichier `.env` avec les informations de connexion à votre base de données (DB_DATABASE, DB_USERNAME, DB_PASSWORD).

6.  **Exécuter les migrations**
    Créez les tables dans la base de données.
    ```bash
    php artisan migrate
    ```

7.  **Lier le stockage**
    Créez le lien symbolique pour le stockage des fichiers publics.
    ```bash
    php artisan storage:link
    ```

## Démarrage

Pour lancer l'application, vous devez démarrer le serveur de développement Laravel et le compilateur d'assets Vite.

1.  **Lancer le serveur de développement**
    ```bash
    php artisan serve
    ```
    L'application sera accessible à l'adresse `http://127.0.0.1:8000`.

2.  **Compiler les assets (CSS/JS)**
    Ouvrez un autre terminal et exécutez la commande suivante pour compiler les assets et les actualiser automatiquement lors des modifications.
    ```bash
    npm run dev
    ```

Le projet est maintenant prêt à être utilisé.