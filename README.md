# YouQuote API

YouQuote est une API qui permet de gérer des citations. Elle permet aux utilisateurs de créer, lire, mettre à jour, et supprimer des citations, ainsi que d'obtenir des citations aléatoires et de filtrer les citations en fonction de la longueur. De plus, l'API suit la popularité des citations les plus demandées et offre une fonctionnalité bonus de génération d'images pour les citations populaires. L'authentification est une fonctionnalité bonus qui permet aux utilisateurs de gérer leurs propres citations de manière sécurisée.

## Fonctionnalités Requises

### Gestion des Citations (CRUD)

Les utilisateurs peuvent créer, lire, mettre à jour et supprimer des citations. Cela permet à l'API de maintenir une base de données dynamique de citations gérables.

### Citations Aléatoires

L'API peut générer une ou plusieurs citations aléatoires sur demande. Cela permet aux utilisateurs d'obtenir une citation inspirante de manière aléatoire.

### Filtrage des Citations par Longueur

Les utilisateurs peuvent filtrer les citations selon leur nombre de mots, permettant une recherche plus précise et ciblée des citations.

### Suivi de la Popularité des Citations

L'API suit et enregistre la fréquence des demandes pour chaque citation. Les citations les plus demandées sont considérées comme populaires.

## Bonus Fonctionnalités

### Authentification

L'authentification permet aux utilisateurs de s'inscrire, se connecter et gérer leurs citations de manière sécurisée. Cette fonctionnalité est optionnelle et peut être utilisée pour gérer des citations personnelles, suivre la popularité individuelle et limiter l'accès à certaines fonctionnalités.

## Installation

1. Clonez ce dépôt
2. Exécutez `composer install`
3. Copiez `.env.example` vers `.env` et configurez votre base de données
4. Exécutez `php artisan key:generate`
5. Exécutez `php artisan migrate`
6. Exécutez `php artisan serve` pour démarrer le serveur

## Utilisation de l'API

### Authentification

-   POST `/api/register` - Créer un nouveau compte
-   POST `/api/login` - Se connecter et obtenir un token
-   POST `/api/logout` - Se déconnecter (nécessite authentification)
-   GET `/api/user` - Obtenir les informations de l'utilisateur connecté (nécessite authentification)

### Gestion des Citations

-   GET `/api/citations` - Obtenir toutes les citations
-   GET `/api/citations/{id}` - Obtenir une citation spécifique
-   POST `/api/citations` - Créer une nouvelle citation (nécessite authentification)
-   PUT `/api/citations/{id}` - Mettre à jour une citation (nécessite authentification et propriété)
-   DELETE `/api/citations/{id}` - Supprimer une citation (nécessite authentification et propriété)

### Fonctionnalités Spéciales

-   GET `/api/citations/random` - Obtenir une citation aléatoire
-   GET `/api/citations/word_count?word_count=10` - Obtenir des citations avec 10 mots ou moins
-   GET `/api/citations/popular` - Obtenir les citations les plus populaires

## Sécurité

L'API utilise Laravel Sanctum pour l'authentification par token. Pour les routes protégées, incluez le token dans l'en-tête de la requête :

Authorization: Bearer your_token_here
