<template>
  <div class="project-list">
    <div class="project-card" v-for="projet in sortedProjets" :key="projet.id">
      <h2 class="project-title">{{ projet.name }}</h2>
      <div class="project-description" v-html="projet.description"></div>

      <!-- Affichage de la date de création -->
      <div class="project-date">
        <p>Créé le: {{ formatDate(projet.created_at) }}</p>
      </div>
      
      <!-- Affichage des compétences -->
      <div class="competences-section">
        <h3>Compétences Associées:</h3>
        <ul class="competence-list">
          <li v-for="competence in getCompetencesForProject(projet)" :key="competence.id" class="competence-item">
            {{ competence.titre }}
          </li>
        </ul>
        <a class="btn btn-primary" :href="`/fiche_projet/${projet.id}`">Plus de détails...</a>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  data() {
    return {
      projets: [], // Liste des projets
      competences: [] // Liste des compétences
    };
  },

  methods: {
    // Méthode pour récupérer les projets
    async fetchProjets() {
      try {
        const response = await axios.get("/gestion/projets/get");
        this.projets = response.data.map(projet => ({
          ...projet,
          competence_id: Array.isArray(projet.competence_id)
            ? projet.competence_id
            : projet.competence_id
                ?.replace(/[{}]/g, "")
                .split(",")
                .filter(id => id) // Retirer les valeurs nulles ou vides
                .map(id => parseInt(id, 10)) || [], // Convertir en tableau de nombres
          created_at: projet.created_at ? new Date(projet.created_at) : new Date() // Assurer que created_at soit une date valide
        }));
      } catch (error) {
        console.error("Erreur lors de la récupération des projets :", error);
      }
    },

    // Méthode pour récupérer les compétences
    async fetchCompetences() {
      try {
        const response = await axios.get("/gestion/competences/get");
        this.competences = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des compétences :", error);
      }
    },

    // Récupère les compétences associées à un projet
    getCompetencesForProject(projet) {
      return projet.competence_id
        .map(id => this.competences.find(competence => competence.id === id))
        .filter(competence => competence); // Exclure les compétences non trouvées
    },

    // Fonction pour formater la date
    formatDate(date) {
      const options = {
        weekday: "short",
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
      };
      return new Date(date).toLocaleDateString("fr-FR", options);
    }
  },

  // Récupère les données au montage du composant
  async mounted() {
    await this.fetchCompetences();
    await this.fetchProjets();
  },

  computed: {
    // Tri des projets par date de création
    sortedProjets() {
      return this.projets.sort((a, b) => b.created_at - a.created_at);
    }
  }
};
</script>

<style scoped>
.project-list {
  display: flex;
  flex-wrap: wrap;
  gap: 30px;
  justify-content: center;
}

.project-card {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 15px;
  width: 300px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
  border: 1px solid #ccc;
}

.project-card:hover {
  transform: translateY(-10px);
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.project-title {
  margin: 0 0 10px;
  font-size: 1.5rem;
  color: #333;
  font-weight: bold;
  text-align: center;
}

.project-description {
  margin: 10px 0;
  font-size: 1rem;
  color: #666;
  text-align: justify;
}

.project-date {
  margin-top: 10px;
  font-size: 1rem;
  color: #333;
  text-align: center;
}

.competences-section {
  margin-top: 15px;
}

.competence-list {
  list-style: none;
  padding: 0;
  margin: 0;
}

.competence-item {
  font-size: 1rem;
  color: #0066cc;
  background: #e3f2fd;
  margin-bottom: 8px;
  padding: 8px;
  border-radius: 5px;
  display: inline-block;
  width: 100%;
  text-align: center;
  border: 1px solid #4caf50;
}
</style>
