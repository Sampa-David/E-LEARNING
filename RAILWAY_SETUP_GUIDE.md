# Configuration Railway - E-Learning

## 🎯 Objectif
Lier le service `web` au service `MySQL` pour que l'application puisse accéder à la base de données.

## 📊 Comparaison des variables

### Service MySQL (✅ Correct)
- `MYSQLHOST`: `mysql.railway.internal`
- `MYSQLPORT`: `3306`
- `MYSQLUSER`: `root`
- `MYSQLPASSWORD`: `kTRGorKSpkCzShkYbBixbShLWMXYQQPE`
- `MYSQLDATABASE`: `railway`

### Service Web (❌ À Modifier)
Actuellement:
- `DB_HOST`: `maglev.proxy.rlwy.net` ❌
- `DB_PORT`: `38036` ❌

Doit être:
- `DB_HOST`: `mysql.railway.internal` ✅
- `DB_PORT`: `3306` ✅

## 🚀 Instructions de configuration

1. **Allez sur Railway Dashboard**
   - URL: https://railway.app
   - Identifiants: davidjosiassampa@gmail.com

2. **Sélectionnez le projet**
   - Nom: `natural-integrity`

3. **Sélectionnez le service web**
   - Cliquez sur le service `web`

4. **Allez dans l'onglet Variables**
   - Cliquez sur "Variables" ou "Environment Variables"

5. **Modifiez les 5 variables suivantes:**

| Variable | Ancienne Valeur | Nouvelle Valeur |
|----------|-----------------|-----------------|
| `DB_HOST` | `maglev.proxy.rlwy.net` | `mysql.railway.internal` |
| `DB_PORT` | `38036` | `3306` |
| `DB_USERNAME` | `root` | `root` |
| `DB_PASSWORD` | `kTRGorKSpkCzShkYbBixbShLWMXYQQPE` | `kTRGorKSpkCzShkYbBixbShLWMXYQQPE` |
| `DB_DATABASE` | `railway` | `railway` |

6. **Sauvegardez les modifications**
   - Le service `web` va redémarrer automatiquement
   - Attendez 2-3 minutes

7. **Vérifiez que l'app fonctionne**
   - URL: https://learning-online.up.railway.app
   - Vous devriez voir la page d'accueil

## ✅ Résultat attendu

Une fois les variables modifiées:
- ✅ Le service `web` peut se connecter à `MySQL` via le réseau interne
- ✅ Les migrations de base de données s'exécutent automatiquement
- ✅ Les données utilisateur sont accessible
- ✅ Le site fonctionne correctement

## 🐛 Dépannage

Si le site affiche encore une erreur 500:

1. **Vérifiez les logs:**
   ```bash
   cd S:\php(Laravel)\Learning
   cmd /c npx railway logs --tail 100
   ```

2. **Vérifiez la connexion à MySQL:**
   ```bash
   cmd /c npx railway run mysql -h mysql.railway.internal -u root -p
   ```

3. **Videz le cache:**
   ```bash
   cmd /c npx railway run php artisan cache:clear
   cmd /c npx railway run php artisan view:clear
   ```

## 📁 Fichiers créés

- `.env.production` - Configuration de production
- `deploy.sh` - Script de déploiement
- `Procfile` - Configuration Railway
- `RAILWAY_CONFIG.txt` - Guide de configuration
- `update-railway-env.js` - Script d'automatisation (en dev)

## 🔗 Ressources utiles

- Railway Dashboard: https://railway.app
- Railway Docs: https://docs.railway.app
- GitHub Repository: https://github.com/Sampa-David/E-LEARNING
