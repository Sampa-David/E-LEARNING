#!/bin/bash
# Script pour mettre à jour les variables d'environnement Railway
# Ce script configure la connexion MySQL interne pour le service web

echo "🔄 Mise à jour des variables d'environnement Railway..."

# Variables à mettre à jour
VARS=(
  "DB_HOST=mysql.railway.internal"
  "DB_PORT=3306"
  "DB_USERNAME=root"
  "DB_PASSWORD=kTRGorKSpkCzShkYbBixbShLWMXYQQPE"
  "DB_DATABASE=railway"
)

echo "✅ Variables qui seront configurées :"
for var in "${VARS[@]}"; do
  echo "   - $var"
done

echo ""
echo "⚠️  Pour appliquer ces variables :"
echo "1. Allez sur: https://railway.app"
echo "2. Sélectionnez votre projet 'natural-integrity'"
echo "3. Allez dans l'onglet 'Variables' du service 'web'"
echo "4. Modifiez ces variables :"
for var in "${VARS[@]}"; do
  KEY=$(echo $var | cut -d= -f1)
  VALUE=$(echo $var | cut -d= -f2-)
  echo "   $KEY = $VALUE"
done

echo ""
echo "📝 Ou utilisez la commande Railway CLI si disponible"
