import { createCartStore, MAX_QUANTITY } from '../domain/cart.js';
import { cartRow, cartSummary, emptyCart } from '../ui/templates.js';

export function initializeCart(products, notify) {
  const store = createCartStore(products);
  const itemsElement = document.querySelector('#cart-items');
  const summaryElement = document.querySelector('#cart-summary');
  const cartDialog = document.querySelector('#cart-dialog');

  function render() {
    const { items, count, subtotal } = store.summary();
    document.querySelector('#cart-count').textContent = count;
    document
      .querySelector('#open-cart')
      .setAttribute(
        'aria-label',
        `Open winkelmand, ${count} ${count === 1 ? 'product' : 'producten'}`,
      );
    itemsElement.innerHTML = items.length ? items.map(cartRow).join('') : emptyCart;
    summaryElement.innerHTML = items.length ? cartSummary(subtotal) : '';
  }

  function updateQuantity(id, quantity, message) {
    const { persisted } = store.setQuantity(id, quantity);
    render();
    const storageWarning = 'Je browser kan de winkelmand niet bewaren na herladen.';
    if (message || !persisted) {
      notify([message, !persisted && storageWarning].filter(Boolean).join(' '));
    }
  }

  function addProduct(event) {
    const button = event.target.closest('[data-add]');
    if (!button) return;
    const id = Number(button.dataset.add);
    const product = products.find((product) => product.id === id);
    if (!product) return;
    const quantity = store.quantity(id);
    if (quantity >= MAX_QUANTITY) {
      notify(`Je kunt maximaal ${MAX_QUANTITY} stuks per product toevoegen.`);
      return;
    }
    updateQuantity(id, quantity + 1, `${product.name} zit in je winkelmand.`);
  }

  // Only the catalog and product dialog can add products, not arbitrary page links.
  document.querySelector('#products').addEventListener('click', addProduct);
  document.querySelector('#product-detail').addEventListener('click', addProduct);
  itemsElement.addEventListener('click', (event) => {
    const button = event.target.closest('[data-change], [data-remove]');
    if (!button) return;
    const id = Number(button.dataset.change || button.dataset.remove);
    const delta = Number(button.dataset.delta || 0);
    const quantity = button.hasAttribute('data-remove') ? 0 : store.quantity(id) + delta;
    updateQuantity(id, quantity);
    const replacement = itemsElement.querySelector(`[data-change="${id}"][data-delta="${delta}"]`);
    const focusTarget =
      replacement && !replacement.disabled ? replacement : cartDialog.querySelector('.close');
    focusTarget.focus();
  });
  render();
}
