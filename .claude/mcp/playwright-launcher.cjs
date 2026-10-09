// Lanzador del servidor MCP de Playwright para Claude Code.
// Elige los flags según el entorno, para que .mcp.json sea el mismo en todos lados:
//   - Windows / macOS con Chrome instalado: sin flags (Chrome, ventana visible, perfil persistente).
//   - Contenedor cloud de Claude Code (Linux sin Chrome ni DISPLAY): usa el Chromium preinstalado en headless.
// Cualquier variable PLAYWRIGHT_MCP_* definida en el entorno sigue teniendo prioridad.
'use strict';
const { spawn } = require('node:child_process');
const { existsSync } = require('node:fs');
const path = require('node:path');

const root = process.env.CLAUDE_PROJECT_DIR || process.cwd();
const args = ['-y', '@playwright/mcp@latest', '--output-dir', path.join(root, '.playwright-mcp')];

const isLinux = process.platform === 'linux';
const hasChrome = existsSync('/opt/google/chrome/chrome') || existsSync('/usr/bin/google-chrome');
const bundledChromium = ['/opt/pw-browsers/chromium', process.env.PLAYWRIGHT_MCP_EXECUTABLE_PATH].find(p => p && existsSync(p));
const headlessEnv = (process.env.PLAYWRIGHT_MCP_HEADLESS || '').toLowerCase();

if (isLinux && !hasChrome && bundledChromium) {
  if (!process.env.PLAYWRIGHT_MCP_BROWSER) args.push('--browser', 'chromium');
  if (!process.env.PLAYWRIGHT_MCP_EXECUTABLE_PATH) args.push('--executable-path', bundledChromium);
  if (!headlessEnv && !process.env.DISPLAY) args.push('--headless');
}

const cmd = process.platform === 'win32' ? 'npx.cmd' : 'npx';
const child = spawn(cmd, args, { stdio: 'inherit', cwd: root, shell: process.platform === 'win32' });
child.on('exit', code => process.exit(code ?? 0));
child.on('error', err => { process.stderr.write(`[playwright-launcher] ${err.message}\n`); process.exit(1); });
for (const sig of ['SIGINT', 'SIGTERM']) process.on(sig, () => child.kill(sig));
