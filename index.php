<?php
session_start(); // Démarre la session pour utiliser les messages flash
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>VR-Rehab: Rééducation Motrice Gamifiée en Réalité Virtuelle</title>
    <link rel="icon" type="image/png" href="favicon.png"> <style>
        /* Base Styles */
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
            color: #444;
            scroll-behavior: smooth;
            overflow-x: hidden;
            font-size: 16px; /* Base font size for better readability */
            line-height: 1.6; /* Improved line height */
        }
        .main-header {
            margin-bottom: 0;
            position: relative;
        }

        /* Banner Styles */
        .cedric-banner {
            position: relative;
            background: #b81c2c;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 20px;
            box-sizing: border-box;
            flex-direction: column;
            text-align: center;
        }
        .banner-content {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            z-index: 2;
            width: 100%;
        }
        .logo-wrapper {
            background-color: #fff;
            border: 2px solid #fff;
            border-radius: 8px;
            padding: 5px 10px;
            display: inline-block;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 10px;
        }
        .banner-logo {
            max-width: 250px;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        .cedric-banner h1 {
            color: #fff;
            font-size: 2.8em;
            font-weight: bold;
            letter-spacing: 1px;
            z-index: 2;
            text-align: center;
            margin: 0;
            line-height: 1.1;
            text-shadow: 0 2px 8px #a00, 0 0 1px #fff;
            padding: 0;
        }
        .cedric-banner .squares {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0; top: 0;
            z-index: 1;
            pointer-events: none;
        }
        .cedric-banner .squares span {
            position: absolute;
            background: rgba(255,255,255,0.7);
            border-radius: 2px;
            opacity: 0.7;
            animation: float 10s linear infinite;
        }
        .cedric-banner .squares span:nth-child(1) {
            width: 38px; height: 38px; left: 10%; top: 30px; animation-delay: 0s;
        }
        .cedric-banner .squares span:nth-child(2) {
            width: 18px; height: 18px; left: 30%; top: 80px; animation-delay: 2s;
        }
        .cedric-banner .squares span:nth-child(3) {
            width: 28px; height: 28px; left: 55%; top: 20px; animation-delay: 4s;
        }
        .cedric-banner .squares span:nth-child(4) {
            width: 14px; height: 14px; left: 70%; top: 60px; animation-delay: 1s;
        }
        .cedric-banner .squares span:nth-child(5) {
            width: 22px; height: 22px; left: 85%; top: 40px; animation-delay: 3s;
        }
        @keyframes float {
            0% { transform: translateY(0);}
            100% { transform: translateY(25px);}
        }

        /* Navigation Styles */
        .main-nav {
            width: 100%;
            background: #bdbdbd;
            color: #fff;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            box-sizing: border-box;
            height: 48px;
            position: sticky;
            top: 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); /* Added shadow for sticky nav */
        }
        .main-nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }
        .main-nav li {
            margin: 0;
        }
        .main-nav a {
            display: block;
            color: #444;
            text-decoration: none;
            font-weight: 600;
            padding: 0.8em 1.3em;
            border-radius: 0;
            transition: background 0.2s, color 0.2s;
            font-size: 1.05em;
        }
        .main-nav a:hover,
        .main-nav a:focus { /* Ensure focus state is clear */
            background: #fff;
            color: #b81c2c;
            outline: 2px solid #b81c2c; /* Explicit focus outline */
            outline-offset: -2px; /* Pull outline inward slightly */
        }
        .main-nav .burger {
            display: none;
        }

        /* Responsive Navigation */
        @media (max-width: 900px) {
            .main-nav ul {
                position: absolute;
                top: 48px;
                right: 0;
                background: #bdbdbd;
                flex-direction: column;
                width: 200px;
                display: none;
                box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15);
                z-index: 1001;
                border-radius: 0 0 8px 8px; /* Added border-radius */
            }
            .main-nav ul.active {
                display: flex;
            }
            .main-nav .burger {
                display: flex;
                flex-direction: column;
                justify-content: center;
                height: 40px;
                width: 40px;
                cursor: pointer;
                margin-left: 1em;
                background: none;
                border: none;
                z-index: 2001;
                padding: 0; /* Remove default button padding */
            }
            .main-nav .burger span {
                height: 4px;
                width: 28px;
                background: #b81c2c;
                margin: 4px 0;
                border-radius: 2px;
                transition: 0.3s;
                display: block;
            }
            .main-nav .burger.active span:nth-child(1) {
                transform: translateY(8px) rotate(45deg);
            }
            .main-nav .burger.active span:nth-child(2) {
                opacity: 0;
            }
            .main-nav .burger.active span:nth-child(3) {
                transform: translateY(-8px) rotate(-45deg);
            }
            .main-nav .burger:focus { /* Explicit focus for burger button */
                outline: 2px solid #b81c2c;
                outline-offset: 2px;
            }
            .stats-row {
                flex-direction: column;
                gap: 8px;
            }
            #présentation .content-wrapper {
                flex-direction: column-reverse;
                align-items: flex-start;
            }
            #présentation iframe {
                width: 100%;
                height: 250px;
                margin-bottom: 20px;
            }
            /* CORRECTION: Override min-width for mobile */
            #présentation .content-wrapper p,
            #présentation iframe {
                min-width: unset; /* Allow elements to shrink below 300px */
            }
            #magemotion {
                flex-direction: column;
            }
            #magemotion .image {
                margin-left: 0;
                margin-top: 20px;
                max-width: 100%;
            }
            .equipe-capsules {
                flex-direction: column;
                gap: 10px;
            }
            .banner-logo {
                max-width: 150px;
            }
            .cedric-banner h1 {
                font-size: 2.2em;
            }
        }
        @media (min-width: 769px) {
            .banner-content {
                flex-direction: row;
                justify-content: center;
                text-align: left;
                gap: 30px;
            }
            .cedric-banner h1 {
                font-size: 3.2em;
                text-align: left;
            }
            #présentation .content-wrapper {
                flex-direction: row;
                align-items: flex-start;
            }
            #présentation iframe {
                height: 315px;
            }
        }

        /* General Section & Container Styles */
        .container {
            max-width: 1200px;
            margin: 40px auto 20px auto;
            padding: 0 20px;
        }
        section {
            background-color: #fff;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
            min-height: 60vh;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
        }
        h2 {
            color: #b81c2c;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-top: 20px;
            margin-bottom: 15px;
            font-size: 2em;
            font-weight: bold;
            letter-spacing: 1px;
        }
        #accueil h2 {
            text-align: center;
            font-size: 2.2em;
            margin-top: 0;
            padding-bottom: 0;
            border-bottom: none;
            transition: font-size 0.3s ease;
        }
        #accueil p {
            font-size: 1.1em;
            color: #444;
            margin: 0;
            line-height: 1.6;
            text-align: center;
            background: #fff;
            border-left: 4px solid #b81c2c;
            padding: 15px 20px;
            border-radius: 0 8px 8px 0;
            margin-top: 20px;
        }

        /* Présentation Section */
        #présentation .content-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-start;
            justify-content: center;
        }
        #présentation .content-wrapper p,
        #présentation iframe {
            flex: 1 1 48%;
            max-width: 100%;
            box-sizing: border-box;
            /* MOVED: min-width: 300px; is now specific to larger screens to allow wrapping */
        }
        @media (min-width: 901px) { /* Apply min-width only on larger screens */
            #présentation .content-wrapper p,
            #présentation iframe {
                min-width: 300px; /* Re-apply for desktop to ensure columns */
            }
        }
        #présentation iframe {
            margin-bottom: 0;
        }

        /* sr-only class for accessibility */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border: 0;
        }

        /* Stats Row */
        .stats-row {
            display: flex;
            gap: 32px;
            margin: 30px 0 0 0;
            flex-wrap: wrap;
            justify-content: center;
        }
        .stats-block {
            flex: 1 1 180px;
            background: #f7f7f7;
            border-radius: 8px;
            text-align: center;
            padding: 18px 0 10px 0;
            margin: 0;
            box-sizing: border-box;
        }
        .stats-block .stat-number {
            font-size: 2.5em;
            color: #b81c2c;
            font-weight: bold;
            line-height: 1;
        }
        .stats-block .stat-label {
            color: #888;
            font-size: 1.1em;
            letter-spacing: 1px;
        }

        /* Equipe Section */
        .equipe-capsules {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
            margin-top: 16px;
        }
        .equipe-capsule {
            background: #fff;
            border: 2px solid #b81c2c;
            border-radius: 32px;
            padding: 12px 28px;
            font-size: 1.1em;
            color: #b81c2c;
            font-weight: bold;
            box-shadow: 0 2px 8px rgba(184,28,44,0.07);
            transition: background 0.2s, color 0.2s;
            margin-bottom: 8px;
            white-space: nowrap;
        }
        .equipe-capsule:hover {
            background: #b81c2c;
            color: #fff;
        }

        /* Contact Form Styles */
        #contact form {
            max-width: 400px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        #contact form label {
            font-weight: 600;
            color: #b81c2c;
            margin-bottom: 4px;
            margin-top: 8px;
        }
        #contact form input:focus,
        #contact form textarea:focus,
        #contact form select:focus,
        #contact button:focus { /* Added focus style for button */
            outline: 2px solid #b81c2c;
            border-color: #b81c2c;
            background: #fffbe6;
            outline-offset: 2px;
        }
        #contact form input[required],
        #contact form textarea[required],
        #contact form select[required] {
            border-left: 4px solid #b81c2c;
        }
        #contact form input,
        #contact form textarea,
        #contact form select {
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1em;
            resize: vertical;
            background-color: #fff;
            color: #444;
        }
        #contact button {
            background: #b81c2c;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 12px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background 0.2s;
        }
        #contact button:hover {
            background: #a00;
        }

        /* Flash Messages */
        .flash-message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 1em;
            font-weight: bold;
            position: relative; /* For screen readers to announce changes */
            role: "alert"; /* ARIA role for live regions */
        }
        .flash-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .flash-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Footer */
        footer {
            background-color: #b81c2c;
            color: #fff;
            text-align: center;
            padding: 1em 0;
            margin-top: 20px;
            font-size: 1.1em;
        }

        /* Next Button */
        .next-btn {
            position: fixed;
            bottom: 32px;
            right: 32px;
            background: #b81c2c;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 56px;
            height: 56px;
            font-size: 2em;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(184, 28, 44, 0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            transition: background 0.2s;
            outline: 2px solid transparent; /* default outline */
            outline-offset: 2px;
        }
        .next-btn:hover {
            background: #a00;
        }
        .next-btn:focus { /* Explicit focus style for next button */
            outline-color: #007bff; /* A distinct color for focus */
            background: #a00;
        }

        /* Learn More Link (re-evaluated for accessibility) */
        .learn-more-link {
            display: inline-block; /* Changed to inline-block for proper padding/margin handling */
            margin-top: 20px;
            margin-bottom: 5px;
            padding: 10px 15px;
            background-color: #b81c2c;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: left; /* Keep original text-align */
            white-space: nowrap; /* Prevent line breaks within the button */
            cursor: pointer; /* Ensure it looks clickable */
            outline: 2px solid transparent; /* Default outline */
            outline-offset: 2px;
        }
        .learn-more-link:hover {
            background-color: #a00;
        }
        .learn-more-link:focus { /* Explicit focus style for learn more link */
            outline-color: #007bff;
            background: #a00;
        }

        /* Gallery Styles */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        .gallery-item {
            cursor: pointer;
            border: 2px solid #eee;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative; /* For overlay text */
        }
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .gallery-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            display: block;
            border-bottom: 2px solid #eee;
        }
        .gallery-item-title {
            padding: 10px;
            font-weight: bold;
            color: #b81c2c;
            font-size: 1.1em;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            padding-top: 50px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.9);
            box-sizing: border-box; /* Ensure padding is included */
            aria-modal: "true"; /* ARIA attribute */
            role: "dialog"; /* ARIA role */
        }
        .modal-content {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }
        .modal-content, #caption {
            animation-name: zoom;
            animation-duration: 0.6s;
        }
        @keyframes zoom {
            from {transform:scale(0)}
            to {transform:scale(1)}
        }
        .modal-close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
            background: none; /* Remove button default styles */
            border: none;
            padding: 0;
            line-height: 1; /* Adjust line height for x icon */
            outline: 2px solid transparent; /* Default outline */
            outline-offset: 2px;
        }
        .modal-close:hover,
        .modal-close:focus { /* Explicit focus style for close button */
            color: #bbb;
            text-decoration: none;
            outline-color: #007bff;
        }
        #caption {
            margin: auto;
            display: block;
            width: 80%;
            max-width: 700px;
            text-align: center;
            color: #ccc;
            padding: 10px 0;
            min-height: 30px; /* Ensure space for caption */
        }
        .magemotion-images {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }
        .magemotion-images img {
            width: 100%;
            max-width: 300px;
            height: auto;
            border: 2px solid #b81c2c;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            display: block;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="cedric-banner">
            <div class="banner-content">
                <div class="logo-wrapper">
                    <img src="Logo1.png" alt="Logo de l'institut Le Cnam Cedric" class="banner-logo" />
                </div>
                <h1>Centre d’études et de recherche<br>en informatique et communications</h1>
            </div>
            <div class="squares" aria-hidden="true"> <span></span><span></span><span></span><span></span><span></span>
            </div>
        </div>
        <nav class="main-nav" aria-label="Navigation principale du site"> <ul>
                <li><a href="#accueil">Accueil</a></li>
                <li><a href="#présentation" aria-label="Accéder à la section Modules et technologie">Modules et technologie</a></li>
                <li><a href="#magemotion" aria-label="Accéder à la section Mage Motion, le mini-jeu thérapeutique">Mage Motion</a></li>
                <li><a href="#gallery" aria-label="Accéder à la Galerie d'images">Galerie d'images</a></li>
                <li><a href="#Equipe" aria-label="Accéder à la section Equipe du projet">Equipe</a></li>
                <li><a href="#contact" aria-label="Accéder à la section Contact">Contact</a></li>
            </ul>
            <button class="burger" aria-label="Ouvrir le menu de navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </nav>
    </header>

    <main id="main-content"> <div class="container">
            <section id="accueil" aria-labelledby="accueil-heading">
                <h2 id="accueil-heading">VR-Rehab</h2>
                <p>
                    VR-Rehab est une application de rééducation motrice en réalité virtuelle pensée pour les enfants atteints d’hémiparésie. Elle s’appuie sur le principe de la thérapie miroir, qui consiste à refléter les mouvements de la main saine sur la main affectée pour stimuler la récupération. L’objectif est de rendre la rééducation plus motivante en combinant des exercices thérapeutiques et des éléments de jeu dans un environnement immersif.
                </p>
                <div class="stats-row">
                    <div class="stats-block">
                        <div class="stat-number">+50%</div>
                        <div class="stat-label">DES ENFANTS VICTIMES D’UN AVC GARDENT DES SÉQUELLES MOTRICES</div>
                    </div>
                    <div class="stats-block">
                        <div class="stat-number">4</div>
                        <div class="stat-label">NOUVEAUX CAS PAR JOUR EN FRANCE</div>
                    </div>
                    <div class="stats-block">
                        <div class="stat-number">3/1000</div>
                        <div class="stat-label">ENFANTS TOUCHÉS PAR LA PARALYSIE CÉRÉBRALE</div>
                    </div>
                    <div class="stats-block">
                        <div class="stat-number">30%</div>
                        <div class="stat-label">DES PARALYSIES CÉRÉBRALES DE L’ENFANT SONT DES HÉMIPLÉGIES</div>
                    </div>
                </div>
                <a href="#présentation" class="learn-more-link" aria-label="En savoir plus sur VR-Rehab et ses objectifs">En savoir plus sur VR-Rehab</a>
            </section>

            <section id="présentation" aria-labelledby="presentation-heading">
                <h2 id="presentation-heading">Modules et technologie</h2>
                <div class="content-wrapper">
                    <p>
                        L’application a été conçue sous Unity, avec une compatibilité multiplateforme assurée par l’utilisation d’OpenXR. Le hand tracking est géré via la bibliothèque XR Hands, optimisée pour les casques Meta Quest 3. Plusieurs modules ont été développés pour structurer les fonctionnalités du système : un module de thérapie miroir permettant de refléter la main saine sur la main affectée (reflet total ou partiel), un test d’ajustement automatique qui mesure les capacités du patient afin d’appliquer un gain personnalisé, et un module d’enregistrement des données de mouvement pour le suivi des progrès. Des outils de personnalisation permettent aussi de configurer les gestes à réaliser, les paramètres audio ou encore la langue de l’interface. Bien qu’une étude ait été menée pour intégrer un Leap Motion Controller afin d'améliorer la précision du suivi des mains, cette piste a été abandonnée en raison de limitations techniques.
                    </p>
                    <iframe
                        width="560"
                        height="315"
                        src="VOTRE_VERITABLE_URL_YOUTUBE_EMBED_ICI" title="Démonstration de VR-Rehab : Rééducation Motrice Gamifiée"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                        referrerpolicy="strict-origin-when-cross-origin"
                        allowfullscreen
                    ></iframe>
                    <p class="sr-only">Une transcription ou un résumé de la vidéo, incluant des informations détaillées sur le suivi des mouvements, est disponible sur <a href="https://www.meta.com/fr-fr/help/quest/290147772643252/?srsltid=AfmBOopPyZg3mbZ3QiEKquwEBBH2kNxO9hVDXd5uij7eh-bGtDpfDIN3" target="_blank" rel="noopener noreferrer">cette page d'aide de Meta Quest</a>.</p>
                </div>
                <a href="#magemotion" class="learn-more-link" aria-label="En savoir plus sur les modules VR-Rehab et la technologie utilisée">En savoir plus sur les modules</a>
            </section>

            <section id="magemotion" aria-labelledby="magemotion-heading">
                <h2 id="magemotion-heading">Mage Motion</h2>
                <div class="texte">
                    <p>
                    <strong>1. Introduction</strong><br />
                    MageMotion est un mini-jeu thérapeutique intégré à l’application, conçu sous forme de Tower Defense pour rendre la rééducation plus attractive. Le joueur y incarne un magicien chargé de défendre une tour contre des vagues d’ennemis. Pour les vaincre, il doit exécuter des gestes spécifiques inspirés des exercices de rééducation motrice : fermer le poing, effectuer une supination, saisir et lancer un objet, ou encore pointer une cible. Ces gestes doivent être réalisés avec précision dans une zone bien définie, permettant à la fois le suivi par le casque et l’observation par le patient.<br /><br />
                    <strong>2. Concept et description du jeu</strong><br>
                    MageMotion représente ainsi l’alliance entre exigence clinique et plaisir de jeu, en rendant les exercices moteurs à la fois utiles et ludiques.
                    </p>
                </div>
                 <div class="gallery-grid">
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image du gameplay de MageMotion">
                        <img src="mage_motion_gameplay1.png" alt="Capture d'écran du gameplay de MageMotion montrant le joueur lançant un sort sur des ennemis.">
                        <div class="gallery-item-title">Gameplay MageMotion</div>
                    </div>
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image de la boutique d'équipement">
                        <img src="mage_motion_gameplay3.png" alt="Capture d'écran de la boutique d'équipement du jeu, affichant des objets à acheter.">
                        <div class="gallery-item-title">Boutique d'équipement</div>
                    </div>
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image de l'organigramme du gameplay">
                        <img src="mage_motion_gameplay2.png" alt="Diagramme de flux expliquant l'organigramme du gameplay de MageMotion.">
                        <div class="gallery-item-title">Organigramme Gameplay</div>
                    </div>
                </div>
                <a href="#gallery" class="learn-more-link" aria-label="En savoir plus sur le mini-jeu Mage Motion">En savoir plus sur Mage Motion</a>
            </section>

            <section id="gallery" aria-labelledby="gallery-heading">
                <h2 id="gallery-heading">Galerie d'images</h2>
                <div class="gallery-grid">
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image du Menu principal">
                        <img src="image1.png" alt="Capture d'écran du menu principal de l'application VR-Rehab.">
                        <div class="gallery-item-title">Menu principal</div>
                    </div>
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image de l'interface du tutoriel">
                        <img src="image2.png" alt="Capture d'écran de l'interface du tutoriel de l'application, guidant l'utilisateur.">
                        <div class="gallery-item-title">Interface du tutoriel</div>
                    </div>
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image de la zone de délimitation">
                        <img src="image3.png" alt="Capture d'écran montrant la zone de délimitation de mouvement en réalité virtuelle.">
                        <div class="gallery-item-title">Zone de délimitation</div>
                    </div>
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image du menu des paramètres">
                        <img src="image4.png" alt="Capture d'écran du menu des paramètres de l'application VR-Rehab.">
                        <div class="gallery-item-title">Menu des paramètres</div>
                    </div>
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image du test d'ajustement">
                        <img src="image5.png" alt="Capture d'écran du test d'ajustement automatique des capacités du patient.">
                        <div class="gallery-item-title">Test d'ajustement</div>
                    </div>
                    <div class="gallery-item" tabindex="0" role="button" aria-label="Ouvrir l'image des modèles 3D des ennemis">
                        <img src="image6.png" alt="Vue des modèles 3D des personnages ennemis dans le jeu MageMotion.">
                        <div class="gallery-item-title">Modèles 3D des ennemis</div>
                    </div>
                </div>
            </section>

            <section id="Equipe" aria-labelledby="equipe-heading">
                <h2 id="equipe-heading">Equipe</h2>
                <div class="equipe-capsules">
                    <div class="equipe-capsule">Verhulst Eulalie</div>
                    <div class="equipe-capsule">Pons Olivier</div>
                    <div class="equipe-capsule">Niakate Youssouf</div>
                    <div class="equipe-capsule">Deplaude Lucie</div>
                    <div class="equipe-capsule">Ornato Siméon</div>
                    <div class="equipe-capsule">Vonsen Raphaël</div>
                    <div class="equipe-capsule">Roig Thomas</div>
                    <div class="equipe-capsule">Hu Tony</div>
                </div>
            </section>

            <section id="contact" aria-labelledby="contact-heading">
                <h2 id="contact-heading">Contact</h2>
                <?php
                // Affichage des messages flash (ajout de aria-live pour l'accessibilité)
                if (isset($_SESSION['form_message'])) {
                    $message_type = isset($_SESSION['form_message_type']) ? $_SESSION['form_message_type'] : 'info';
                    // Ajout de role="alert" et aria-live="polite" pour que les lecteurs d'écran annoncent le message
                    echo '<div class="flash-message ' . $message_type . '" role="alert" aria-live="polite">' . $_SESSION['form_message'] . '</div>';
                    unset($_SESSION['form_message']); // Supprime le message après l'affichage
                    unset($_SESSION['form_message_type']);
                }
                ?>
                <form id="contactForm" method="POST" action="process_form.php" autocomplete="on" novalidate>
                    <label for="nom">Nom <span aria-hidden="true">*</span></label>
                    <input type="text" id="nom" name="nom" placeholder="Votre nom" required aria-required="true"/>

                    <label for="email">Email <span aria-hidden="true">*</span></label>
                    <input type="email" id="email" name="email" placeholder="Votre email" required aria-required="true"/>

                    <label for="objet">Objet <span aria-hidden="true">*</span></label>
                    <select id="objet" name="objet" required aria-required="true">
                        <option value="" disabled selected>Sélectionnez un objet</option>
                        <option value="Demande d'informations">Demande d'informations</option>
                        <option value="Partenariat">Partenariat</option>
                        <option value="Support technique">Support technique</option>
                        <option value="Proposition de stage">Proposition de stage</option>
                        <option value="Demande de collaboration">Demande de collaboration</option>
                        <option value="Autre">Autre</option>
                    </select>

                    <label for="message">Message <span aria-hidden="true">*</span></label>
                    <textarea id="message" name="message" rows="5" placeholder="Votre message..." required aria-required="true"></textarea>

                    <button type="submit">Envoyer</button>
                </form>
            </section>
        </div>
    </main>

    <div id="imageModal" class="modal" role="dialog" aria-modal="true" aria-labelledby="modalCaption">
        <button class="modal-close" aria-label="Fermer la fenêtre modale">×</button>
        <img class="modal-content" id="img01" alt=""> <div id="caption" aria-live="polite"></div> </div>

    <button class="next-btn" aria-label="Aller à la section suivante">↓</button>

    <footer>
        <p>© 2025 . All rights reserved.</p>
    </footer>

    <script>
        // Fonction pour déplacer le focus au début du contenu principal
        // Utile pour les utilisateurs de lecteurs d'écran qui veulent sauter la navigation répétitive
        document.addEventListener('DOMContentLoaded', () => {
            const skipLink = document.createElement('a');
            skipLink.href = '#main-content';
            skipLink.textContent = 'Passer au contenu principal';
            skipLink.classList.add('skip-link'); // Ajout d'une classe pour stylisation CSS
            // Positionner le lien avant le header pour qu'il soit le premier élément focusable
            document.body.prepend(skipLink);

            // Petit CSS pour le skip link (à ajouter à votre bloc <style>)
            const style = document.createElement('style');
            style.textContent = `
                .skip-link {
                    position: absolute;
                    left: -9999px; /* Hide off-screen */
                    top: auto;
                    width: 1px;
                    height: 1px;
                    overflow: hidden;
                    z-index: 9999;
                    background-color: #f7f7f7;
                    color: #b81c2c;
                    padding: 8px;
                    border: 1px solid #b81c2c;
                    text-decoration: none;
                    font-weight: bold;
                    border-radius: 4px;
                }
                .skip-link:focus {
                    left: 0;
                    top: 0;
                    width: auto;
                    height: auto;
                    outline: 2px solid #007bff;
                    outline-offset: 2px;
                }
            `;
            document.head.appendChild(style);
        });


        (function() {
            const burger = document.querySelector('.main-nav .burger');
            const navList = document.querySelector('.main-nav ul');
            if (burger && navList) {
                burger.addEventListener('click', function () {
                    const isExpanded = this.getAttribute('aria-expanded') === 'true' || false;
                    this.setAttribute('aria-expanded', !isExpanded);
                    navList.classList.toggle('active');
                });
                navList.querySelectorAll('a').forEach(link => {
                    link.addEventListener('click', () => {
                        burger.setAttribute('aria-expanded', 'false');
                        navList.classList.remove('active');
                    });
                });
            }
        })();

        (function() {
            const sections = Array.from(document.querySelectorAll("section"));
            const nextBtn = document.querySelector(".next-btn");
            if (!sections.length || !nextBtn) return;

            function getCurrentSectionIndex() {
                const scrollY = window.scrollY;
                let idx = 0;
                for (let i = 0; i < sections.length; i++) {
                    // Adjust threshold for when section is considered "current"
                    if (sections[i].offsetTop - window.innerHeight / 3 > scrollY) break;
                    idx = i;
                }
                return idx;
            }
            nextBtn.addEventListener("click", () => {
                const idx = getCurrentSectionIndex();
                if (idx < sections.length - 1) {
                    sections[idx + 1].scrollIntoView({ behavior: "smooth" });
                }
            });
            window.addEventListener("scroll", () => {
                const idx = getCurrentSectionIndex();
                if (idx >= sections.length - 1) {
                    nextBtn.style.display = "none";
                } else {
                    nextBtn.style.display = "flex";
                }
            });
            // Initial check on load
            window.dispatchEvent(new Event('scroll'));
        })();

        // Gallery Modal Logic - Améliorations majeures ici
        (function() {
            const modal = document.getElementById("imageModal");
            const modalImg = document.getElementById("img01");
            const captionText = document.getElementById("caption");
            const clickableItems = document.querySelectorAll(".gallery-item"); // Select the whole item now
            const closeModalBtn = document.querySelector(".modal-close");
            let focusedElementBeforeModal = null; // To store the element that had focus before modal opened

            // Function to open modal
            function openModal(imgSrc, imgAlt) {
                focusedElementBeforeModal = document.activeElement; // Save currently focused element

                modal.style.display = "block";
                modalImg.src = imgSrc;
                modalImg.alt = imgAlt; // Set alt for the actual modal image
                captionText.innerHTML = imgAlt;

                // Set focus to the close button when modal opens for keyboard users
                closeModalBtn.focus();

                // Add event listener for keyboard trap
                document.addEventListener('keydown', trapTabKey);
            }

            // Function to close modal
            function closeModal() {
                modal.style.display = "none";
                // Return focus to the element that opened the modal
                if (focusedElementBeforeModal) {
                    focusedElementBeforeModal.focus();
                }
                // Remove event listener for keyboard trap
                document.removeEventListener('keydown', trapTabKey);
            }

            // Keyboard trap function for modal
            function trapTabKey(e) {
                if (e.key === 'Tab') {
                    const focusableElements = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
                    const firstFocusableEl = focusableElements[0];
                    const lastFocusableEl = focusableElements[focusableElements.length - 1];

                    if (e.shiftKey) { // Shift + Tab
                        if (document.activeElement === firstFocusableEl) {
                            lastFocusableEl.focus();
                            e.preventDefault();
                        }
                    } else { // Tab
                        if (document.activeElement === lastFocusableEl) {
                            firstFocusableEl.focus();
                            e.preventDefault();
                        }
                    }
                } else if (e.key === 'Escape') { // Escape key
                    closeModal();
                }
            }

            // Event listeners for all clickable gallery items
            clickableItems.forEach(item => {
                const img = item.querySelector('img');
                if (img) {
                    item.addEventListener("click", function() {
                        openModal(img.src, img.alt);
                    });
                    // Allow opening with Enter/Space key when item is focused
                    item.addEventListener("keydown", function(e) {
                        if (e.key === "Enter" || e.key === " ") {
                            e.preventDefault(); // Prevent default scroll for space key
                            openModal(img.src, img.alt);
                        }
                    });
                }
            });

            closeModalBtn.addEventListener("click", closeModal);

            // Close modal when clicking outside the image
            modal.addEventListener("click", function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });
        })();
    </script>
</body>
</html>