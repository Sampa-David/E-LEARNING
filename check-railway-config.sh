#!/bin/bash
# Script pour reconfigurer les variables Railway correctement

set -e

echo "🔄 Configuration des variables Railway..."

# Les variables doivent être configurées via le Dashboard Railway
# Cependant, nous pouvons vérifier si le déploiement précédent a fonctionné

echo ""
echo "Vérification de la configuration actuelle..."
php artisan env

echo ""
echo "Vérification de la connexion à la base de données..."
php artisan tinker --execute="DB::connection()->getPdo();"

echo ""
echo "✅ Configuration vérifiée!"
