import { productDetails } from '../ui/templates.js';

export function initializeDialogs(products) {
  const productDialog = document.querySelector('#product-dialog');
  const cartDialog = document.querySelector('#cart-dialog');
  const dialogs = [productDialog, cartDialog];

  function clearRoute() {
    const url = new URL(window.location.href);
    url.searchParams.delete('product');
    url.searchParams.delete('cart');
    window.history.replaceState({}, '', url);
  }

  function closeDialog(dialog) {
    dialog.close();
    clearRoute();
  }

  function syncRoute() {
    dialogs.forEach((dialog) => {
      if (dialog.open) dialog.close();
    });
    const parameters = new URLSearchParams(window.location.search);
    const product = products.find(({ id }) => id === Number(parameters.get('product')));
    if (product) {
      document.querySelector('#product-detail').innerHTML = productDetails(product);
      productDialog.showModal();
    } else if (parameters.get('cart') === 'open') {
      cartDialog.showModal();
    }
  }

  function openProduct(event) {
    const link = event.target.closest('a[href^="?product="]');
    if (
      !link ||
      event.ctrlKey ||
      event.metaKey ||
      event.shiftKey ||
      event.altKey ||
      event.button !== 0
    )
      return;
    event.preventDefault();
    window.history.pushState({}, '', link.href);
    syncRoute();
  }

  document.querySelector('main').addEventListener('click', openProduct);
  document.querySelector('#open-cart').addEventListener('click', () => cartDialog.showModal());
  dialogs.forEach((dialog) => {
    dialog.addEventListener('cancel', clearRoute);
    dialog.addEventListener('click', (event) => {
      if (event.target.closest('[data-close]')) {
        closeDialog(dialog);
        return;
      }
      if (event.target !== dialog) return;
      const { left, right, top, bottom } = dialog.getBoundingClientRect();
      const outside =
        event.clientX < left ||
        event.clientX > right ||
        event.clientY < top ||
        event.clientY > bottom;
      if (outside) closeDialog(dialog);
    });
  });
  // Dialog close events do not modify the URL: back/forward remains deterministic.
  window.addEventListener('popstate', syncRoute);
  syncRoute();
}
