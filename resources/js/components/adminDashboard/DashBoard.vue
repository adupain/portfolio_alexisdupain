<template>
    <div>
        <div class="d-block w-100 shadow-lg" id="sideBarAdminDashboard">
            <ul class="m-0  d-flex flex-wrap flex-row">
                <li class="col p-2" @click="loadComponent('Propos')">
                    <p class="m-0">Gestion des données "Propos"</p>
                </li>
                <li class="col p-2" @click="loadComponent('Formations')">
                    <p class="m-0">Gestion des données "Formations"</p>
                </li>
                <li class="col p-2" @click="loadComponent('Portfolio')">
                    <p class="m-0">Gestion des données "Portfolio"</p>
                </li>
            </ul>
        </div>
        <div class="pt-3" style="width: 100%;">
            <gestion-propos v-if="loadedPropos"></gestion-propos>
            <gestion-formation v-if="loadedFormation"></gestion-formation>
            <gestion-portfolio v-if="loadedPortfolio"></gestion-portfolio>
        </div>
    </div>
</template>

<script>
import GestionPropos from './GestionPropos.vue'
import GestionFormation from './GestionFormation.vue'
import GestionPortfolio from './GestionPortfolio.vue'
export default {
    data() {
        return {
            loadedPropos: false,
            loadedFormation: false,
            loadedPortfolio: false,

        }
    },

    Components: {
        GestionPropos,
        GestionFormation,
        GestionPortfolio,
    },

    methods: {
        loadComponent(component) {
            switch (component) {
                case 'Propos':
                    this.loadedPropos = true
                    this.loadedFormation = false
                    this.loadedPortfolio = false
                    break;

                case 'Portfolio':
                    this.loadedPropos = false
                    this.loadedFormation = false
                    this.loadedPortfolio = true
                    break;
                
                case 'Formations':
                    this.loadedPropos = false
                    this.loadedFormation = true
                    this.loadedPortfolio = false
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