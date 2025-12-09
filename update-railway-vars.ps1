#!/usr/bin/env pwsh
<#
.SYNOPSIS
Script PowerShell pour mettre à jour les variables du service web vers MySQL interne
#>

Write-Host "🔄 Mise à jour des variables d'environnement Railway..." -ForegroundColor Cyan

# Variables à mettre à jour - utiliser MySQL interne au lieu du proxy externe
$varsToUpdate = @{
    "DB_HOST" = "mysql.railway.internal"
    "DB_PORT" = "3306"
    "DB_USERNAME" = "root"
    "DB_PASSWORD" = "kTRGorKSpkCzShkYbBixbShLWMXYQQPE"
    "DB_DATABASE" = "railway"
}

Write-Host "`n📝 Variables à configurer :" -ForegroundColor Yellow
$varsToUpdate.GetEnumerator() | ForEach-Object {
    Write-Host "   $($_.Key) = $($_.Value)" -ForegroundColor Green
}

Write-Host "`n⚠️  INSTRUCTIONS MANUELLES (si Railway CLI ne supporte pas set) :" -ForegroundColor Yellow
Write-Host "1. Allez sur: https://railway.app" -ForegroundColor White
Write-Host "2. Connectez-vous avec: davidjosiassampa@gmail.com" -ForegroundColor White
Write-Host "3. Selectionnez le projet: natural-integrity" -ForegroundColor White
Write-Host "4. Allez dans l'onglet: Variables" -ForegroundColor White
Write-Host "5. Selectionnez le service: web" -ForegroundColor White
Write-Host "6. Modifiez ces variables :" -ForegroundColor White
$varsToUpdate.GetEnumerator() | ForEach-Object {
    Write-Host "   - $($_.Key) = $($_.Value)" -ForegroundColor Cyan
}

Write-Host "`n✅ Une fois modifiées, le service web sera connecté à MySQL interne !" -ForegroundColor Green
Write-Host "   URL de connexion interne: mysql.railway.internal:3306" -ForegroundColor Gray
