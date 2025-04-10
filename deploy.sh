#!/usr/bin/env sh

# Arrêt si erreur
set -e

# Build du projet
npm run build

# Aller dans le dossier de build
cd dist

# Ajoute cette ligne si tu déploies sur un domaine personnalisé
# echo 'www.tondomaine.com' > CNAME

# Initialiser un repo git temporaire
git init
git add -A
git commit -m 'deploy'

# Pousser sur la branche gh-pages
git push -f git@github.com:Nekrozz/portfolio_alexisdupain.git main:gh-pages

cd -
