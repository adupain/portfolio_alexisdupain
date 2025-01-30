<template>
    <div>
        <div class="d-block w-100 shadow-lg" id="sideBarAdminDashboard">
            <ul class="m-0  d-flex flex-wrap flex-row">
                <li class="col p-2" @click="loadComponent('Projet')">
                    <p class="m-0">Visualisation par projets</p>
                </li>
                <li class="col p-2" @click="loadComponent('Projet-Competence')">
                    <p class="m-0">Visualisation par competénces</p>
                </li>
            </ul>
        </div>
        <div class="pt-3" style="width: 100%;">
            <liste-projet v-if="loadedProjet"></liste-projet>
            <liste-projet-competence v-if="loadedProjetCompetence"></liste-projet-competence>
        </div>
    </div>
</template>

<script>
import ListeProjet from './ListeProjet.vue'
import ListeProjetCompetence from './ListeProjetCompetence.vue'
export default {
    data() {
        return {
            loadedProjet: true,
            loadedProjetCompetence: false,

        }
    },

    Components: {
        ListeProjet,
        ListeProjetCompetence,
    },

    methods: {
        loadComponent(component) {
            switch (component) {
                case 'Projet':
                    this.loadedProjet = true
                    this.loadedProjetCompetence = false
                    break;

                case 'Projet-Competence':
                    this.loadedProjet = false
                    this.loadedProjetCompetence = true
                    break;

                default:
                    break;
            }
        }
    }

}
</script>

<style>
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
</style>