import test from 'node:test';
import assert from 'node:assert/strict';
import { readFile, readdir } from 'node:fs/promises';
import { resolve, dirname, relative } from 'node:path';
import { fileURLToPath } from 'node:url';
import { products } from '../src/data/products.js';

const root = fileURLToPath(new URL('../', import.meta.url));

async function filesIn(directory) {
  const entries = await readdir(resolve(root, directory), { withFileTypes: true });
  const nested = await Promise.all(
    entries.map((entry) => {
      const path = `${directory}/${entry.name}`;
      return entry.isDirectory() ? filesIn(path) : [path];
    }),
  );
  return nested.flat();
}

test('all active JS and CSS files are reachable from the page entry points', async () => {
  const visited = new Set();
  async function visit(path) {
    if (visited.has(path)) return;
    visited.add(path);
    const source = await readFile(resolve(root, path), 'utf8');
    const references = path.endsWith('.html')
      ? [...source.matchAll(/(?:src|href)="([^"?#]+)"/g)].map((match) => match[1])
      : [...source.matchAll(/(?:from\s*|@import\s+url\()["']([^"']+)["']/g)].map(
          (match) => match[1],
        );
    for (const reference of references) {
      if (!/\.(js|css)$/.test(reference)) continue;
      const dependency = relative(root, resolve(root, dirname(path), reference)).replaceAll(
        '\\',
        '/',
      );
      await visit(dependency);
    }
  }
  await visit('index.html');
  for (const path of [...(await filesIn('src')), ...(await filesIn('assets/styles'))]) {
    assert.ok(visited.has(path), `Unused source file: ${path}`);
  }
});

test('active images have a catalog or HTML reference and all references exist', async () => {
  const html = await readFile(resolve(root, 'index.html'), 'utf8');
  const referenced = new Set(products.map(({ image }) => image));
  for (const match of html.matchAll(/assets\/images\/([^"']+)/g)) referenced.add(match[1]);
  const actual = await readdir(resolve(root, 'assets/images'));
  assert.deepEqual([...referenced].sort(), actual.sort());
});
