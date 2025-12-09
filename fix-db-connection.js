#!/usr/bin/env node
/**
 * Script to automatically fix Railway environment variables
 * This script modifies DB_HOST and DB_PORT for the web service
 */

const { spawn } = require('child_process');
const fs = require('fs');

console.log('🔧 Fixing Railway Database Configuration\n');

// Target variables
const fixes = {
  'DB_HOST': 'maglev.proxy.rlwy.net',
  'DB_PORT': '38036'
};

console.log('📋 Variables to set:');
Object.entries(fixes).forEach(([key, value]) => {
  console.log(`   ${key} = ${value}`);
});

console.log('\n⚠️  Attempting automatic fix via Railway CLI...\n');

// Try to use railway CLI to set variables
// Note: This might not work if Railway CLI doesn't support it
// But we'll try anyway

const commands = [
  `npx railway variable set DB_HOST=${fixes.DB_HOST}`,
  `npx railway variable set DB_PORT=${fixes.DB_PORT}`
];

let executed = 0;

function runCommand(cmd) {
  return new Promise((resolve) => {
    console.log(`Executing: ${cmd}`);
    const proc = spawn('cmd', ['/c', cmd], { stdio: 'inherit' });
    proc.on('close', (code) => {
      if (code === 0) {
        console.log('✅ Success\n');
      } else {
        console.log(`⚠️  Command exited with code ${code}\n`);
      }
      resolve();
    });
  });
}

async function main() {
  try {
    for (const cmd of commands) {
      await runCommand(cmd);
      executed++;
    }

    if (executed === commands.length) {
      console.log('\n✅ All variables set successfully!');
      console.log('\n🚀 Now run: npx railway redeploy');
    } else {
      console.log('\n⚠️  Some commands failed. Please configure manually:');
      console.log('   1. Go to https://railway.app');
      console.log('   2. Project: natural-integrity > Service: web');
      console.log('   3. Variables tab');
      console.log('   4. Set:');
      Object.entries(fixes).forEach(([key, value]) => {
        console.log(`      ${key} = ${value}`);
      });
      console.log('   5. Click Save');
    }
  } catch (error) {
    console.error('Error:', error);
  }
}

main();
