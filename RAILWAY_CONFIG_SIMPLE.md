# 🚂 Configuration Railway - Guide Simplifié

## Configuration Rapide

### 1️⃣ Dans Railway Dashboard

**Ajouter ces variables d'environnement** (Settings → Variables):

```
APP_NAME=E-Learning
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:votre-cle-ici (voir étape 3)
APP_URL=https://votre-domaine.railway.app
DB_CONNECTION=pgsql
LOG_LEVEL=info
SESSION_DRIVER=cookie
CACHE_STORE=file
```

### 2️⃣ Ajouter PostgreSQL Plugin

1. Dans votre projet Railway
2. Cliquer sur **"+ Add"**
3. Chercher **"PostgreSQL"**
4. Ajouter le plugin
5. Les variables `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE` seront auto-peuplées

### 3️⃣ Générer APP_KEY

**En local**:
```bash
php artisan key:generate
# Copier la valeur de APP_KEY du fichier .env
```

**Puis coller dans Railway Dashboard**

### 4️⃣ Variables PostgreSQL Auto-Générées

Railway peuplera automatiquement:
```
DB_HOST=localhost (ou adresse Railway private)
DB_PORT=5432
DB_DATABASE=railway (ou votre nom)
DB_USERNAME=postgres
DB_PASSWORD=auto-générée
```

---

## Fichiers de Configuration

### `Procfile` (Processus de démarrage)
```bash
web: php -S 0.0.0.0:${PORT:-8080} -t public
```

### `railway.json` (Config Railway)
```json
{
  "build": {
    "buildCommand": "composer install --no-dev && npm install && npm run build"
  }
}
```

### `railway-start.sh` (Démarrage custom)
- Crée les répertoires storage
- Exécute migrations (--force)
- Seed la base de données
- Démarre le serveur

---

## 🚀 Processus Complet

```
1. Push code sur GitHub
   ↓
2. Railway redéploie automatiquement
   ↓
3. Composer installe les dépendances
   ↓
4. npm build la partie frontend
   ↓
5. Post-install génère APP_KEY
   ↓
6. Procfile lance le serveur PHP
   ↓
7. Migrations exécutées
   ↓
8. Database seeded
   ↓
9. App prête! 🎉
```

---

## ✅ Checklist

- [ ] PostgreSQL plugin ajouté à Railway
- [ ] Variables d'environnement configurées
- [ ] APP_KEY généré et copié
- [ ] Code pushé sur GitHub
- [ ] Déploiement lancé et réussi
- [ ] App accessible via URL Railway

---

## 🔍 Vérification

Dans **Railway Logs**, vous devriez voir:
```
✨ Starting PHP development server on port 8080...
```

## 🚨 Dépannage

### Build échoue
→ Vérifier que `composer.json` et `package.json` existent

### App crashes au démarrage
→ Vérifier les logs: peut être un problème de variables d'env

### Pas de connexion DB
→ S'assurer que PostgreSQL plugin est bien ajouté

---

## 📞 Support

Consultez `RAILWAY_FIX_DEPLOYMENT.md` pour plus de détails
