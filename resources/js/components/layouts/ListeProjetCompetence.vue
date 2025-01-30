<template>
  <div class="competence-list">
    <div class="competence-card" v-for="competence in competences" :key="competence.id">
      <h2>{{ competence.titre }}</h2>
      <p>{{ competence.description_competence }}</p>

      <h3>Projets Associés :</h3>
      <ul class="project-list">
        <li v-for="projet in getProjetsForCompetence(competence)" :key="projet.id">
          {{ projet.name }}
        </li>
      </ul>
      <a class="btn btn-primary" :href="`/fiche_competence/${competence.id}`">Plus de détails...</a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      competences: [], // Tableau pour stocker les compétences
      projets: [] // Tableau pour stocker les projets
    };
  },

  methods: {
    // Méthode pour récupérer les compétences
    async fetchCompetences() {
      try {
        const response = await axios.get('/gestion/competence/get');
        this.competences = response.data; // Stocke les compétences récupérées dans le tableau
      } catch (error) {
        console.error("Erreur lors de la récupération des compétences:", error);
      }
    },

    // Méthode pour récupérer les projets
    async fetchProjets() {
      try {
        const response = await axios.get('/gestion/projets/get');
        this.projets = response.data; // Stocke les projets récupérés dans le tableau
      } catch (error) {
        console.error("Erreur lors de la récupération des projets:", error);
      }
    },

    // Récupère les projets associés à une compétence
    getProjetsForCompetence(competence) {
      return this.projets.filter(projet => 
        projet.competence_id.includes(competence.id)
      );
    }
  },

  // Méthode pour récupérer les données au moment du montage du composant
  async mounted() {
    await this.fetchCompetences();
    await this.fetchProjets();
  }
};
</script>

<style scoped>
.competence-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
}

.competence-card {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 15px;
  width: calc(33.33% - 20px); /* Chaque carte prend 1/3 de la largeur moins l'espace entre les cartes */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.competence-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.competence-card h2 {
  margin: 0 0 10px;
  font-size: 1.5rem;
}

.competence-card p {
  margin: 5px 0;
  font-size: 1rem;
}

.project-list {
  list-style: none;
  padding: 0;
  margin: 10px 0;
}

.project-list li {
  font-size: 1rem;
  color: #0066cc;
  background: #e3f2fd;
  margin-bottom: 5px;
  padding: 5px;
  border-radius: 5px;
  display: inline-block;
  width: 100%;
  text-align: center;
}

@media (max-width: 768px) {
  .competence-card {
    width: calc(50% - 20px); /* Sur les écrans plus petits, les cartes occupent 50% de la largeur */
  }
}

@media (max-width: 480px) {
  .competence-card {
    width: 100%; /* Sur les très petits écrans, chaque carte occupe toute la largeur */
  }
}
</style>
