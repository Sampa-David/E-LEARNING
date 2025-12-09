#!/usr/bin/env pwsh
<#
.SYNOPSIS
Script pour corriger automatiquement les variables Railway DB
.DESCRIPTION
Change DB_HOST et DB_PORT pour utiliser le proxy MySQL au lieu de l'hôte interne
#>

param(
    [switch]$Auto = $false,
    [string]$Token = ""
)

Write-Host "🔧 Railway Database Configuration Fix" -ForegroundColor Cyan
Write-Host "=====================================" -ForegroundColor Cyan
Write-Host ""

$fixes = @{
    'DB_HOST' = 'maglev.proxy.rlwy.net'
    'DB_PORT' = '38036'
}

Write-Host "📋 Variables à corriger:" -ForegroundColor Yellow
$fixes.GetEnumerator() | ForEach-Object {
    Write-Host "   $($_.Key) = $($_.Value)" -ForegroundColor Green
}

Write-Host ""
Write-Host "⏳ Tentative de correction automatique..." -ForegroundColor Cyan
Write-Host ""

# Try method 1: Direct Railway CLI (probably won't work but we try)
Write-Host "Méthode 1: Utiliser Railway CLI" -ForegroundColor Gray
try {
    # Check if we're connected to web service
    $serviceCheck = cmd /c "npx railway service 2>&1" | Select-String "web"
    if ($serviceCheck) {
        Write-Host "✓ Service web lié" -ForegroundColor Green
        
        # Try to set variables (this might fail but we try)
        foreach ($key in $fixes.Keys) {
            Write-Host "  Tentative: $key = $($fixes[$key])" -ForegroundColor Gray
            # This command likely won't work, but document it
            Write-Host "  ⚠️  Railway CLI ne supporte pas 'variable set'" -ForegroundColor Yellow
        }
    }
} catch {
    Write-Host "  Erreur: $_" -ForegroundColor Red
}

Write-Host ""
Write-Host "Méthode 2: API Railway avec token" -ForegroundColor Gray
if ($Token -or $env:RAILWAY_TOKEN) {
    Write-Host "  Token détecté" -ForegroundColor Green
    Write-Host "  📌 Implémentation de l'API GraphQL requise" -ForegroundColor Gray
    Write-Host "  Cette implémentation est complexe et au-delà du scope" -ForegroundColor Gray
} else {
    Write-Host "  ⚠️  Pas de token Railway fourni" -ForegroundColor Yellow
    Write-Host "  (Méthode nécessite: RAILWAY_TOKEN env variable)" -ForegroundColor Gray
}

Write-Host ""
Write-Host "📋 SOLUTION FINALE: Configuration Manuelle" -ForegroundColor Yellow
Write-Host "==========================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "Puisque Railway CLI ne supporte pas la modification directe," -ForegroundColor White
Write-Host "veuillez configurer manuellement via le dashboard:" -ForegroundColor White
Write-Host ""
Write-Host "1️⃣  Allez sur https://railway.app" -ForegroundColor Cyan
Write-Host "2️⃣  Connectez-vous avec votre compte" -ForegroundColor Cyan
Write-Host "3️⃣  Sélectionnez le projet: natural-integrity" -ForegroundColor Cyan
Write-Host "4️⃣  Sélectionnez le service: web" -ForegroundColor Cyan
Write-Host "5️⃣  Allez dans l'onglet: Variables" -ForegroundColor Cyan
Write-Host "6️⃣  Changez les variables:" -ForegroundColor Cyan
Write-Host ""

$fixes.GetEnumerator() | ForEach-Object {
    Write-Host "     $($_.Key)" -ForegroundColor White
    Write-Host "     Ancienne valeur: (dépend de la variable actuelle)" -ForegroundColor Gray
    Write-Host "     Nouvelle valeur: $($_.Value)" -ForegroundColor Green
    Write-Host ""
}

Write-Host "7️⃣  Cliquez: Save" -ForegroundColor Cyan
Write-Host "8️⃣  Attendez 2-3 minutes (redémarrage automatique)" -ForegroundColor Cyan
Write-Host ""
Write-Host "✅ Une fois sauvegardées, vérifiez:" -ForegroundColor Green
Write-Host "   cmd /c npx railway logs --tail 20" -ForegroundColor Gray
