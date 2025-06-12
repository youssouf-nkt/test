<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Rééducation Motrice VR Gamifié</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f0f0f0;
      color: #327c7a;
      scroll-behavior: smooth;
      overflow-x: hidden;
    }
    .main-header {
      margin-bottom: 0;
    }
    .main-nav {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      background: #327c7a;
      color: #fff;
      z-index: 1000;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 1em;
      box-sizing: border-box;
      height: 56px;
    }
    .main-nav .nav-logo {
      font-weight: bold;
      font-size: 1.1em;
      letter-spacing: 1px;
    }
    .burger-container {
      position: relative;
      display: flex;
      align-items: center;
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
      color: #fff;
      text-decoration: none;
      font-weight: bold;
      padding: 1em 1.2em;
      border-radius: 4px;
      transition: background 0.2s;
    }
    .main-nav a:hover,
    .main-nav a:focus {
      background: #245c5a;
    }
    /* Burger Icon */
    .main-nav .burger {
      display: none;
      flex-direction: column;
      justify-content: center;
      height: 40px;
      width: 40px;
      cursor: pointer;
      margin-left: 1em;
      background: none;
      border: none;
      z-index: 2001;
    }
    .main-nav .burger span {
      height: 4px;
      width: 28px;
      background: #fff;
      margin: 4px 0;
      border-radius: 2px;
      transition: 0.3s;
      display: block;
    }
    @media (max-width: 900px) {
      .main-nav ul {
        position: absolute;
        top: 56px;
        right: 0;
        background: #327c7a;
        flex-direction: column;
        width: 220px;
        display: none;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.15);
        z-index: 1001;
      }
      .main-nav .burger {
        display: flex;
      }
      .burger-container:hover ul,
      .burger-container:focus-within ul {
        display: flex;
      }
      .burger-container {
        position: relative;
        display: flex;
        align-items: center;
      }
    }
    .container {
      max-width: 1200px;
      margin: 76px auto 20px auto; /* 76px pour laisser la place à la nav */
      padding: 0 20px;
    }
    section {
      background-color: #fff;
      margin-bottom: 20px;
      padding: 40px 20px;
      border-radius: 8px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      min-height: 60vh;
      display: flex;
      flex-direction: column;
      justify-content: center;
      position: relative;
    }
    h2 {
      color: #d55e03;
      border-bottom: 2px solid #eee;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
    /* Accueil : titre centré, texte en bas à gauche */
    #acceuil h2 {
      text-align: center;
      font-size: 2.8em;
      margin: 0 0 1em 0;
    }
    #acceuil p {
      position: absolute;
      bottom: 20px;
      left: 20px;
      max-width: 450px;
      font-size: 1.1em;
      color: #327c7a;
      margin: 0;
    }
    /* Présentation : texte bas gauche, vidéo haut droite */
    #présentation {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-start;
      min-height: 400px;
      position: relative;
    }
    #présentation p {
      max-width: 480px;
      font-size: 1.1em;
      color: #327c7a;
      align-self: flex-end;
      margin-bottom: 0;
    }
    #présentation iframe {
      max-width: 560px;
      width: 100%;
      height: 315px;
      align-self: flex-start;
      border: none;
    }
    /* Mage Motion : texte à gauche, image à droite */
    #magemotion {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: flex-start;
      min-height: 400px;
    }
    #magemotion .texte {
      flex: 1 1 340px;
      max-width: 580px;
      font-size: 1.1em;
      white-space: pre-line;
    }
    #magemotion .image {
      flex: 1 1 280px;
      max-width: 380px;
      margin-left: 40px;
    }
    #magemotion .image img {
      max-width: 100%;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    }
    /* Équipe */
    #Equipe h2 {
      margin-bottom: 1em;
    }
    #Equipe .equipe-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      font-size: 1.15em;
    }
    #Equipe .equipe-list span {
      background: #327c7a;
      color: #fff;
      padding: 8px 18px;
      border-radius: 20px;
      margin-right: 8px;
    }
    /* Contact */
    #contact form {
      max-width: 400px;
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    #contact input,
    #contact textarea {
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 1em;
      resize: vertical;
    }
    #contact button {
      background: #327c7a;
      color: #fff;
      border: none;
      border-radius: 6px;
      padding: 12px;
      font-size: 1.1em;
      cursor: pointer;
      transition: background 0.2s;
    }
    #contact button:hover {
      background: #245c5a;
    }
    /* Footer */
    footer {
      background-color: #327c7a;
      color: #fff;
      text-align: center;
      padding: 1em 0;
      margin-top: 20px;
    }
    /* Bouton flottant */
    .next-btn {
      position: fixed;
      bottom: 32px;
      right: 32px;
      background: #327c7a;
      color: #fff;
      border: none;
      border-radius: 50%;
      width: 56px;
      height: 56px;
      font-size: 2em;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(50, 124, 122, 0.2);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 2000;
      transition: background 0.2s;
    }
    .next-btn:hover {
      background: #245c5a;
    }
    @media (max-width: 900px) {
      #présentation {
        flex-direction: column-reverse;
        align-items: flex-start;
      }
      #présentation iframe {
        width: 100%;
        height: 250px;
        margin-bottom: 20px;
      }
      #magemotion {
        flex-direction: column;
      }
      #magemotion .image {
        margin-left: 0;
        margin-top: 20px;
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <header class="main-header">
    <nav class="main-nav">
      <div class="nav-logo">Laboratoire Cédric</div>
      <div class="burger-container">
        <button class="burger" aria-label="Ouvrir le menu">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <ul>
          <li><a href="#acceuil">Acceuil</a></li>
          <li><a href="#présentation">Projet</a></li>
          <li><a href="#magemotion">Mage Motion</a></li>
          <li><a href="#Equipe">Equipe</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <div class="container">
    <section id="acceuil">
      <h2>MageMotion: Virtual Rehabilitation Quest</h2>
      <p>
        Conçu dans l'optique de concevoir une application de rééducation motrice
        fonctionnelle ludique, « MageMotion: Virtual Rehabilitation Quest » s'appuie
        sur les principes de la thérapie miroir. Le jeu cible notamment les enfants
        atteints d'hémiparésie infantile, pour qui la rééducation peut être perçue
        comme une tâche ardue.
      </p>
    </section>

    <section id="présentation">
      <h2>Projet</h2>
      <div>
        <p>
          L’objectif principal est ainsi de créer une expérience où les patients peuvent
          s'entraîner avec des exercices thérapeutiques traditionnels tout en intégrant
          des éléments de jeu pour stimuler leur engagement et les motiver à persévérer
          dans leur rééducation. En s'appuyant sur les principes de la thérapie miroir,
          il vise à rendre les exercices de rééducation plus attrayants et engageants,
          encourageant ainsi les jeunes patients à persévérer dans leur parcours de
          rétablissement.
        </p>
        <iframe
          width="560"
          height="315"
          src="https://www.youtube.com/embed/pzjkUC8kMoA?si=pnec9B8hf0GYeYkL"
          title="YouTube video player"
          frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin"
          allowfullscreen
        ></iframe>
      </div>
    </section>

    <section id="magemotion">
      <h2>Mage Motion</h2>
      <div class="texte">
        <strong>1. Introduction</strong><br />
        MageMotion: Virtual Rehabilitation Quest est un jeu de rééducation motrice conçu
        pour aider les enfants atteints d'hémiparésie infantile. En utilisant les
        principes de la thérapie miroir et la réalité virtuelle, ce jeu rend la
        rééducation plus engageante et efficace en immergeant les patients dans un
        environnement ludique et interactif.<br /><br />
        <strong>2. Concept et description du jeu</strong><br />
        Le jeu se déroule dans un environnement virtuel où le joueur, incarnant un
        magicien, doit défendre un château contre des ennemis en réalisant des gestes
        spécifiques. Ces gestes, inspirés d'exercices thérapeutiques, encouragent la
        rééducation motrice tout en offrant une expérience de jeu captivante.
      </div>
      <div class="image">
        <img
          src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=600&q=80"
          alt="Illustration du jeu"
        />
      </div>
    </section>

    <section id="Equipe">
      <h2>Equipe</h2>
      <div class="equipe-list">
        <span>Verhulst Eulalie</span>
        <span>Pons Olivier</span>
        <span>Youssouf Niakate</span>
        <span>Lucie Deplaude</span>
        <span>Siméon Ornato</span>
        <span>Raphael Vonsen</span>
      </div>
    </section>

    <section id="contact">
      <h2>Contact</h2>
      <form>
        <input type="text" name="nom" placeholder="Votre nom" required />
        <input type="email" name="email" placeholder="Votre email" required />
        <textarea name="message" rows="5" placeholder="Votre message..." required></textarea>
        <button type="submit">Envoyer</button>
      </form>
    </section>
  </div>

  <button class="next-btn" aria-label="Section suivante">↓</button>

  <footer>
    <p>&copy; 2025 . All rights reserved.</p>
  </footer>

  <script>
    // Plus besoin de JS pour le menu burger au survol !

    // Scroll section par section
    const sections = Array.from(document.querySelectorAll("section"));
    const nextBtn = document.querySelector(".next-btn");

    function getCurrentSectionIndex() {
      const scrollY = window.scrollY;
      let idx = 0;
      for (let i = 0; i < sections.length; i++) {
        if (sections[i].offsetTop - 10 > scrollY) break;
        idx = i;
      }
      return idx;
    }

    // Bouton pour passer à la section suivante
    nextBtn.addEventListener("click", () => {
      const idx = getCurrentSectionIndex();
      if (idx < sections.length - 1) {
        sections[idx + 1].scrollIntoView({ behavior: "smooth" });
      }
    });

    // Cache le bouton si on est sur la dernière section
    window.addEventListener("scroll", () => {
      const idx = getCurrentSectionIndex();
      if (idx >= sections.length - 1) {
        nextBtn.style.display = "none";
      } else {
        nextBtn.style.display = "flex";
      }
    });

    // Gère le scroll "coup" pour passer à la section suivante/précédente
    let isScrolling = false;
    window.addEventListener(
      "wheel",
      function (e) {
        if (isScrolling) return;
        const idx = getCurrentSectionIndex();
        if (e.deltaY > 40 && idx < sections.length - 1) {
          isScrolling = true;
          sections[idx + 1].scrollIntoView({ behavior: "smooth" });
          setTimeout(() => {
            isScrolling = false;
          }, 700);
          e.preventDefault();
        } else if (e.deltaY < -40 && idx > 0) {
          isScrolling = true;
          sections[idx - 1].scrollIntoView({ behavior: "smooth" });
          setTimeout(() => {
            isScrolling = false;
          }, 700);
          e.preventDefault();
        }
      },
      { passive: false }
    );
  </script>
</body>
</html>
