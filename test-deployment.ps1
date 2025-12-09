#!/usr/bin/env pwsh
# Test script pour vérifier l'app en production

$appUrl = "https://learning-online.up.railway.app"
$testEndpoints = @(
    "/",
    "/courses",
    "/login",
    "/register"
)

Write-Host "🚀 Testing E-Learning App Deployment" -ForegroundColor Cyan
Write-Host "URL: $appUrl`n" -ForegroundColor Yellow

foreach ($endpoint in $testEndpoints) {
    $url = "$appUrl$endpoint"
    Write-Host "Testing: $url" -ForegroundColor Green
    
    try {
        $response = Invoke-WebRequest -Uri $url -MaximumRedirection 0 -SkipHttpErrorCheck
        $status = $response.StatusCode
        
        if ($status -eq 200) {
            Write-Host "  ✅ OK (200)" -ForegroundColor Green
        } elseif ($status -eq 302 -or $status -eq 301) {
            Write-Host "  ⚠️  Redirect ($status)" -ForegroundColor Yellow
        } else {
            Write-Host "  ❌ Error ($status)" -ForegroundColor Red
        }
    } catch {
        Write-Host "  ❌ Connection Failed: $_" -ForegroundColor Red
    }
}

Write-Host "`nTest completed!" -ForegroundColor Cyan
