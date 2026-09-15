import test from 'node:test';
import assert from 'node:assert/strict';
import { products } from '../src/data/products.js';
import { selectProducts } from '../src/domain/catalog.js';
import {
  createCartStore,
  MAX_QUANTITY,
  sanitizeCart,
  setQuantity,
  summarizeCart,
} from '../src/domain/cart.js';
import { escapeHtml } from '../src/ui/format.js';

test('category and search combine, with whitespace and case ignored', () => {
  const result = selectProducts(products, { category: 'zaden', query: '  FRIENDLY  ' });
  assert.deepEqual(
    result.map(({ id }) => id),
    [4],
  );
  assert.deepEqual(selectProducts(products, { category: 'honing', query: 'friendly' }), []);
});

test('price sorting preserves the recommended catalog order', () => {
  const originalOrder = products.map(({ id }) => id);
  const sorted = selectProducts(products, { sort: 'low' });
  assert.equal(sorted[0].id, 5);
  assert.equal(sorted.at(-1).id, 1);
  assert.deepEqual(
    products.map(({ id }) => id),
    originalOrder,
  );
  assert.equal(selectProducts(products, { sort: 'high' })[0].id, 1);
});

test('cart totals use integer cents and quantity, not floating-point euros', () => {
  const { count, subtotal } = summarizeCart({ 4: 2, 8: 1 }, products);
  assert.equal(count, 3);
  assert.equal(subtotal, 3122);
});

test('untrusted saved carts discard invalid quantities and unknown products', () => {
  const invalid = { 1: -1, 2: 1.5, 3: '2', 4: 100, 5: 2, 6: null, 999: 1 };
  assert.deepEqual(sanitizeCart(invalid, products), { 5: 2 });
  for (const value of [null, [], 'invalid', 42])
    assert.deepEqual(sanitizeCart(value, products), {});
});

test('quantity limits and removal do not mutate previous state', () => {
  const initial = { 4: 1 };
  assert.deepEqual(setQuantity(initial, 4, 0, products), {});
  assert.deepEqual(setQuantity(initial, 4, 1000, products), { 4: MAX_QUANTITY });
  assert.deepEqual(setQuantity(initial, 999, 2, products), initial);
  assert.deepEqual(initial, { 4: 1 });
});

test('cart persists and restores through a storage adapter', () => {
  const saved = new Map();
  const storage = {
    getItem: (key) => saved.get(key) ?? null,
    setItem: (key, value) => saved.set(key, value),
  };
  const store = createCartStore(products, () => storage);
  assert.deepEqual(store.setQuantity(4, 2), { persisted: true });
  assert.equal(createCartStore(products, () => storage).summary().subtotal, 2130);
});

test('blocked storage and corrupt JSON retain a usable in-memory cart', () => {
  const blocked = createCartStore(products, () => {
    throw new Error('Storage denied');
  });
  assert.deepEqual(blocked.setQuantity(4, 2), { persisted: false });
  assert.equal(blocked.summary().count, 2);
  const corrupt = createCartStore(products, () => ({ getItem: () => '{broken' }));
  assert.equal(corrupt.summary().count, 0);
});

test('product text is escaped before insertion into HTML templates', () => {
  assert.equal(
    escapeHtml('<img src=x onerror="bad"> &'),
    '&lt;img src=x onerror=&quot;bad&quot;&gt; &amp;',
  );
});
