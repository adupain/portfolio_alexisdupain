<template>
    <div>
        <nav v-if="screenWidth > 900" id="mainNavBar" class="navbar navbar-expand-md navbar-light col-12"
            style="top:0px; height: 80px; z-index: 1000; box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.493); background-color: currentColor;">
            <div class="container">
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 16px">
                    <ul class="navbar-nav me-auto" style="align-items: center">
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/">Accueil</a>
                        </li>
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/portfolio">Portfolio</a>
                        </li>
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/cv">Mon CV (Téléchargeable)</a>
                        </li>
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/veille">Veille Technologique</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/securedashboard">Tableau de bord</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div v-else>
            <nav id="mainNavBarTel" class="navbar navbar-expand-md navbar-light col-12"
                style="top:0px; z-index: 1000000; box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.493);">
            </nav>

            <div id="navBar" :style="{ right: navBarRight }">
                <ul class="navbar-nav">
                    <li class="nav-items">
                        <a class="nav-link  text-light" href="/">Accueil</a>
                    </li>
                    <li class="nav-items">
                        <a class="nav-link  text-light" href="/portfolio">Portfolio</a>
                    </li>
                    <li class="nav-items">
                        <a class="nav-link  text-light" href="/cv">Mon Cv (Téléchargeable)</a>
                    </li>
                    <li class="nav-items">
                        <a class="nav-link  text-light" href="/veille">Veille Technologique</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <li class="nav-items">
                        <a class="nav-link  text-light" href="/securedashboard">Tableau de bord</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            screenWidth: window.innerWidth,
            navBarRight: '-200px',
        };
    },

    methods: {
        updateScreenWidth() {
            this.screenWidth = window.innerWidth;
        },

        toggleNavBar() {
            this.navBarRight = this.navBarRight === '0px' ? '-200px' : '0px';
        }
    },

    props: {
    },

    mounted() {
        window.addEventListener('resize', this.updateScreenWidth);

    },

    beforeDestroy() {
        window.removeEventListener('resize', this.updateScreenWidth);
    }
};
</script>

<style scoped>
#navBar {
    transition: right 0.6s;
    position: fixed;
    width: 200px;
    height: calc(100% - 60px);
    z-index: 1000001;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    box-shadow: -10px 5px 5px rgba(0, 0, 0, 0.267);
}
</style>