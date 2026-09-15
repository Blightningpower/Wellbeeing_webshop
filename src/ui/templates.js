import { categories } from '../data/products.js';
import { MAX_QUANTITY } from '../domain/cart.js';
import { escapeHtml, formatMoney, productImageUrl } from './format.js';

export function productCard(product) {
  const name = escapeHtml(product.name);
  const tag = product.tag
    ? `<span class="tag ${product.category === 'zaden' ? 'yellow' : ''}">${escapeHtml(product.tag)}</span>`
    : '';
  return `
    <article class="product-card">
      <a class="product-image" href="?product=${product.id}" aria-label="Bekijk ${name}">
        ${tag}
        <img src="${productImageUrl(product.image)}" alt="${name}" loading="lazy" width="350" height="300">
      </a>
      <div class="product-info">
        <p class="category-label">${escapeHtml(categories[product.category])}</p>
        <h3><a href="?product=${product.id}">${name}</a></h3>
        <p class="product-description">${escapeHtml(product.subtitle)}</p>
        <span class="price">${formatMoney(product.price)}</span>
        <button class="add-button" data-add="${product.id}" aria-label="Voeg ${name} toe aan winkelmand">+</button>
      </div>
    </article>`;
}

export function productDetails(product) {
  return `
    <div class="detail-grid">
      <img src="${productImageUrl(product.image)}" alt="${escapeHtml(product.name)}">
      <div>
        <p class="eyebrow">${escapeHtml(categories[product.category])}</p>
        <h2 id="detail-title">${escapeHtml(product.name)}</h2>
        <p class="price">${formatMoney(product.price)}</p>
        <p>${escapeHtml(product.description)}</p>
        <button class="button primary" data-add="${product.id}">In mijn winkelmand <span>+</span></button>
      </div>
    </div>`;
}

export function cartRow({ product, quantity, total }) {
  const name = escapeHtml(product.name);
  return `
    <div class="cart-row">
      <img src="${productImageUrl(product.image)}" alt="${name}">
      <div>
        <h3>${name}</h3>
        <div class="quantity">
          <button data-change="${product.id}" data-delta="-1" aria-label="Eén ${name} minder">−</button>
          <span aria-label="Aantal">${quantity}</span>
          <button data-change="${product.id}" data-delta="1" aria-label="Eén ${name} meer" ${quantity >= MAX_QUANTITY ? 'disabled' : ''}>+</button>
        </div>
      </div>
      <div>
        <span class="price">${formatMoney(total)}</span><br>
        <button class="remove" data-remove="${product.id}" aria-label="Verwijder ${name}">Verwijderen</button>
      </div>
    </div>`;
}

export const emptyCatalog = `
  <div class="empty">
    <h3>Hier zoemt het nog niet.</h3>
    <p>Probeer een andere zoekterm of bekijk alle producten.</p>
    <button class="button" id="reset-filters">Bekijk alles</button>
  </div>`;

export const emptyCart = `
  <div class="empty">
    <p>Je winkelmand wacht op iets moois.</p>
    <button class="button primary" data-close>Ontdek de collectie</button>
  </div>`;

export function cartSummary(subtotal) {
  return `
    <div class="cart-total"><span>Subtotaal</span><strong>${formatMoney(subtotal)}</strong></div>
    <p class="checkout-note">Dit is een demo van de webshop. Je kunt je winkelmand samenstellen en bewaren; bestellen en betalen zijn nog niet aangesloten. Verzendkosten worden daarom nog niet berekend.</p>`;
}
