#!/bin/bash
# Script pour configurer automatiquement les variables Railway
# Ce script utilise l'API ou le dashboard Railway

echo "🔧 Configuration automatique des variables Railway"
echo "=================================================="
echo ""

# Variables à configurer
DB_HOST="maglev.proxy.rlwy.net"
DB_PORT="38036"
DB_USERNAME="root"
DB_PASSWORD="kTRGorKSpkCzShkYbBixbShLWMXYQQPE"
DB_DATABASE="railway"

echo "Variables à appliquer:"
echo "  DB_HOST       = $DB_HOST"
echo "  DB_PORT       = $DB_PORT"
echo "  DB_USERNAME   = $DB_USERNAME"
echo "  DB_DATABASE   = $DB_DATABASE"
echo ""

# Depuis Railway CLI ne supporte pas actuellement 'variable set'
# Nous allons utiliser une approche alternative

echo "⚠️  Railway CLI ne supporte pas la modification directe des variables."
echo ""
echo "Solution 1: Utiliser le Railway Dashboard"
echo "  - Allez sur https://railway.app"
echo "  - Sélectionnez le projet 'natural-integrity'"
echo "  - Sélectionnez le service 'web'"
echo "  - Allez dans 'Variables'"
echo "  - Modifiez:"
echo "    • DB_HOST: $DB_HOST"
echo "    • DB_PORT: $DB_PORT"
echo "  - Cliquez Save"
echo ""
echo "Solution 2: Utiliser un .env.local en production (moins recommandé)"
echo ""

# Vérifier la version de Railway CLI
echo "Version de Railway CLI:"
npx railway --version
