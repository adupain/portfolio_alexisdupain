<template>
    <div class="container-fluid">
      <h1>Gestion des données "Compétences"</h1>
  
      <table class="table table-bordered table-responsive">
        <thead class="table-dark table-sm">
          <tr>
            <th class="align-middle text-center text-light">Titre</th>
            <th class="align-middle text-center text-light">Description</th>
            <th class="align-middle text-center text-light">Projets associés</th>
            <th class="align-middle text-center text-light">Action</th>
          </tr>
        </thead>
        <tbody v-if="competences.length > 0" v-for="competence in competences" :key="competence.id">
          <tr>
            <td class="align-middle">
              <input type="text" v-model="competence.titre" style="width: 400px;" disabled />
            </td>
            <td>
              <trumbowyg class="form-control" v-model="competence.description_competence"></trumbowyg>
            </td>
            <td>
              <div v-for="(projetId, index) in competence.projet_id" :key="index" class="d-flex align-items-center mb-2">
                <select v-model="competence.projet_id[index]" class="form-select" style="width: 300px;">
                  <option v-for="projetOption in availableProjets(competence, index)" :key="projetOption.id" :value="projetOption.id">
                    {{ projetOption.name }}
                  </option>
                </select>
  
                <button @click="removeProjet(competence, index)" class="btn btn-danger btn-sm ms-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                    viewBox="0 0 16 16">
                    <path
                      d="M11.742 4.742a1 1 0 0 1 0 1.414L8.414 8l3.328 3.328a1 1 0 1 1-1.414 1.414L7 9.414l-3.328 3.328a1 1 0 0 1-1.414-1.414L5.586 8 2.258 4.742a1 1 0 0 1 1.414-1.414L7 6.586l3.328-3.328a1 1 0 0 1 1.414 1.414z" />
                  </svg>
                </button>
              </div>
  
              <!-- Bouton toujours visible -->
              <button @click="addProjet(competence)" class="btn btn-primary btn-sm">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                  viewBox="0 0 16 16">
                  <path
                    d="M8 3a1 1 0 0 1 1 1v3h3a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9v3a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-3H3a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h3V4a1 1 0 0 1 1-1h2z" />
                </svg> Ajouter un projet
              </button>
            </td>
            <td class="align-middle text-center">
              <button class="btn btn-success" @click="saveCompetence(competence)">Enregistrer</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
  import Trumbowyg from 'vue-trumbowyg';
  import 'trumbowyg/dist/ui/trumbowyg.css';
  
  export default {
    data() {
      return {
        competences: [],
        projets: [],
      };
    },
  
    components: {
      Trumbowyg,
    },
  
    methods: {
      availableProjets(competence, currentIndex) {
        if (!Array.isArray(competence.projet_id)) return this.projets;
        const selected = competence.projet_id.filter((_, i) => i !== currentIndex);
        return this.projets.filter(p => !selected.includes(p.id));
      },
  
      async saveCompetence(competence) {
        if (!Array.isArray(competence.projet_id)) competence.projet_id = [];
        competence.projet_id = competence.projet_id.filter(id => id !== null);
        const data = { ...competence, projet_id: `{${competence.projet_id.join(',')}}` };
  
        Swal.fire({
          title: 'Enregistrer les modifications ?',
          icon: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Annuler',
          confirmButtonText: 'Oui, enregistrer'
        }).then(async (result) => {
          if (result.isConfirmed) {
            try {
              const response = await axios.put('/gestion/competence/save', { data });
              if (response.status === 200) {
                Swal.fire('Succès', 'La compétence a été mise à jour !', 'success');
              } else {
                Swal.fire('Erreur', "Une erreur est survenue.", 'error');
              }
            } catch (error) {
              Swal.fire('Erreur', 'Erreur lors de la mise à jour.', 'error');
            }
          }
        });
      },
  
      addProjet(competence) {
        competence.projet_id.push(null);
      },
  
      removeProjet(competence, index) {
        competence.projet_id.splice(index, 1);
      }
    },
  
    async mounted() {
      try {
        const competencesResponse = await axios.get('/gestion/competences/get');
        const projetsResponse = await axios.get('/gestion/projets/get');
  
        this.competences = competencesResponse.data.map(competence => ({
          ...competence,
          projet_id: competence.projet_id
            ? (Array.isArray(competence.projet_id)
              ? competence.projet_id
              : competence.projet_id
                .replace(/[{}]/g, '')
                .split(',')
                .filter(id => id)
                .map(id => parseInt(id, 10)))
            : []
        }));
  
        this.projets = projetsResponse.data;
      } catch (error) {
        console.error('Erreur lors du chargement des données :', error);
      }
    }
  };
  </script>
  