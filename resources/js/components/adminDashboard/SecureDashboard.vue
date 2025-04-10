<template>
    <div class="secure-dashboard">
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
  </template>
  
  <script setup>
  import { ref } from 'vue'
  import axios from 'axios'
  
  const id_admin = ref('')
  const name_admin = ref('')
  const mdp_admin = ref('')
  const errorMessage = ref('')
  
  const handleLogin = async () => {
    try {
      const response = await axios.post('/securedashboard', {
        id_admin: id_admin.value,
        name_admin: name_admin.value,
        mdp_admin: mdp_admin.value,
      })
  
      if (response.data.success) {
        window.location.href = '/dashboard'
      } else {
        errorMessage.value = 'Identifiants incorrects. Veuillez réessayer.'
      }
    } catch (error) {
      errorMessage.value = 'Erreur lors de la connexion. Veuillez réessayer.'
      console.error(error)
    }
  }
  </script>
  
  <style scoped>
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
  