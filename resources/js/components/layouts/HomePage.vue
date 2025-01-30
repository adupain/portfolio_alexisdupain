<template>
  <div>
    <!-- Bannière principale : Cette section affiche une image de fond et un texte d'accueil -->
    <div class="banner">
      <img src="/images/banniere_portfolio.png" alt="Background" class="banner-image" />
      <div class="banner-text">
        <h1>Bienvenue sur Mon Portfolio</h1>
        <!-- Bouton pour inciter l'utilisateur à découvrir le portfolio -->
      </div>
    </div>

    <!-- Section "À propos de moi" : Contient une image de profil et une description -->
    <div class="about-section">
      <h1 class="section-title">À propos de moi</h1>
      <div class="about-content">
        <!-- Image de profil circulaire -->
        <div class="about-image">
          <img src="/images/PhotoAdWebHomePage.jpg" alt="Photo de profil" />
        </div>
        <!-- Description texte de l'utilisateur -->
        <div class="about-text">
          <h2 v-html="propos[0].description"></h2>
        </div>
      </div>
    </div>

    <!-- Section "Mes formations" : Affichage des formations sous forme de cubes -->
    <div id="formations-section">
      <h1 class="section-title">Mes formations</h1>
      <div class="formations-container">
        <!-- Affichage dynamique des formations à l'aide de la directive v-for -->
        <div
          v-for="(formation, index) in formations"
          :key="index"
          class="formation-box"
        >
          <!-- Nom de la formation -->
          <h4 style="color: black;">{{ formation.name }}</h4>
          <!-- Description de la formation -->
          <h5 style="color: lightslategrey ;" v-html="formation.description"></h5>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    // Propriété 'propos' qui contient une liste d'objets pour afficher la description
    propos: {
      type: Array,
      required: true,
    },
    // Propriété 'formations' qui contient une liste d'objets pour afficher les formations
    formations: {
      type: Array,
      required: true,
    },
  },
};
</script>

<style scoped>
/* Bannière */
.banner {
  position: relative;
  height: 70vh; /* Hauteur de la bannière */
  background: #000; /* Fond noir */
  display: flex; /* Utilisation de flexbox pour centrer le contenu */
  justify-content: center;
  align-items: center;
  overflow: hidden;
}

.banner-image {
  position: absolute;
  width: 100%;
  height: 100%;
  object-fit: cover; /* Couverture complète de l'image sans déformation */
  opacity: 0.4; /* Image en arrière-plan avec une opacité réduite */
}

.banner-text {
  position: relative;
  text-align: center; /* Centrer le texte */
  color: #fff; /* Texte en blanc */
}

.banner-text h1 {
  font-size: 3rem; /* Taille du titre */
  margin-bottom: 1rem; /* Espacement sous le titre */
}

.banner-button:hover {
  background-color: #333; /* Fond sombre au survol */
  color: #fff; /* Texte blanc au survol */
}

/* Section "À propos de moi" */
.about-section {
  padding: 60px 20px; /* Espacement autour du contenu */
  background-color: #f5f5f5; /* Fond gris clair */
}

.about-content {
  display: flex; /* Utilisation de flexbox pour un alignement fluide */
  flex-wrap: wrap; /* Permet aux éléments de s'adapter sur plusieurs lignes */
  justify-content: space-around; /* Distribution égale des éléments */
  align-items: center; /* Alignement vertical centré */
  gap: 20px; /* Espacement entre les éléments */
}

.about-image img {
  border-radius: 50%; /* Image ronde */
  width: 200px;
  height: 200px;
  object-fit: cover; /* Couvre l'espace sans déformation */
  border: 5px solid #000; /* Bordure noire autour de l'image */
}

.about-text h2 {
  font-size: 1.5rem; /* Taille du texte */
  color: #333; /* Gris foncé pour le texte */
}

/* Section "Mes formations" */
#formations-section {
  padding: 40px 20px; /* Espacement autour de la section */
  background-color: #fff; /* Fond blanc */
}

.section-title {
  text-align: center; /* Centrer le titre */
  font-size: 2.5rem; /* Taille du titre */
  color: #000; /* Noir */
  margin-bottom: 40px; /* Espacement sous le titre */
}

.formations-container {
  display: flex; /* Utilisation de flexbox pour les formations */
  flex-wrap: wrap; /* Permet aux éléments de s'adapter à l'écran */
  justify-content: center; /* Centrer les éléments */
  gap: 50px; /* Espacement entre les éléments */
}

.formation-box {
  width: 250px; /* Largeur des cubes */
  height: 250px; /* Hauteur des cubes */
  background-color: #f5f5f5; /* Fond gris clair */
  border: 2px solid #000; /* Bordure noire autour des cubes */
  border-radius: 10px; /* Coins arrondis */
  padding: 20px; /* Espacement interne du cube */
  display: flex; /* Flexbox pour l'alignement des éléments internes */
  flex-direction: column; /* Disposition verticale */
  align-items: center; /* Centrer le contenu à l'intérieur */
  justify-content: center; /* Centrer verticalement le contenu */
  text-align: center; /* Centrer le texte */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Légère ombre portée pour l'effet de cube */
  transition: transform 0.3s ease, box-shadow 0.3s ease; /* Animation de transformation et ombre */
}

.formation-box:hover {
  transform: translateY(-10px); /* Effet de survol : déplace le cube vers le haut */
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.4); /* Ombre plus prononcée au survol */
}

.formation-box h3 {
  font-size: 1.2rem; /* Taille du titre d'année */
  font-weight: bold; /* Gras pour le titre d'année */
  color: #000; /* Noir */
  margin-bottom: 10px; /* Espacement sous le titre */
}

.formation-box h4 {
  font-size: 1rem; /* Taille du titre de la formation */
  font-weight: 600; /* Poids de la police */
  color: #333; /* Gris foncé */
  margin-bottom: 10px; /* Espacement sous le titre */
}

.formation-box p {
  font-size: 0.9rem; /* Taille de la description */
  color: #666; /* Gris moyen */
  line-height: 1.4; /* Hauteur de ligne pour améliorer la lisibilité */
}
</style>
