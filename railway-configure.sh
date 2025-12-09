#!/bin/bash
# Script pour configurer automatiquement les variables d'environnement Railway
# Ce script doit etre execute apres le push pour modifier les variables du service web

set -e

PROJECT_ID="937654f5-255e-466e-8ce9-dfaf934331a6"
SERVICE_ID="f523f7f0-6853-4cd9-ba1b-60c7ad7f822d"

echo "🔄 Configuration automatique des variables Railway..."
echo "Projet: natural-integrity"
echo "Service: web"
echo ""

# Variables a modifier
declare -A VARS=(
    ["DB_HOST"]="mysql.railway.internal"
    ["DB_PORT"]="3306"
    ["DB_USERNAME"]="root"
    ["DB_PASSWORD"]="kTRGorKSpkCzShkYbBixbShLWMXYQQPE"
    ["DB_DATABASE"]="railway"
)

echo "📝 Variables a configurer :"
for key in "${!VARS[@]}"; do
    echo "   $key = ${VARS[$key]}"
done

echo ""
echo "⚠️  IMPORTANT: Railway CLI ne supporte pas actuellement la modification"
echo "   des variables par la ligne de commande."
echo ""
echo "🔗 Veuillez configurer manuellement via le dashboard:"
echo "   https://railway.app/project/$PROJECT_ID"
echo ""
echo "Etapes:"
echo "  1. Connectez-vous a Railway"
echo "  2. Allez dans le projet 'natural-integrity'"
echo "  3. Selectionnez le service 'web'"
echo "  4. Allez dans l'onglet 'Variables'"
echo "  5. Modifiez ces variables:"
for key in "${!VARS[@]}"; do
    echo "     - $key = ${VARS[$key]}"
done
echo ""
echo "✅ Une fois les variables modifiees, le service se redemarrera automatiquement"
