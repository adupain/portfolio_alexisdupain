<template>
    <header>
        <nav v-if="screenWidth > 1200" class="navbar-desktop">
            <div class="container">
                <div class="nav-box">
                    <ul class="nav-links">
                        <li><a href="/">Accueil</a></li>
                        <li><a href="/portfolio">Portfolio</a></li>
                        <li><a href="/cv">Mon CV (Téléchargeable)</a></li>
                        <li><a href="/veille">Veille Technologique</a></li>
                    </ul>
                    <a href="/dashboard" class="dashboard-btn">Tableau de bord</a>
                </div>
            </div>
        </nav>

        <nav v-else class="navbar-mobile">
            <button @click="toggleMenu" class="menu-btn">
                <svg class="icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg" width="30" height="30">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7">
                    </path>
                </svg>
            </button>
        </nav>

        <div class="mobile-menu-overlay" v-if="isMenuOpen" @click="toggleMenu"></div>
        <div class="mobile-menu" :class="{ 'open-menu': isMenuOpen }">
            <div class="menu-box">
                <button class="close-btn" @click="toggleMenu">&times;</button>
                <ul class="nav-links">
                    <li><a href="/" @click="toggleMenu">Accueil</a></li>
                    <li><a href="/portfolio" @click="toggleMenu">Portfolio</a></li>
                    <li><a href="/cv" @click="toggleMenu">Mon CV (Téléchargeable)</a></li>
                    <li><a href="/veille" @click="toggleMenu">Veille Technologique</a></li>
                </ul>
                <a href="/dashboard" class="dashboard-btn" @click="toggleMenu">Tableau de bord</a>
            </div>
        </div>
    </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";

const screenWidth = ref(window.innerWidth);
const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const updateScreenWidth = () => {
    screenWidth.value = window.innerWidth;
};

onMounted(() => {
    window.addEventListener("resize", updateScreenWidth);
    document.body.style.paddingTop = "90px";
});
onUnmounted(() => {
    window.removeEventListener("resize", updateScreenWidth);
});
</script>

<style scoped>
/* 🌐 NAVBAR DESKTOP */
.navbar-desktop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.85);
    backdrop-filter: blur(8px);
    padding: 15px 0;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5);
    z-index: 999;
    display: flex;
    justify-content: center;
}

.container {
    width: 100%;
    max-width: 1400px;
    display: flex;
    justify-content: center;
}

.nav-box {
    width: 100%;
    background: rgba(255, 255, 255, 0.1);
    padding: 12px 30px;
    border-radius: 15px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.nav-links {
    display: flex;
    list-style: none;
    gap: 50px;
    margin: 0;
    padding: 0;
}

.nav-links a {
    text-decoration: none;
    color: #ffffff;
    font-size: 18px;
    font-weight: 500;
    transition: 0.3s ease;
}

.nav-links a:hover {
    color: #ffcc00;
    text-shadow: 0px 0px 10px rgba(255, 204, 0, 0.8);
}

.dashboard-btn {
    background: linear-gradient(45deg, #ffcc00, #ff6600);
    padding: 10px 18px;
    color: white;
    border-radius: 8px;
    font-weight: bold;
    transition: 0.3s ease;
    text-decoration: none;
    font-size: 16px;
}

.dashboard-btn:hover {
    transform: scale(1.1);
}

/* 📱 NAVBAR MOBILE */
.navbar-mobile {
    position: fixed;
    top: 0;
    width: 100%;
    background: rgba(0, 0, 0, 0.85);
    padding: 15px;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    z-index: 999;
}

.menu-btn {
    background: none;
    border: none;
    cursor: pointer;
}

.icon {
    color: #fff;
    font-size: 30px;
}

/* 📱 MENU MOBILE */
.mobile-menu-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    z-index: 998;
    display: none;
}

.show-overlay {
    display: block;
}

.mobile-menu {
    position: fixed;
    top: 15px;
    left: -300px;
    width: 270px;
    height: 100%;
    background: #222;
    box-shadow: 4px 0px 10px rgba(0, 0, 0, 0.5);
    transition: left 0.3s ease-in-out;
    z-index: 999;
    display: flex;
    align-items: center;
    justify-content: start;
    flex-direction: column;
}

.open-menu {
    left: 0;
}

.menu-box {
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 15px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    box-shadow: 0px 0px 15px rgba(255, 255, 255, 0.2);
    width: 90%;
    text-align: center;
}

.mobile-menu .nav-links {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 50px;
}

.mobile-menu .nav-links a {
    color: white;
    font-size: 18px;
    text-decoration: none;
    transition: 0.3s ease;
    padding: 10px 15px;
    border-radius: 8px;
}

.mobile-menu .nav-links a:hover {
    background: rgba(255, 255, 255, 0.2);
}

.mobile-menu .dashboard-btn {
    display: block;
    margin: 20px auto;
    padding: 12px 20px;
    text-align: center;
    font-size: 16px;
    background: linear-gradient(45deg, #ffcc00, #ff6600);
    color: white;
    border-radius: 8px;
    font-weight: bold;
    transition: background 0.3s ease;
    width: 80%;
}

.mobile-menu .dashboard-btn:hover {
    background: linear-gradient(45deg, #e6b800, #cc5500);
}

/* ❌ Bouton de fermeture */
.close-btn {
    position: absolute;
    top: 15px;
    right: 20px;
    font-size: 30px;
    color: white;
    background: none;
    border: none;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.close-btn:hover {
    transform: rotate(90deg);
}

/* 🌍 RESPONSIVE */
@media (max-width: 768px) {
    .nav-box {
        width: 100%;
    }

    .nav-links {
        gap: 20px;
    }

    .mobile-menu {
        width: 100%;
    }
}
</style>
