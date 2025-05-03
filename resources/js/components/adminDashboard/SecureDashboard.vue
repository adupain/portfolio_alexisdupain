<template>
  <div>
    <!-- Formulaire de connexion administrateur -->
    <div v-if="!isLoggedIn" class="secure-dashboard">
      <div class="form-container">
        <h2>Connexion Administrateur</h2>
        <form @submit.prevent="handleLogin">
          <div class="form-group">
            <label for="id_admin">Identifiant</label>
            <input v-model="id_admin" type="text" id="id_admin" required />
          </div>
          <div class="form-group">
            <label for="name_admin">Nom</label>
            <input v-model="name_admin" type="text" id="name_admin" required />
          </div>
          <div class="form-group">
            <label for="mdp_admin">Mot de passe</label>
            <input v-model="mdp_admin" type="password" id="mdp_admin" required />
          </div>
          <button type="submit" class="login-button">Se connecter</button>
        </form>
        <p v-if="errorMessage" class="error-message">{{ errorMessage }}</p>
      </div>
    </div>

    <!-- Tableau de bord administrateur (affiché après connexion) -->
    <div v-else>
      <div class="d-block w-100 shadow-lg" id="sideBarAdminDashboard">
        <ul class="m-0 d-flex flex-wrap flex-row">
          <li class="col p-2" @click="loadComponent('Propos')">
            <p class="m-0">Gestion des données "Propos"</p>
          </li>
          <li class="col p-2" @click="loadComponent('Formations')">
            <p class="m-0">Gestion des données "Formations"</p>
          </li>
          <li class="col p-2" @click="loadComponent('Portfolio')">
            <p class="m-0">Gestion des données "Portfolio"</p>
          </li>
          <li class="col p-2" @click="loadComponent('Competences')">
            <p class="m-0">Gestion des données "Compétences"</p>
          </li>
          <li class="col p-2" @click="loadComponent('Veille')">
            <p class="m-0">Gestion des données "Veille technologiques"</p>
          </li>
        </ul>
      </div>
      <div class="pt-3" style="width: 100%;">
        <gestion-propos v-if="loadedPropos"></gestion-propos>
        <gestion-formation v-if="loadedFormation"></gestion-formation>
        <gestion-portfolio v-if="loadedPortfolio"></gestion-portfolio>
        <gestion-competence v-if="loadedCompetence"></gestion-competence>
        <gestion-veille v-if="loadedVeille"></gestion-veille>
      </div>
    </div>
  </div>
</template>

<script>
import GestionPropos from './GestionPropos.vue'
import GestionFormation from './GestionFormation.vue'
import GestionPortfolio from './GestionPortfolio.vue'
import GestionCompetence from './GestionCompetence.vue'
import GestionVeille from './GestionVeille.vue'
import axios from 'axios'
import Swal from 'sweetalert2'

export default {
  data() {
    return {
      // États du tableau de bord
      loadedPropos: true,
      loadedFormation: false,
      loadedPortfolio: false,
      loadedCompetence: false,
      loadedVeille: false,
      
      // États de connexion
      isLoggedIn: false,
      id_admin: '',
      name_admin: '',
      mdp_admin: '',
      errorMessage: ''
    }
  },
  components: {
    GestionPropos,
    GestionFormation,
    GestionPortfolio,
    GestionCompetence,
    GestionVeille,
  },
  methods: {
    async handleLogin() {
      try {
        const response = await axios.get('/dashboard', {
          id_admin: this.id_admin,
          name_admin: this.name_admin,
          mdp_admin: this.mdp_admin,
        })

        if (response.data.success) {
          this.isLoggedIn = true
          // Chargement par défaut du premier composant après connexion
          this.loadComponent('Propos')
        } else {
          this.errorMessage = 'Identifiants incorrects. Veuillez réessayer.'
          Swal.fire({
            icon: 'error',
            title: 'Erreur de connexion',
            text: 'Identifiants incorrects. Veuillez réessayer.',
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
          })
        }
      } catch (error) {
        this.errorMessage = 'Erreur lors de la connexion. Veuillez réessayer.'
        console.error(error)
        Swal.fire({
          icon: 'error',
          title: 'Erreur de connexion',
          text: 'Une erreur s\'est produite. Veuillez réessayer plus tard.',
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000
        })
        // Redirection vers la page d'accueil en cas d'erreur
        setTimeout(() => {
          window.location.href = '/'
        }, 3000)
      }
    },
    loadComponent(component) {
      switch (component) {
        case 'Propos':
          this.loadedPropos = true
          this.loadedFormation = false
          this.loadedPortfolio = false
          this.loadedCompetence = false
          this.loadedVeille = false
          break;
        case 'Portfolio':
          this.loadedPropos = false
          this.loadedFormation = false
          this.loadedPortfolio = true
          this.loadedCompetence = false
          this.loadedVeille = false
          break;
        case 'Formations':
          this.loadedPropos = false
          this.loadedFormation = true
          this.loadedPortfolio = false
          this.loadedCompetence = false
          this.loadedVeille = false
          break;
        case 'Competences':
          this.loadedPropos = false
          this.loadedFormation = false
          this.loadedPortfolio = false
          this.loadedCompetence = true
          this.loadedVeille = false
          break;
        case 'Veille':
          this.loadedPropos = false
          this.loadedFormation = false
          this.loadedPortfolio = false
          this.loadedCompetence = false
          this.loadedVeille = true
          break;

        default:
          break;
      }
    }
  }
}
</script>

<style>
/* Styles pour le tableau de bord */
#sideBarAdminDashboard {
  position: relative;
  height: 100%;
  width: 200px;
  left: 0px;
  top: 0px;
  background-color: white;
}

#sideBarAdminDashboard ul {
  margin-top: 80px;
  list-style-type: none;
  padding: 0px;
}

#sideBarAdminDashboard ul li {
  text-decoration: none;
  display: flex;
  justify-content: center;
  align-items: center;
  cursor: pointer;
  transition: box-shadow 0.5s, background-color 0.5s, color 0.5s;
  font-weight: 450;
  font-size: 15px;
}

#sideBarAdminDashboard ul li:hover {
  box-shadow: -5px 5px 10px rgba(0, 0, 0, 0.226);
  background-color: rgba(0, 0, 0, 0.50);
  color: white
}

/* Styles pour le formulaire de connexion */
.secure-dashboard {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background-color: #f5f7fa;
}

.form-container {
  background: white;
  padding: 2rem;
  border-radius: 1rem;
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
  width: 100%;
  max-width: 400px;
}

h2 {
  text-align: center;
  margin-bottom: 1.5rem;
}

.form-group {
  margin-bottom: 1rem;
}

label {
  display: block;
  font-weight: 600;
  margin-bottom: 0.5rem;
}

input {
  width: 100%;
  padding: 0.6rem;
  border: 1px solid #ccc;
  border-radius: 0.5rem;
}

.login-button {
  width: 100%;
  padding: 0.7rem;
  background-color: #1d4ed8;
  color: white;
  border: none;
  border-radius: 0.5rem;
  font-weight: 600;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.login-button:hover {
  background-color: #2563eb;
}

.error-message {
  color: red;
  text-align: center;
  margin-top: 1rem;
}
</style>