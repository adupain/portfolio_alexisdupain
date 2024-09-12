<template>
    <div class="container-fluid">
        <h1>Gestion des données "Propos"</h1>
       <table class="table table-bordered table-responsive">
        <thead class="table-dark table-sm">
            <tr>
                <th class="align-middle text-center text-light">
                        Description
                    </th>
                    <th class="align-middle text-center text-light">
                        Actions
                    </th>
            </tr>
        </thead>
        <tbody v-if="propos.length > 0">
            <tr>
                <td>
                    <div class="d-flex justify-content-between">
                        <div v-if="!propos[0].show_description" v-html="propos[0].description"></div>
                        <button class="btn btn-primary btn-sm col-auto" @click="propos[0].show_description = !propos[0].show_description">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" viewBox="0 0 16 16">
                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325"/>
                            </svg>
                        </button>
                        <div v-show="propos[0].show_description">
                            <trumbowyg class="form-control" v-model="propos[0].description"></trumbowyg>
                        </div>
                    </div>
                </td>
                <td class="aligne-middle text-center">
                    <button class="btn btn-success" @click="savePropos(propos)">Enregistrer</button>
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
            propos: [],
        }
    },

    components: {
        Trumbowyg,
    },

    methods: {
        async savePropos(propos) {
            if (propos[0].description != '') {
                Swal.fire({
                    title: "Sauvegarder les données ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Confirmer",
                    cancelButtonText: "Annuler"
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const response = await axios.put("/gestion/propos/save", { data: propos[0] });

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
    },
    
    async mounted() {
        this.$nextTick(async function () {
            this.propos= await axios.get('/gestion/propos/get');
            this.propos= this.propos.data;
        })
    },

}
</script>