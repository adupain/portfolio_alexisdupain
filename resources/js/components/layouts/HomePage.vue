<template>
    <div>
        <div style="width: 100%; height: 100%;">
            <div>
                <h1 class="mt-3 p-2 text-center" style="background-color: rgba(0,0,0,0.11);">A propos de moi</h1>
                <div class="d-flex justify-content-around">
                    <div class="d-flex align-items-center">
                        <img src="/images/PhotoAdWebHomePage.jpg">
                    </div>
                    <h2 style="max-width: 700px;" v-html="propos[0].description">
                    </h2>
                </div>
            </div>
            <div>
                <h1 class="mt-5 mb-3 p-2 text-center" style="background-color: rgba(0,0,0,0.11);">Mes formations</h1>
                <div v-for="formation in formations" class=" mt-4 d-flex jutify-content-around">
                    <div>
                        
                        <ul>
                            <li>
                                <h4><U>{{ formation.name }}</U></h4>
                            </li>
                        </ul>
                        <h5 v-html="formation.description"></h5>
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
</style>