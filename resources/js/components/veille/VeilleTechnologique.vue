<template>
    <div class="technology-watch-container">
        <div class="header">
            <h1>Veille Technologique</h1>
            <p>Suivez les dernières tendances et actualités en informatique</p>
        </div>

        <div class="articles">
            <div v-for="(article, index) in sortedArticles" :key="article.title" class="article">
                <h2>{{ article.title }}</h2>
                <p>{{ article.description }}</p>
                <p class="date-created">Publié le : {{ formatDate(article.createdAt) }}</p>
                <a :href="article.url" target="_blank" class="read-more">Lire plus</a>
                <!-- Bouton de suppression -->
                <button @click="deleteArticle(index)" class="delete-btn">Supprimer</button>
            </div>
        </div>

        <!-- Bouton '+' affiché après tous les articles -->
        <div v-if="!isAddingArticle" class="add-article-btn">
            <button @click="toggleAddArticle">+</button>
        </div>

        <!-- Formulaire d'ajout d'article -->
        <div v-if="isAddingArticle" class="d-flex justify-content-start add-article-form">
            <h3>Ajouter un nouvel article</h3>
            <form @submit.prevent="addArticle">
                <input v-model="newArticle.title" type="text" placeholder="Titre de l'article" required />
                <input v-model="newArticle.url" type="url" placeholder="URL de l'article" required />
                <textarea v-model="newArticle.description" placeholder="Description de l'article" required></textarea>
                <button type="submit">Ajouter</button>
                <button @click="cancelAddArticle" class="cancel-btn">Annuler</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            articles: [],
            isAddingArticle: false,
            newArticle: {
                title: "",
                url: "",
                description: "",
                createdAt: new Date()
            }
        }
    },
    computed: {
        sortedArticles() {
            return this.articles.sort((a, b) => b.createdAt - a.createdAt);
        }
    },
    methods: {
        toggleAddArticle() {
            this.isAddingArticle = !this.isAddingArticle;
        },
        addArticle() {
            if (this.newArticle.title && this.newArticle.url && this.newArticle.description) {
                this.articles.push({ ...this.newArticle });
                this.newArticle.title = "";
                this.newArticle.url = "";
                this.newArticle.description = "";
                this.newArticle.createdAt = new Date();
                this.isAddingArticle = false;
            }
        },
        cancelAddArticle() {
            this.isAddingArticle = false;
            this.newArticle.title = "";
            this.newArticle.url = "";
            this.newArticle.description = "";
        },
        deleteArticle(index) {
            this.articles.splice(index, 1);
        },
        formatDate(date) {
            return `${date.toLocaleDateString('fr-FR')} à ${date.toLocaleTimeString('fr-FR')}`;
        }
    }
}
</script>

<style scoped>
/* Container principal */
.technology-watch-container {
    font-family: 'Arial', sans-serif;
    background-color: #f7f7f7;
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

/* En-tête */
.header {
    text-align: center;
    margin-bottom: 40px;
    background-color: #2c3e50;
    color: #fff;
    padding: 30px;
    border-radius: 12px;
}

.header h1 {
    font-size: 40px;
    font-weight: 700;
    margin-bottom: 10px;
}

.header p {
    font-size: 20px;
}

/* Liste des articles */
.articles {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
}

/* Article individuel */
.article {
    background-color: #fff;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.article:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.article h2 {
    font-size: 28px;
    margin-bottom: 15px;
    color: #333;
}

.article p {
    font-size: 16px;
    color: #666;
    line-height: 1.6;
}

.article .date-created {
    font-size: 14px;
    color: #888;
    margin-top: 10px;
}

/* Lien "Lire plus" */
.read-more {
    display: inline-block;
    margin-top: 20px;
    padding: 12px 25px;
    background-color: #3498db;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    transition: background-color 0.3s;
}

.read-more:hover {
    background-color: #2980b9;
}

/* Bouton de suppression */
.delete-btn {
    background-color: #e74c3c;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.delete-btn:hover {
    background-color: #c0392b;
}

/* Bouton d'ajout d'article */
.add-article-btn {
    display: flex;
    justify-content: center;
    margin-top: 30px;
}

.add-article-btn button {
    background-color: #2ecc71;
    color: white;
    font-size: 40px;
    border: none;
    border-radius: 50%;
    padding: 15px 20px;
    cursor: pointer;
    transition: background-color 0.3s;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.add-article-btn button:hover {
    background-color: #27ae60;
}

/* Formulaire d'ajout d'article */
.add-article-form {
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
    transition: transform 0.3s ease;
}

.add-article-form h3 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #333;
}

.add-article-form input,
.add-article-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 16px;
    color: #333;
}

.add-article-form button {
    background-color: #3498db;
    color: white;
    font-size: 18px;
    padding: 12px 30px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.add-article-form button:hover {
    background-color: #2980b9;
}

/* Bouton d'annulation */
.cancel-btn {
    background-color: #e74c3c;
    color: white;
    font-size: 18px;
    padding: 12px 30px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.cancel-btn:hover {
    background-color: #c0392b;
}
</style>
