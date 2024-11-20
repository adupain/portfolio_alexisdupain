<template>
    <div class="modal" tabindex="-1" id="creationProjetModal">
        <div class="d-flex justify-content-center modal-dialog modal-lg" style="margin-top: 100px; line-height: 30px; ">
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
                        <div class="form-group">
                            <label for="desc">Compétences Associée</label>
                            <select v-if="competence.length > 0" v-model="competences.competences_id" class="form-select">
                                <option v-for="competence in competence" :value="competence.id">{{ competence.titre }}</option>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="mb-5 mt-3">
                                <button class="btn btn-success" data-bs-dismiss="modal" @click="saveProjets(projet)">Valider</button>
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
        competence: [],
    },

    data() {
        return {
            projet: {
                name: "",
                description: "",
                competence_associe: "",
            },
        }
    },
    components: {
        Trumbowyg,
    },

    methods: {

        async saveProjets(projet) {
            if (projet.name != '' || projet.description != '') {
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
                        const response = await axios.post("/gestion/projet/create", { data: projet });
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 4000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        });

                        if (response.data.statut == 'ok') {
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
                    }



                });

            }
        },
    }
}

</script>

<style scoped>
.bulle-container {
    border-radius: 10px;
    background-color: white;
    width: 900px;
    height: 100%;
}

.titre {
    background-color: #187543;
    color: aliceblue;
}
</style>
