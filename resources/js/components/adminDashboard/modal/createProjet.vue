<template>
    <div class="modal" tabindex="-1" id="creationProjetModal">
        <div class="d-flex justify-content-center modal-dialog modal-lg" style="margin-top: 100px; line-height: 30px;">
            <div class="m-2 bulle-container modal-content">
                <div class="modal-header w-100 mb-0 pb-0">
                    <h1 style="border-radius: 5px 5px 0px 0px; padding: 5px;">Créer un projet</h1>
                    <button type="button" data-bs-dismiss="modal" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="line-height: 40px;">
                    <div>
                        <div class="form-group">
                            <label for="nom">Titre du projet</label>
                            <input id="nom" type="text" class="form-control" v-model="projet.name">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description du projet</label>
                            <trumbowyg class="form-control" v-model="projet.description"></trumbowyg>
                        </div>

                        <div class="d-flex justify-content-between">
                            <div class="mb-5 mt-3">
                                <button class="btn btn-success" data-bs-dismiss="modal"
                                    @click="saveProjets(projet)">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Trumbowyg from 'vue-trumbowyg';
import 'trumbowyg/dist/ui/trumbowyg.css';

export default {
    props: {
        projets: [],
        competences: [],
    },

    data() {
        return {
            projet: {
                name: "",
                description: "",
                competence_id: [], // Liste des compétences associées
            },
        }
    },
    components: {
        Trumbowyg,
    },

    methods: {
        // Récupère le nom de la compétence par son ID
        getCompetenceName(competenceId) {
            const competence = this.competences.find(c => c.id === competenceId);
            return competence ? competence.titre : 'Inconnu';
        },

        async saveProjets(projet) {
            // Vérifier que le nom et la description sont remplis
            if (projet.name !== '' && projet.description !== '') {
                // Vérifier et formater correctement les compétences
                if (!Array.isArray(projet.competence_id)) {
                    projet.competence_id = [];
                }

                // Supprimer les compétences vides (null ou undefined)
                projet.competence_id = projet.competence_id.filter(id => id !== null && id !== undefined);

                // Créer l'objet de données à envoyer
                const data = {
                    name: projet.name,
                    description: projet.description,
                    competence_id: projet.competence_id.join(',') // On envoie les IDs séparés par des virgules
                };

                // Confirmer l'enregistrement avec l'utilisateur
                Swal.fire({
                    title: "Sauvegarder la création ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmer",
                    cancelButtonText: "Annuler"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            // Envoi de la requête POST au back-end pour créer le projet
                            const response = await axios.post("/gestion/projet/create", { data });

                            // Afficher un message de succès ou d'erreur
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                            });

                            if (response.data.statut === 'ok') {
                                Toast.fire({
                                    icon: 'success',
                                    title: response.data.message
                                });
                            } else {
                                Toast.fire({
                                    icon: 'error',
                                    title: response.data.message
                                });
                            }
                        } catch (error) {
                            console.error('Erreur lors de la sauvegarde du projet', error);
                            Swal.fire('Erreur', 'Une erreur s’est produite lors de la sauvegarde du projet.', 'error');
                        }
                    }
                });
            } else {
                Swal.fire('Erreur', 'Veuillez remplir tous les champs obligatoires.', 'error');
            }
        }
    }
}
</script>
