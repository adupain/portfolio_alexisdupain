<template>
  <div>
    <!-- Bannière principale -->
    <div class="banner">
      <div class="banner-text">
        <h1>Bienvenue!</h1>
        <a href="/portfolio" class="banner-button">Découvrir mon travail</a>
      </div>
    </div>

    <!-- Section "À propos de moi" -->
    <div class="about-section">
      <h1 class="section-title">À propos de moi</h1>
      <div class="about-content">
        <div class="about-image">
          <img src="/images/PhotoAdWebHomePage.jpg" alt="Photo de profil" />
        </div>
        <div class="about-text">
          <p v-html="propos[0].description"></p>
        </div>
      </div>
    </div>

    <!-- Section "Mes formations" sous forme de frise chronologique -->
    <div id="formations-section">
      <h1 class="section-title">Mes formations</h1>
      <div class="timeline">
        <div class="timeline-bar" :style="{ height: barHeight + '%' }"></div>

        <div
          v-for="(formation, index) in formations"
          :key="index"
          class="timeline-item"
          :class="{ 'left': index % 2 === 0, 'right': index % 2 !== 0 }"
        >
          <div class="timeline-dot"></div>
          <div class="timeline-content">
            <h4>{{ formation.name }}</h4>
            <p v-html="formation.description"></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    propos: {
      type: Array,
      required: true,
    },
    formations: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      barHeight: 0, // Hauteur initiale de la barre (en %)
    };
  },
  mounted() {
    window.addEventListener("scroll", this.updateProgressBar);
  },
  beforeUnmount() {
    window.removeEventListener("scroll", this.updateProgressBar);
  },
  methods: {
    updateProgressBar() {
      const section = document.getElementById("formations-section");
      if (!section) return;

      const rect = section.getBoundingClientRect();
      const windowHeight = window.innerHeight;
      const scrollY = window.scrollY;
      const sectionTop = rect.top + scrollY;
      const sectionHeight = section.offsetHeight;

      // Calculer le pourcentage de progression dans la section
      let progress =
        ((scrollY + windowHeight - sectionTop) / sectionHeight) * 100;
      progress = Math.max(0, Math.min(100, progress)); // Garde la valeur entre 0 et 100
      this.barHeight = progress;
    },
  },
};
</script>

<style scoped>
/* === BANNIÈRE === */
.banner {
  position: relative;
  height: 100vh;
  background-image: url('/images/banniere_portfolio.png');
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  text-align: right;
  color: #fff;
  padding: 50px;
  animation: fadeIn 1.5s ease-in-out;
}

.banner-text h1 {
  font-size: 4.5rem;
  font-weight: 800;
  letter-spacing: 3px;
  text-shadow: 0 0 15px rgba(255, 255, 255, 0.9);
}

.banner-button {
  padding: 15px 30px;
  background: linear-gradient(135deg, #ff6b6b, #ff9f43);
  color: #ffffff;
  border: none;
  border-radius: 30px;
  font-size: 1.2rem;
  cursor: pointer;
  transition: all 0.3s ease;
}

.banner-button:hover {
  background: linear-gradient(135deg, #ff4757, #ff6b6b);
  transform: translateY(-5px);
}

/* === SECTION À PROPOS === */
.about-section {
  padding: 100px 20px;
  background-color: #fff;
  text-align: center;
}

.section-title {
  font-size: 3rem;
  font-weight: 700;
  text-transform: uppercase;
  color: #ff6b6b;
  text-shadow: 0 0 10px rgba(255, 107, 107, 0.7);
}

.about-content {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 50px;
}

.about-image img {
  width: 220px;
  height: 220px;
  border-radius: 50%;
  object-fit: cover;
  border: 5px solid #fff;
  box-shadow: 0 6px 18px rgba(0, 0, 0, 0.2);
  transition: transform 0.4s ease;
}

.about-image img:hover {
  transform: scale(1.1);
}

.about-text p {
  font-size: 1.3rem;
  color: #555;
  font-weight: 400;
  max-width: 700px;
  line-height: 1.8;
  margin-top: 20px;
}

/* === FRISE CHRONOLOGIQUE === */
.timeline {
  position: relative;
  max-width: 1000px;
  margin: 50px auto;
  padding: 20px;
}

/* Barre de progression dynamique */
.timeline-bar {
  position: absolute;
  width: 6px;
  background: linear-gradient(180deg, #ff6b6b, #ff9f43);
  top: 0;
  left: 50%;
  transform: translateX(-50%);
  border-radius: 10px;
  transition: height 2.0s ease-in-out;
  height: 0;
}

/* === CONTENEUR DES FORMATIONS === */
.timeline-item {
  position: relative;
  width: 50%;
  padding: 20px 40px;
  box-sizing: border-box;
}

.timeline-item.left {
  left: 0;
  text-align: right;
}

.timeline-item.right {
  left: 50%;
  text-align: left;
}

/* === BULLES DES FORMATIONS === */
.timeline-dot {
  position: absolute;
  top: 20px;
  width: 20px;
  height: 20px;
  background: #ff6b6b;
  border-radius: 50%;
  left: calc(50% - 10px);
  border: 4px solid white;
  box-shadow: 0 0 10px rgba(255, 107, 107, 0.5);
}

/* === CONTENU DES FORMATIONS === */
.timeline-content {
  background: rgba(255, 255, 255, 0.9);
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
}

.timeline-content:hover {
  transform: translateY(-5px);
  box-shadow: 0 6px 12px rgba(255, 0, 0, 0.3);
}

/* === RESPONSIVE DESIGN === */
@media (max-width: 768px) {
  .about-content {
    flex-direction: column;
  }

  .timeline-bar {
    left: 20px;
  }

  .timeline-item {
    width: 100%;
    padding-left: 50px;
    text-align: left;
  }

  .timeline-item.right {
    left: 0;
  }

  .timeline-dot {
    left: 10px;
  }
}
</style>
