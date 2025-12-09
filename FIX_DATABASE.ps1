#!/usr/bin/env pwsh
# Script pour corriger automatiquement les variables Railway DB
# Change DB_HOST et DB_PORT pour utiliser le proxy MySQL

Write-Host "Railway Database Configuration Fix" -ForegroundColor Cyan
Write-Host "===================================" -ForegroundColor Cyan
Write-Host ""

$fixes = @{
    'DB_HOST' = 'maglev.proxy.rlwy.net'
    'DB_PORT' = '38036'
}

Write-Host "Variables a corriger:" -ForegroundColor Yellow
$fixes.GetEnumerator() | ForEach-Object {
    Write-Host "   $($_.Key) = $($_.Value)" -ForegroundColor Green
}

Write-Host ""
Write-Host "SOLUTION: Configuration Manuelle via le Dashboard" -ForegroundColor Yellow
Write-Host "=================================================" -ForegroundColor Yellow
Write-Host ""
Write-Host "Railway CLI ne supporte pas la modification directe des variables." -ForegroundColor White
Write-Host ""
Write-Host "1. Allez sur https://railway.app" -ForegroundColor Cyan
Write-Host "2. Connectez-vous avec votre compte" -ForegroundColor Cyan
Write-Host "3. Selectionnez le projet: natural-integrity" -ForegroundColor Cyan
Write-Host "4. Selectionnez le service: web" -ForegroundColor Cyan
Write-Host "5. Allez dans l'onglet: Variables" -ForegroundColor Cyan
Write-Host "6. Changez les variables:" -ForegroundColor Cyan
Write-Host ""

$fixes.GetEnumerator() | ForEach-Object {
    Write-Host "   $($_.Key) = $($_.Value)" -ForegroundColor Cyan
}

Write-Host ""
Write-Host "7. Cliquez: Save" -ForegroundColor Cyan
Write-Host "8. Attendez 2-3 minutes (redemarrage automatique)" -ForegroundColor Cyan
Write-Host ""
Write-Host "Verification apres modification:" -ForegroundColor Green
Write-Host "   cmd /c npx railway logs --tail 20" -ForegroundColor Gray
