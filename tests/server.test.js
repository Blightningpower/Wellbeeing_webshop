import test from 'node:test';
import assert from 'node:assert/strict';
import { createDevelopmentServer } from '../scripts/serve.js';
import { products } from '../src/data/products.js';

test('server serves the shop, modules, styles, images and legacy product links', async (context) => {
  const server = createDevelopmentServer();
  await new Promise((resolve) => server.listen(0, '127.0.0.1', resolve));
  context.after(() => new Promise((resolve) => server.close(resolve)));
  const base = `http://127.0.0.1:${server.address().port}`;
  const paths = [
    '/',
    '/src/main.js',
    '/assets/styles/main.css',
    ...products.map(({ image }) => `/assets/images/${encodeURIComponent(image)}`),
  ];
  for (const path of paths) {
    const response = await fetch(base + path);
    assert.equal(response.status, 200, path);
  }
  for (const { id } of products) {
    const response = await fetch(`${base}/html/productPage${id}.html`);
    assert.match(await response.text(), new RegExp(`index.html\\?product=${id}`));
  }
  for (const path of [
    '/legacy/php/CreateDb.php',
    '/.git/config',
    '/package.json',
    '/node_modules/eslint/package.json',
    '/assets/%2e%2e%2fpackage.json',
  ]) {
    assert.equal((await fetch(base + path)).status, 404, path);
  }
});
