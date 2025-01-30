<template>
  <div v-if="projet" class="container-fluid mt-3">
    <h1>{{ projet.name }}</h1>
    <p>Description du projet :</p>
    <div class="mb-2 bulle-container">
      <p v-html="projet.description"></p>
    </div>

    <h2 class="mt-4">Compétences Associées :</h2>
    <div class="competences-container">
      <a v-for="(competence, index) in competencesLiees" :key="index" class="competence-button"
        :href="`/fiche_competence/${competence.id}`">
        {{ competence.titre }}
      </a>
    </div>
  </div>
  <div v-else>
    <p>Chargement...</p>
  </div>
</template>

<script>
import axios from "axios";

export default {
  props: {
    projet: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      competences: [], // Liste des compétences récupérées
    };
  },
  computed: {
    competencesLiees() {
      // Vérifie si competence_id est un tableau ou une chaîne nécessitant un traitement
      const competenceIds = Array.isArray(this.projet.competence_id)
        ? this.projet.competence_id
        : String(this.projet.competence_id)
          .replace(/[{}]/g, "") // Supprimer les accolades
          .split(",") // Diviser en tableau
          .map((id) => parseInt(id.trim(), 10)) // Convertir en nombres
          .filter((id) => !isNaN(id)); // Retirer les valeurs invalides

      return competenceIds
        .map((id) =>
          this.competences.find((competence) => competence.id === id)
        )
        .filter((competence) => competence); // Exclure les compétences non trouvées
    },
  },
  methods: {
    // Récupère les compétences depuis l'API
    async fetchCompetences() {
      try {
        const response = await axios.get("/gestion/competence/get");
        this.competences = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des compétences :", error);
      }
    },
  },
  async mounted() {
    // Récupère les compétences au montage
    await this.fetchCompetences();
  },
};
</script>

<style scoped>
.bulle-container {
  background-color: #fff;
  box-shadow: 0px 2px 15px lightgray;
  padding: 20px;
  border-radius: 8px;
}

.titre {
  font-size: 1.5rem;
  color: #343a40;
}

.competences-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 15px;
}

.competence-button {
  padding: 10px 20px;
  border: 1px solid #4caf50;
  border-radius: 5px;
  background-color: #e3f2fd;
  color: #0066cc;
  font-size: 1rem;
  cursor: pointer;
  transition: background-color 0.3s, transform 0.2s;
  text-align: center;
  text-decoration: none;
}

.competence-button:hover {
  background-color: #4caf50;
  color: #fff;
  transform: scale(1.05);
}

ul {
  list-style: none;
  padding: 0;
}

ul li {
  margin: 5px 0;
  padding: 5px;
  background-color: #f8f9fa;
  border-radius: 4px;
}
</style>
