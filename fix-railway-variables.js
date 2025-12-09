#!/usr/bin/env node
/**
 * Script pour modifier les variables d'environnement Railway
 * via l'API GraphQL de Railway
 */

const https = require('https');

// Configuration
const RAILWAY_API = 'api.railway.app';
const PROJECT_ID = '937654f5-255e-466e-8ce9-dfaf934331a6';
const SERVICE_ID = 'f523f7f0-6853-4cd9-ba1b-60c7ad7f822d';
const ENVIRONMENT_ID = '484f4ef0-aa8a-4d5c-b738-601e2f8bdebb';

// Variables à modifier
const VARIABLES_TO_UPDATE = {
  'DB_HOST': 'maglev.proxy.rlwy.net',
  'DB_PORT': '38036',
};

console.log('🔄 Modification des variables Railway...\n');
console.log('Variables à modifier:');
Object.entries(VARIABLES_TO_UPDATE).forEach(([key, value]) => {
  console.log(`  ${key} = ${value}`);
});

console.log('\n⚠️  ATTENTION: Cette approche nécessite un token Railway.');
console.log('   Vous devez configurer manuellement via le dashboard:\n');
console.log('   1. https://railway.app');
console.log('   2. Projet: natural-integrity');
console.log('   3. Service: web');
console.log('   4. Variables:\n');

Object.entries(VARIABLES_TO_UPDATE).forEach(([key, value]) => {
  console.log(`      ${key} = ${value}`);
});

console.log('\n✅ Une fois modifiées, redéployez avec:');
console.log('   npx railway redeploy\n');
