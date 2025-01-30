<template>
    <div class="cv-container">
        <div class="header">
            <h1>Dupain Alexis</h1>
            <p>Étudiant - Passionné par l'informatique et les technologies</p>
            <div class="button-container">
                <a href="/images/CV Alexis Dupain.pdf" download="CV Alexis Dupain.pdf">
                    <button class="download-btn">Télécharger le CV (PDF)</button>
                </a>
                <a href="/images/CV Alexis Dupain.pdf" target="_blank">
                    <button class="view-btn">Visualiser le CV</button>
                </a>
            </div>
        </div>

        <div class="sections">
            <div class="section profile">
                <h2>Profil</h2>
                <p>Déterminé, sérieux, autonome et conscient du travail qui m'attend, je suis persuadé que je serai un élément moteur au sein de votre structure !</p>
            </div>

            <div class="section contact">
                <h2>Contact</h2>
                <p><strong>Adresse :</strong> 24 chemin d'arnacette, Bayonne 64000</p>
                <p><strong>Email :</strong> dupainalexis@gmail.com</p>
                <p><strong>Téléphone :</strong> 07.67.70.14.01</p>
                <p><strong>Permis B :</strong> en cours</p>
            </div>

            <div class="section interests">
                <h2>Centres d'intérêt</h2>
                <ul>
                    <li>Graphismes</li>
                    <li>Jeux vidéo</li>
                    <li>Montage vidéo</li>
                    <li>Informatique</li>
                </ul>
            </div>

            <div class="section education">
                <h2>Formations</h2>
                <ul>
                    <li>2020 - 2023 : Baccalauréat Professionnel Technicien Conseil et Vente en Univers Jardin : Mention Assez Bien</li>
                    <li>2023 - 2025 : BTS Service Informatique aux Organisations : En cours - 2nd année</li>
                </ul>
            </div>

            <div class="section experiences">
                <h2>Expériences</h2>
                <ul>
                    <li><strong>2021 - 2022 :</strong> Stage Conseiller Vendeur - Jardil Éclore (7 semaines)</li>
                    <li><strong>2022 - 2023 :</strong> Employé Polyvalent - Gamme Vert</li>
                    <li><strong>2023 - 2024 :</strong> Stage de fin d'année, Service Informatique - Planfor (5 semaines)</li>
                    <li><strong>2023 - 2024 :</strong> Job d'été - Lidl (Juillet/Août)</li>
                </ul>
            </div>

            <div class="section skills">
                <h2>Compétences</h2>
                <ul>
                    <li><strong>Langues :</strong> Anglais</li>
                    <li><strong>Logiciels maîtrisés :</strong> Visual Studio Code, Spyder (Python), NetBeans, Canva</li>
                    <li><strong>Langages en apprentissage :</strong> PHP, Java, Android</li>
                </ul>
            </div>
        </div>
    </div>
</template>

<style scoped>
    .cv-container {
        font-family: 'Arial', sans-serif;
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f4f4f4;
        border-radius: 8px;
    }

    .header {
        text-align: center;
        margin-bottom: 30px;
        background-color: #333;
        color: white;
        padding: 20px;
        border-radius: 8px;
    }

    .header h1 {
        margin: 0;
        font-size: 36px;
        font-weight: bold;
    }

    .header p {
        font-size: 18px;
        margin: 0;
    }

    .button-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 20px;
    }

    .download-btn, .view-btn {
        padding: 10px 20px;
        background-color: #3498db;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    .download-btn:hover, .view-btn:hover {
        background-color: #2980b9;
    }

    .view-btn {
        background-color: #2ecc71;
    }

    .view-btn:hover {
        background-color: #27ae60;
    }

    .sections {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
    }

    .section {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .section:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .section h2 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #333;
        border-bottom: 2px solid #3498db;
        padding-bottom: 5px;
    }

    .section p,
    .section ul {
        font-size: 16px;
        color: #555;
        line-height: 1.6;
    }

    .section ul {
        list-style-type: disc;
        padding-left: 20px;
    }

    .section ul li {
        margin-bottom: 8px;
    }

    .section ul li strong {
        font-weight: bold;
        color: #3498db;
    }
</style>
