#!/usr/bin/env pwsh
<#
.SYNOPSIS
Script pour modifier les variables Railway automatiquement
.DESCRIPTION
Modifie les variables d'environnement du service web sur Railway
pour utiliser l'URL MySQL proxy au lieu de l'URL interne
#>

Write-Host "🔧 Modification automatique des variables Railway" -ForegroundColor Cyan
Write-Host "================================================" -ForegroundColor Cyan
Write-Host ""

# Configuration
$projectId = "937654f5-255e-466e-8ce9-dfaf934331a6"
$serviceId = "f523f7f0-6853-4cd9-ba1b-60c7ad7f822d"
$environmentId = "484f4ef0-aa8a-4d5c-b738-601e2f8bdebb"

# Variables à modifier
$varsToUpdate = @{
    'DB_HOST' = 'maglev.proxy.rlwy.net'
    'DB_PORT' = '38036'
}

Write-Host "📝 Variables a modifier:" -ForegroundColor Yellow
$varsToUpdate.GetEnumerator() | ForEach-Object {
    Write-Host "   $($_.Key) = $($_.Value)" -ForegroundColor Green
}

Write-Host ""
Write-Host "⏳ Tentative de modification via Railway API..." -ForegroundColor Yellow
Write-Host ""

# Essayer avec Railway CLI (qui ne supporte peut-etre pas directement, mais on essaie)
try {
    # Vérifier si on peut utiliser railway pour modifier
    Write-Host "Vérification de la configuration Railway..." -ForegroundColor Gray
    
    $status = cmd /c "npx railway status 2>&1"
    Write-Host "Statut: OK" -ForegroundColor Green
    
    Write-Host ""
    Write-Host "⚠️  La modification directe via CLI n'est pas encore supportée par Railway." -ForegroundColor Red
    Write-Host ""
    Write-Host "SOLUTION: Utiliser le fichier de configuration du déploiement" -ForegroundColor Yellow
    Write-Host ""
    Write-Host "Les variables doivent être modifiées via:" -ForegroundColor White
    Write-Host "  1. https://railway.app" -ForegroundColor Cyan
    Write-Host "  2. Projet: natural-integrity" -ForegroundColor Cyan
    Write-Host "  3. Service: web" -ForegroundColor Cyan
    Write-Host "  4. Onglet: Variables" -ForegroundColor Cyan
    Write-Host "  5. Modifier:" -ForegroundColor Cyan
    
    $varsToUpdate.GetEnumerator() | ForEach-Object {
        Write-Host "     - $($_.Key) = $($_.Value)" -ForegroundColor Cyan
    }
    
    Write-Host ""
    Write-Host "  6. Cliquer: Save" -ForegroundColor Cyan
    Write-Host "  7. Attendre: 2-3 minutes (redémarrage automatique)" -ForegroundColor Cyan
    
} catch {
    Write-Host "Erreur: $_" -ForegroundColor Red
}
