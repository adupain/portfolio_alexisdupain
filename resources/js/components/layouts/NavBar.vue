<template>
    <div>
        <nav v-if="screenWidth > 900" id="mainNavBar" class="navbar navbar-expand-md navbar-light col-12"
        style="top:0px; height: 80px; z-index: 1000; box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.493); background-color: currentColor;">
            <div class="container">
                <a class="navbar-brand d-flex justify-content-around align-items-center" href="/">
                    <img src="../../../../public/images/LogoAdWeb.png" alt="Logo" width="50" height="50">
                    <h4 style="color: aliceblue; padding: 5px;" class="d-flex text-center mt-2">AdWeb & CO</h4>
                </a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="font-size: 16px">
                    <ul class="navbar-nav me-auto" style="align-items: center">
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/">Accueil</a>
                        </li>
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/portfolio">Portfolio</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-items">
                            <a class="nav-link  text-light" href="/dashboard">Tableau de bord</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div v-else>
            <nav id="mainNavBarTel" class="navbar navbar-expand-md navbar-light col-12"
            style="top:0px; z-index: 1000000; box-shadow: 0px 2px 15px rgba(0, 0, 0, 0.493);">
            <div class="mx-2" style="display: flex; justify-content: space-between; width: 100%; height: 100%;">
                <a class="navbar-brand" style="display: flex; align-items: center; justify-content: center;" href="/">
                    <img src="../../../../public/images/LogoAdWeb.png" alt="Logo" width="30" height="30">
                    <h4 style="color: aliceblue; padding: 5px;" class="d-flex text-center mt-2">AdWeb & CO</h4>
                </a>
                <div class="d-flex justify-content-center" id="burger" style="align-items: center; height: 100%" @click="toggleNavBar">
                    <svg width="45" height="45" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M3 18H21V16H3V18ZM3 13H21V11H3V13ZM3 6V8H21V6H3Z" fill="white"/>
                    </svg>
                </div>
            </div>
        </nav>

        <div id="navBar" :style="{ right: navBarRight }">
            <ul class="navbar-nav">
                <li class="nav-items">
                    <a class="nav-link  text-light" href="/">Accueil</a>
                </li>
                <li class="nav-items">
                    <a class="nav-link  text-light" href="/portfolio">Portfolio</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-items">
                    <a class="nav-link  text-light" href="/dashboard">Tableau de bord</a>
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
    #navBar{
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