<template>
  <div v-if="competence" class="container-fluid mt-3">
    <h1>{{ competence.titre }}</h1>
    <p>Description de la compétence :</p>
    <div class="mb-2 bulle-container">
      <p v-html="competence.description_competence"></p>
    </div>

    <h2 class="mt-4">Projets Associés :</h2>
    <div class="competences-container">
      <router-link
        v-for="(projet, index) in projetsAssocies"
        :key="index"
        :to="`/fiche_projet/${projet.id}`"
        class="competence-button"
      >
        {{ projet.name }}
      </router-link>
      <p v-if="projetsAssocies.length === 0">Aucun projet associé trouvé.</p>
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
    projets: {
      type: Array,
      required: false,
      default: () => [],
    },
  },
  data() {
    return {
      projets: [], // Liste des projets récupérés
    };
  },
  computed: {
    // Cette méthode permet de récupérer les projets associés à la compétence
    projetsAssocies() {
      // Si la compétence n'a pas de projets associés
      if (!this.competence.projet_id) {
        console.log("Aucun projet_id trouvé dans la compétence");
        return []; // On retourne un tableau vide si aucun projet_id n'est défini.
      }

      // Récupérer les projets associés à partir de projet_id dans la compétence
      const projetIds = Array.isArray(this.competence.projet_id)
        ? this.competence.projet_id
        : this.competence.projet_id
            .replace(/[{}]/g, "") // Supprimer les accolades s'il s'agit d'une chaîne
            .split(",") // Diviser la chaîne en un tableau d'id
            .map((id) => parseInt(id.trim(), 10)) // Convertir les id en nombres entiers
            .filter((id) => !isNaN(id)); // Filtrer les éléments non valides (NaN)

      console.log("projetIds après traitement:", projetIds);

      // Filtrer les projets en fonction des id
      return projetIds
        .map((id) => {
          // Vérifier que l'ID du projet existe dans la liste des projets
          const projet = this.projets.find((p) => p.id === id);
          console.log(`Projet avec l'ID ${id} trouvé:`, projet); // Pour debugging
          return projet;
        })
        .filter((projet) => projet); // Ne garder que les projets qui existent
    },
  },
  methods: {
    // Récupérer les projets depuis l'API si nécessaire
    async fetchProjets() {
      try {
        const response = await axios.get("/gestion/projet/get");
        console.log("Projets récupérés:", response.data); // Pour vérifier les projets récupérés
        this.projets = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des projets :", error);
      }
    },
  },
  async mounted() {
    // Si les projets ne sont pas passés en props, on les récupère de l'API
    if (this.projets.length === 0) {
      await this.fetchProjets(); // Si pas de projets en props, on les charge via l'API
    }
    console.log("Projets à afficher:", this.projets); // Vérifie que les projets sont chargés correctement
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
