# 🎉 Eventy

**Eventy** est une plateforme web de gestion d'événements développée avec **Laravel**. Elle est composée de deux applications indépendantes :

- **`eventadmin`** : le back-office pour administrer les événements et les utilisateurs ;
- **`eventuser`** : l'espace public où les utilisateurs découvrent les événements, s'y inscrivent et publient les leurs.

<!-- Ajoute ici une capture d'écran : ![Aperçu d'Eventy](docs/screenshot.png) -->

---

## 📑 Sommaire

- [Fonctionnalités](#-fonctionnalités)
- [Technologies utilisées](#-technologies-utilisées)
- [Structure du projet](#-structure-du-projet)
- [Prérequis](#-prérequis)
- [Installation](#-installation)
- [Lancer le projet](#-lancer-le-projet)

---

## ✨ Fonctionnalités

### 🛠️ Application d'administration (`eventadmin`)

- Authentification (inscription, connexion, déconnexion, réinitialisation du mot de passe)
- **Gestion des événements** : ajout, modification, suppression, avec image
- **Gestion des utilisateurs** : ajout, modification, suppression, avec photo
- **Blocage / déblocage** d'un utilisateur
- Page d'accueil (landing page) de présentation

### 👤 Application utilisateur (`eventuser`)

- Authentification (inscription, connexion, déconnexion, réinitialisation du mot de passe)
- Consultation de la **liste des événements** (titre, catégorie, lieu, dates, description, image)
- **Inscription à un événement** (sans doublon)
- Liste de **mes événements inscrits**
- **Création d'événements** par l'utilisateur
- **Gestion de mes événements** : modification et suppression des événements que j'ai créés
- Page d'accueil (landing page) de présentation

---

## 🧰 Technologies utilisées

| Domaine | Technologies |
| --- | --- |
| Back-end | PHP ^8.1, Laravel 10, Laravel UI (authentification), Laravel Sanctum |
| Base de données | MySQL |
| Front-end | Blade, Bootstrap 5, Sass, Axios |
| Build | Vite |
| Calendrier | FullCalendar (admin) |
| Qualité / tests | PHPUnit, Laravel Pint |

---

## 📂 Structure du projet

```
Eventy/
├── eventadmin/          # Application d'administration (Laravel)
│   ├── app/             # Contrôleurs (Event, Utilisateur, Auth…) et modèles
│   ├── database/        # Migrations (events, utilisateurs…)
│   ├── resources/views/ # Vues Blade (liste-event, add-event, calendar, liste-user…)
│   ├── routes/web.php
│   └── public/          # Assets et images uploadées (images/events, images/utilisateurs)
├── eventuser/           # Application utilisateur (Laravel)
│   ├── app/
│   ├── database/        # Migrations (events, event_user…)
│   ├── resources/views/ # Vues Blade (liste-event, gerer-event, liste-evenementinscrit…)
│   ├── routes/web.php
│   └── public/
└── README.md
```

---

## ✅ Prérequis

- [PHP](https://www.php.net/) ≥ 8.1
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/) et npm
- [MySQL](https://www.mysql.com/)  Laragon
- [Git](https://git-scm.com/)

---

## 🚀 Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/ranimbr/Eventy.git
cd Eventy
```

### 2. Installer `eventadmin`

```bash
cd eventadmin
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Ouvre le fichier `.env` et configure la base de données :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=eventadmin
DB_USERNAME=root
DB_PASSWORD=
```

Crée la base de données `eventadmin` dans MySQL, puis lance les migrations :

```bash
php artisan migrate
```

### 3. Installer `eventuser`

```bash
cd ../eventuser
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configure le `.env` avec le nom de la base de données de cette application, puis :

```bash
php artisan migrate
```

> 💡 Chaque application a son propre fichier `.env` et ses propres migrations. Veille à ce que le dossier `public/images/events` soit accessible en écriture, car les images des événements y sont enregistrées.

---

## ▶️ Lancer le projet

Dans deux terminaux séparés :

**Application d'administration**

```bash
cd eventadmin
npm run dev            # ou npm run build
php artisan serve --port=8000
```

→ http://localhost:8000

**Application utilisateur**

```bash
cd eventuser
npm run dev            # ou npm run build
php artisan serve --port=8001
```

→ http://localhost:8001

Crée ensuite un compte depuis la page `/register` de chaque application, puis connecte-toi sur `/login`.

---


## 📄 Licence

Ce projet est basé sur le framework [Laravel](https://laravel.com), distribué sous licence MIT.
<!-- Ajoute un fichier LICENSE à la racine si tu souhaites préciser la licence de ton projet. -->
