# Faso-Wifi - Gestion de Vente de Tickets WiFi

Faso-Wifi est une application web développée avec le framework Laravel 9, conçue pour la gestion et la vente de tickets d'accès WiFi. Elle permet aux administrateurs de créer et gérer des points d'accès WiFi, de définir des tarifs, de générer des tickets, de suivre les ventes et de gérer les revenus générés.

## Fonctionnalités Principales

- **Gestion Multi-vendeurs** : Chaque utilisateur enregistré peut gérer ses propres points WiFi et ses ventes.
- **Points WiFi** : Créez et configurez plusieurs services ou points d'accès WiFi.
- **Gestion des Tarifs** : Définissez des forfaits flexibles (par durée, par data, etc.) avec des montants spécifiques pour chaque point WiFi.
- **Génération de Tickets** : Générez des tickets uniques avec un nom d'utilisateur et un mot de passe pour la connexion.
- **Portail Client** : Une interface publique permet aux clients d'acheter des tickets et de payer via des moyens de paiement mobile.
- **Suivi des Paiements** : Enregistrement et suivi de chaque transaction.
- **Gestion de Solde** : Chaque vendeur dispose d'un solde qui est crédité après chaque vente.
- **Demandes de Retrait** : Les vendeurs peuvent demander le retrait de leur solde.
- **Reçus PDF** : Génération automatique de reçus au format PDF après un achat.
- **Import/Export de Données** : Fonctionnalités pour importer ou exporter des données en format CSV/Excel.

## Stack Technique

- **Backend**:
  - PHP 8
  - Laravel 9
  - Laravel Sanctum (pour l'authentification API)
  - Barryvdh/laravel-dompdf (pour la génération de PDF)
  - Maatwebsite/excel (pour l'import/export)

- **Frontend**:
  - Vite
  - Bootstrap 5
  - Sass
  - Axios

## Installation

1.  **Cloner le dépôt**
    ```bash
    git clone https://github.com/votre-utilisateur/faso-wifi.git
    cd faso-wifi
    ```

2.  **Installer les dépendances**
    ```bash
    composer install
    npm install
    ```

3.  **Configuration de l'environnement**
    ```bash
    cp .env.example .env
    ```
    Ensuite, configurez votre base de données et les autres variables d'environnement dans le fichier `.env`.

4.  **Générer la clé d'application**
    ```bash
    php artisan key:generate
    ```

5.  **Lancer les migrations**
    ```bash
    php artisan migrate
    ```

6.  **Compiler les assets frontend**
    ```bash
    # Pour le développement
    npm run dev

    # Pour la production
    npm run build
    ```

7.  **Lancer le serveur**
    ```bash
    php artisan serve
    ```

L'application sera accessible à l'adresse `http://127.0.0.1:8000`.