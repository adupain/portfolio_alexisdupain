<template>
    <div>
        <div style="width: 100%; height: 100%;">
            <div>
                <h1 class="mt-3 p-2 text-center" style="background-color: rgba(0,0,0,0.11);">A propos de moi</h1>
                <div class="d-flex justify-content-around">
                    <div class="d-flex align-items-center">
                        <img src="/images/PhotoAdWebHomePage.jpg">
                    </div>
                    <h2 class="m-4" v-html="propos[0].description"></h2>
                </div>
            </div>
            <div>
                <h1 class="mt-5 mb-3 p-2 text-center" style="background-color: rgba(0,0,0,0.11);">Mes formations</h1>
                <div class="d-flex justify-content-around text-center align-items-center">
                    <div v-for="formation in formations">
                        <div class="bubble">
                            <h3>{{ formation.name }}</h3>
                            <h4 v-html="formation.description" class="p-4"></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
        }
    },

    props: {
        propos: [],
        formations: [],
    }
}

</script>

<style scoped>
img {
    width: 500px;
    height: 500px;
}

li{
    max-width: 850px;
}

h3{
    padding: 5px;
}

.bubble {
    background-color: rgba(0,0,0,0.11); /* Couleur de fond */
    border-radius: 15px; /* Coins arrondis */
    padding: 20px; /* Espace intérieur */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Ombre douce */
    margin: 20px;
    border: 1px solid #ddd; /* Bordure fine */
    max-width: 100%;
    border-color: black;
}

.bubble h3 {
    margin-bottom: 10px;
    color: #333;
    text-align: center; /* Centrer le texte */
}

.bubble h4 {
    color: #666;
    font-size: 16px;
}
</style>