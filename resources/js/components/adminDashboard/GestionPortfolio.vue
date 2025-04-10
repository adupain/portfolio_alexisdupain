<template>
    <div class="container-fluid">
        <create-projet :projets="projets" :competences="competences"></create-projet>
        <h1>Gestion des données "Portfolio"</h1>
        <button class="btn btn-success mb-3" @click="openModalCreateProjet">Créer un projet</button>
        <table class="table table-bordered table-responsive">
            <thead class="table-dark table-sm">
                <tr>
                    <th class="align-middle text-center text-light">Nom</th>
                    <th class="align-middle text-center text-light">Description</th>
                    <th class="align-middle text-center text-light">Compétences associées</th>
                    <th class="align-middle text-center text-light">Actions</th>
                </tr>
            </thead>
            <tbody v-if="projets.length > 0" v-for="projet in projets" :key="projet.id">
                <tr>
                    <td class="align-middle">
                        <input type="text" v-model="projet.name" style="width: 600px;">
                    </td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <div v-if="!projet.show_description" v-html="projet.description"></div>
                            <button class="btn btn-primary btn-sm col-auto"
                                @click="projet.show_description = !projet.show_description">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                </svg>
                            </button>
                            <div v-show="projet.show_description">
                                <trumbowyg class="form-control" v-model="projet.description"></trumbowyg>
                            </div>
                        </div>
                    </td>
                    <td>
                        <!-- Liste des compétences avec modification -->
                        <div v-for="(competence, index) in projet.competence_id" :key="index"
                            class="d-flex align-items-center mb-2">
                            <select v-model="projet.competence_id[index]" class="form-select">
                                <option v-for="competenceOption in availableCompetences(projet, index)"
                                    :key="competenceOption.id" :value="competenceOption.id">
                                    {{ competenceOption.titre }}
                                </option>
                            </select>

                            <button @click="removeCompetence(projet, index)" class="btn btn-danger btn-sm ms-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 4.742a1 1 0 0 1 0 1.414L8.414 8l3.328 3.328a1 1 0 1 1-1.414 1.414L7 9.414l-3.328 3.328a1 1 0 0 1-1.414-1.414L5.586 8 2.258 4.742a1 1 0 0 1 1.414-1.414L7 6.586l3.328-3.328a1 1 0 0 1 1.414 1.414z" />
                                </svg>
                            </button>
                        </div>

                        <!-- Bouton Ajouter une compétence -->
                        <button v-if="projet.competence_id.length < 6" @click="addCompetence(projet)"
                            class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff"
                                viewBox="0 0 16 16">
                                <path
                                    d="M8 3a1 1 0 0 1 1 1v3h3a1 1 0 0 1 1 1v2a1 1 0 0 1-1 1H9v3a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1v-3H3a1 1 0 0 1-1-1v-2a1 1 0 0 1 1-1h3V4a1 1 0 0 1 1-1h2z" />
                            </svg> Ajouter une compétence
                        </button>

                        <!-- Limite atteinte -->
                        <p v-if="projet.competence_id.length >= 6" class="text-danger mt-2">Limite de 6 compétences
                            atteinte</p>
                    </td>

                    <td class="align-middle text-center">
                        <button class="btn btn-success" @click="saveProjets(projet)">Enregistrer</button>
                        <button class="btn btn-danger" @click="deleteProjets(projet)">Supprimer</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import Trumbowyg from 'vue-trumbowyg';
import 'trumbowyg/dist/ui/trumbowyg.css';
import createProjet from './modal/createProjet.vue';

export default {
    data() {
        return {
            projets: [],
            competences: [],
        };
    },

    components: {
        Trumbowyg,
        createProjet,
    },

    methods: {
        availableCompetences(projet, currentIndex) {
            if (!Array.isArray(projet.competence_id)) return this.competences;
            const selectedCompetences = projet.competence_id.filter((_, index) => index !== currentIndex);
            return this.competences.filter(competence => !selectedCompetences.includes(competence.id));
        },

        async saveProjets(projet) {
            if (!Array.isArray(projet.competence_id)) projet.competence_id = [];
            projet.competence_id = projet.competence_id.filter(id => id !== null);
            const data = { ...projet, competence_id: `{${projet.competence_id.join(',')}}` };

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Vous êtes sur le point de sauvegarder ce projet.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Oui, sauvegarder',
                cancelButtonText: 'Annuler'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await axios.put('/gestion/projets/save', { data });
                        if (response.status === 200) {
                            Swal.fire('Succès', 'Le projet a été sauvegardé avec succès !', 'success');
                        } else {
                            Swal.fire('Erreur', "Une erreur est survenue lors de la sauvegarde.", 'error');
                        }
                    } catch (error) {
                        Swal.fire('Erreur', 'Une erreur s’est produite. Veuillez réessayer.', 'error');
                    }
                }
            });
        },

        async deleteProjets(projet) {
            if (projet.id != '') {
                Swal.fire({
                    title: 'Êtes-vous sûr ?',
                    text: "Cette action supprimera définitivement le projet.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await axios.delete(`/gestion/projets/delete/${projet.id}`);
                            if (response.status === 200) {
                                this.projets = this.projets.filter(p => p.id !== projet.id);
                                Swal.fire('Supprimé !', 'Le projet a été supprimé avec succès.', 'success');
                            } else {
                                Swal.fire('Erreur', "Une erreur est survenue lors de la suppression.", 'error');
                            }
                        } catch (error) {
                            Swal.fire('Erreur', 'Impossible de supprimer le projet. Veuillez réessayer.', 'error');
                        }
                    }
                });
            } else {
                // Si le projet n'a pas d'ID (projet non enregistré), on le retire de la liste
                this.projets = this.projets.filter(p => p !== projet);
            }
        },

        addCompetence(projet) {
            if (projet.competence_id.length < 6) projet.competence_id.push(null);
        },

        removeCompetence(projet, index) {
            projet.competence_id.splice(index, 1);
        },

        openModalCreateProjet() {
            $('#creationProjetModal').modal('show');
        }
    },

    async mounted() {
        try {
            // Récupération des projets
            const projetsResponse = await axios.get('/gestion/projets/get');
            const competencesResponse = await axios.get('/gestion/competences/get');

            // Correction : gérer les cas où competence_id est null ou non formaté
            this.projets = projetsResponse.data.map(projet => ({
                ...projet,
                competence_id: projet.competence_id
                    ? (Array.isArray(projet.competence_id)
                        ? projet.competence_id
                        : projet.competence_id
                            .replace(/[{}]/g, '') // Retirer les accolades si présentes
                            .split(',')          // Convertir en tableau
                            .filter(id => id)    // Supprimer les valeurs nulles ou vides
                            .map(id => parseInt(id, 10)) // Convertir en nombre
                    )
                    : [] // Si competence_id est null, initialiser comme tableau vide
            }));

            // Récupération des compétences
            this.competences = competencesResponse.data;
        } catch (error) {
            console.error('Erreur lors de la récupération des données :', error);
        }
    }
};
</script>
