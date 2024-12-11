<template>
  <div class="login-form">
    <h3>Vérification d'identité :</h3>
    <form @submit.prevent="handleAction">
      <!-- Étape 1 : Saisie du mot de passe -->
      <div v-if="step === 1">
        <label for="password">Mot de passe :</label>
        <div class="input-wrapper">
          <input
            :type="showPassword ? 'text' : 'password'"
            id="password"
            v-model="password"
            placeholder="Entrez votre mot de passe"
            required
          />
          <button
            type="button"
            class="toggle-visibility"
            @click="togglePasswordVisibility"
          >
            {{ showPassword ? "👁️‍🗨️" : "👁️‍🗨️" }}
          </button>
        </div>
      </div>

      <!-- Étape 2 : Question personnalisée -->
      <div v-else-if="step === 2">
        <label>{{ selectedQuestion }}</label>
        <div class="input-wrapper">
          <input
            :type="showAnswer ? 'text' : 'password'"
            v-model="answer"
            placeholder="Entrez votre réponse"
            required
          />
          <button
            type="button"
            class="toggle-visibility"
            @click="toggleAnswerVisibility"
          >
            {{ showAnswer ? "👁️‍🗨️" : "👁️‍🗨️" }}
          </button>
        </div>
      </div>

      <!-- Bouton dynamique -->
      <button
        :disabled="(step === 1 && !password) || (step === 2 && !answer.trim())"
        type="submit"
      >
        {{ step === 1 ? "Passez à l'étape suivante" : "Se connecter" }}
      </button>

      <!-- Message d'erreur -->
      <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      password: "",
      correctPassword: "ubuntu2024*admin",
      errorMessage: null,
      step: 1,
      questions: [
        {
          text: "Quel était le nom de mon premier poisson rouge ?",
          correctAnswer: "Oscar",
        },
        {
          text: "Quel est le nom de ma ville natale ?",
          correctAnswer: "Bordeaux",
        },
        {
          text: "Quelle est la couleur de mon animal préféré ?",
          correctAnswer: "Roux",
        },
      ],
      selectedQuestion: "",
      correctAnswer: "",
      answer: "",
      showPassword: false,
      showAnswer: false,
    };
  },
  mounted() {
    const randomIndex = Math.floor(Math.random() * this.questions.length);
    this.selectedQuestion = this.questions[randomIndex].text;
    this.correctAnswer = this.questions[randomIndex].correctAnswer;
  },
  methods: {
    handleAction() {
      if (this.step === 1) {
        if (this.password === this.correctPassword) {
          this.step = 2;
          this.errorMessage = null;
        } else {
          this.errorMessage = "Mot de passe incorrect. Veuillez réessayer.";
        }
      } else if (this.step === 2) {
        if (this.answer.trim().toLowerCase() === this.correctAnswer.toLowerCase()) {
          window.location.href = "/dashboard";
        } else {
          this.errorMessage = "Réponse incorrecte. Veuillez réessayer.";
        }
      }
    },
    togglePasswordVisibility() {
      this.showPassword = !this.showPassword;
    },
    toggleAnswerVisibility() {
      this.showAnswer = !this.showAnswer;
    },
  },
};
</script>

<style scoped>
.login-form {
  max-width: 300px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.input-wrapper {
  display: flex;
  align-items: center;
}

input {
  flex: 1;
  padding: 8px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.toggle-visibility {
  margin-left: 10px;
  background: none;
  border: none;
  cursor: pointer;
  font-size: 16px;
  color: #007bff;
}

.toggle-visibility:focus {
  outline: none;
}

button {
  width: 100%;
  padding: 10px;
  background-color: #255fff; /* Couleur par défaut */
  color: #fff;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #1a47d4; /* Bleu légèrement éclairci */
}

button:active {
  background-color: #0056ff; /* Bleu plus clair pour l'état actif */
}

button[disabled] {
  background-color: #b0c7ff; /* Couleur désactivée (bleu pâle) */
  cursor: not-allowed;
}

.error {
  color: red;
  margin-top: 10px;
}
</style>
