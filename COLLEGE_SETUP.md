# College Website - Laravel 12

Ce projet transforme le template HTML College en une application Laravel 12 complète avec Blade, routes et assets.

## Structure du Projet

### Dossiers Créés

#### 1. **resources/views/layouts/**
- `base.blade.php` - Layout principal avec header et footer

#### 2. **resources/views/pages/**
Toutes les pages du site en tant que vues Blade:
- `home.blade.php` - Accueil
- `about.blade.php` - À propos
- `admissions.blade.php` - Admissions
- `academics.blade.php` - Académique
- `faculty-staff.blade.php` - Équipe pédagogique
- `campus-facilities.blade.php` - Campus et installations
- `students-life.blade.php` - Vie étudiante
- `news.blade.php` - Actualités
- `news-details.blade.php` - Détails d'une actualité
- `events.blade.php` - Événements
- `event-details.blade.php` - Détails d'un événement
- `alumni.blade.php` - Réseau des anciens
- `contact.blade.php` - Contactez-nous
- `privacy.blade.php` - Politique de confidentialité
- `terms-of-service.blade.php` - Conditions d'utilisation
- `error-404.blade.php` - Page d'erreur 404
- `starter-page.blade.php` - Page de démarrage

#### 3. **public/assets/**
- `css/` - Feuilles de style CSS
- `js/` - Scripts JavaScript
- `img/` - Images (blog, éducation, personnes)
- `vendor/` - Bibliothèques externes (Bootstrap, Swiper, AOS, etc.)
- `scss/` - Fichiers SCSS source

#### 4. **routes/web.php**
Toutes les routes du site avec noms pour faciliter la navigation:
- `home` - Accueil (/)
- `about` - À propos (/about)
- `admissions` - Admissions (/admissions)
- `academics` - Académique (/academics)
- `faculty-staff` - Équipe pédagogique (/faculty-staff)
- `campus-facilities` - Campus (/campus-facilities)
- `students-life` - Vie étudiante (/students-life)
- `news` - Actualités (/news)
- `news-details` - Détails (/news-details)
- `events` - Événements (/events)
- `event-details` - Détails (/event-details)
- `alumni` - Réseau (/alumni)
- `contact` - Contact (/contact)
- `contact.submit` - Soumission contact (POST /contact/submit)
- `privacy` - Confidentialité (/privacy)
- `terms-of-service` - CGU (/terms-of-service)
- `error-404` - Erreur 404 (/error-404)
- `starter-page` - Démarrage (/starter-page)

## Features

✅ **Layout Blade Réutilisable**
- Header avec navigation responsive
- Footer avec liens utiles
- Intégration des assets

✅ **17 Pages Complètes**
- Chaque page hérite du layout de base
- Navigation cohérente
- Liens dynamiques utilisant les noms de routes

✅ **Assets Organisés**
- Bootstrap 5.3.6
- Swiper pour les carrousels
- AOS pour les animations
- GLightbox pour les galeries
- Font Awesome Icons
- CSS et JS personnalisés

✅ **Routes Nommées**
- Utilisation de `route()` pour tous les liens
- Facilite les refactorisations
- Navigation dynamique cohérente

## Installation

1. Vérifiez que PHP 8.2+ et Laravel 12 sont installés
2. Les assets sont déjà dans `public/assets/`
3. Les vues Blade sont dans `resources/views/pages/` et `resources/views/layouts/`
4. Les routes sont configurées dans `routes/web.php`

## Utilisation

### Accéder au site
```bash
php artisan serve
# Visiter http://localhost:8000
```

### Créer de nouvelles pages
1. Créer un fichier `.blade.php` dans `resources/views/pages/`
2. Utiliser `@extends('layouts.base')` et `@section('content')`
3. Ajouter la route dans `routes/web.php` avec un nom significatif
4. Utiliser `route('nom-route')` dans les liens

### Modifier le layout
Éditer `resources/views/layouts/base.blade.php`:
- Header: Ligne 46-109
- Footer: Ligne 115-188

## Technologies Utilisées

- **Framework**: Laravel 12
- **Template Engine**: Blade
- **CSS**: Bootstrap 5.3.6
- **JS**: Vanilla JS avec Swiper, AOS, GLightbox
- **Icons**: Bootstrap Icons

## Notes

- Les images sont des placeholders du template original
- Les formulaires de contact sont configurés pour la redirection (POST)
- Les styles et interactions sont entièrement fonctionnels
- Le design est responsive (mobile, tablet, desktop)

## Développement Futur

- [ ] Créer des contrôleurs pour la logique métier
- [ ] Configurer une base de données pour les contenus dynamiques
- [ ] Ajouter un système d'authentification
- [ ] Intégrer un système de gestion de contenu (CMS)
- [ ] Ajouter des tests unitaires et fonctionnels

---

**Créé le**: Décembre 2025
**Template Original**: College Bootstrap Template (BootstrapMade)
