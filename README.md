# WiLink-Tickets

Système de gestion et de vente de tickets pour hotspots WiFi, développé avec le framework Laravel.

## Fonctionnalités Principales

-   **Vente de tickets en ligne** avec intégration probable de paiement mobile.
-   **Génération de tickets d'accès** (nom d'utilisateur / mot de passe).
-   **Panneau d'administration complet** pour la gestion du service.
-   **Gestion des hotspots WiFi** et des **grilles tarifaires**.
-   **Suivi des paiements** et de l'historique des transactions.
-   **Importation de tickets en masse** depuis des fichiers CSV.
-   **Système de revendeurs** avec gestion de soldes et de demandes de retrait.

---

## Comment ça fonctionne ?

L'application est divisée en deux interfaces distinctes : une pour le client final et une pour l'administrateur.

### 1. Le Parcours du Client Final

L'objectif du client est d'acheter un code pour se connecter au WiFi.

1.  **Choix du forfait** : Le client choisit un forfait parmi ceux proposés (ex: "1 Heure", "1 Jour").
2.  **Paiement** : Il est redirigé vers une page pour payer, probablement via son numéro de téléphone (paiement mobile).
3.  **Confirmation** : Une fois le paiement validé sur son téléphone, l'application reçoit une confirmation.
4.  **Génération du Ticket** : L'application génère instantanément un ticket avec un nom d'utilisateur et un mot de passe uniques.
5.  **Affichage** : Le client voit son ticket à l'écran et peut télécharger un reçu en PDF. Une fonction de récupération de ticket est également disponible.

### 2. Le Parcours de l'Administrateur

L'administrateur se connecte à un tableau de bord pour piloter l'ensemble du service.

1.  **Configuration** : Il peut ajouter/modifier les points d'accès WiFi et créer/mettre à jour les tarifs (prix, durée, etc.).
2.  **Gestion des Opérations** :
    -   Il consulte la liste de tous les tickets générés et leur statut.
    -   Il peut importer des tickets en masse (pour la vente physique, par exemple).
    -   Il suit en temps réel l'historique de toutes les transactions financières.
3.  **Gestion des Revendeurs** :
    -   Il gère les comptes des revendeurs.
    -   Il suit leur solde qui augmente à chaque vente.
    -   Il valide et traite leurs demandes de retrait d'argent.

---

## Installation et Lancement en Local

Voici les étapes pour faire tourner le projet sur une machine de développement.

### Prérequis

-   PHP (>= 8.0)
-   Composer
-   Node.js & NPM
-   Une base de données (MySQL ou MariaDB)

### Étapes

1.  **Installer les dépendances PHP :**
    ```bash
    composer install
    ```

2.  **Installer les dépendances frontend :**
    ```bash
    npm install
    ```

3.  **Configurer l'environnement :**
    -   Copiez le fichier d'exemple : `cp .env.example .env`
    -   Générez la clé d'application : `php artisan key:generate`

4.  **Base de données :**
    -   Dans le fichier `.env`, configurez les accès à votre base de données locale (DB_DATABASE, DB_USERNAME, DB_PASSWORD).
    -   Lancez les migrations pour créer les tables :
        ```bash
        php artisan migrate
        ```

5.  **Lancer les serveurs de développement :**
    -   Dans un premier terminal, lancez le serveur PHP :
        ```bash
        php artisan serve
        ```
    -   (Optionnel) Si vous modifiez le frontend (CSS/JS), lancez le serveur Vite dans un second terminal :
        ```bash
        npm run dev
        ```

L'application sera accessible sur `http://127.0.0.1:8000`.
