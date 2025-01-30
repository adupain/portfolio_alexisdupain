<template>
  <div v-if="competence" class="container-fluid mt-3">
    <h1>{{ competence.titre }}</h1>
    <p>Description de la compétence :</p>
    <div class="mb-2 bulle-container">
      <p v-html="competence.description_competence"></p>
    </div>

    <h2 class="mt-4">Projets Associés :</h2>
    <div class="projets-container">
      <a v-for="(projet, index) in projetsLiees" :key="index" class="projet-button"
        :href="`/fiche_projet/${projet.id}`">
        {{ projet.name }}
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
    competence: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      projets: [], // Liste des projets récupérés
    };
  },
  computed: {
    projetsLiees() {
      // Vérifie si project_id est un tableau ou une chaîne nécessitant un traitement
      const projetIds = Array.isArray(this.competence.project_id)
        ? this.competence.project_id
        : String(this.competence.project_id)
          .replace(/[{}]/g, "") // Supprimer les accolades
          .split(",") // Diviser en tableau
          .map((id) => parseInt(id.trim(), 10)) // Convertir en nombres
          .filter((id) => !isNaN(id)); // Retirer les valeurs invalides

      return projetIds
        .map((id) =>
          this.projets.find((projet) => projet.id === id)
        )
        .filter((projet) => projet); // Exclure les compétences non trouvées
    },
  },
  methods: {
    async fetchProjets() {
      try {
        const response = await axios.get("/gestion/projets/get");
        this.projets = response.data;
        console.log("Projets récupérés depuis l'API :", this.projets);
      } catch (error) {
        console.error("Erreur lors de la récupération des projets :", error);
      }
    },
  },
  async mounted() {
    await this.fetchProjets();
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

.projets-container {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  margin-top: 15px;
}

.projet-button {
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

.projet-button:hover {
  background-color: #4caf50;
  color: #fff;
  transform: scale(1.05);
}

.no-projects {
  margin-top: 15px;
  font-size: 1rem;
  color: #ff0000;
}
.projet-button {
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
</style>
