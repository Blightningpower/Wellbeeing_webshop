import { selectProducts } from '../domain/catalog.js';
import { emptyCatalog, productCard } from '../ui/templates.js';

export function initializeCatalog(products) {
  const collection = document.querySelector('#collectie');
  const grid = document.querySelector('#products');
  const search = document.querySelector('#search');
  const sort = document.querySelector('#sort');
  const categoryButtons = [...collection.querySelectorAll('[data-category]')];
  let category = 'all';

  function render() {
    const visibleProducts = selectProducts(products, {
      category,
      query: search.value,
      sort: sort.value,
    });
    document.querySelector('#result-count').textContent =
      `${visibleProducts.length} ${visibleProducts.length === 1 ? 'product' : 'producten'}`;
    grid.innerHTML = visibleProducts.length
      ? visibleProducts.map(productCard).join('')
      : emptyCatalog;
  }

  function selectCategory(value) {
    category = value;
    categoryButtons.forEach((button) => {
      const selected = button.dataset.category === category;
      button.classList.toggle('selected', selected);
      button.setAttribute('aria-pressed', String(selected));
    });
    render();
  }

  categoryButtons.forEach((button) => {
    button.addEventListener('click', () => selectCategory(button.dataset.category));
  });
  grid.addEventListener('click', (event) => {
    if (!event.target.closest('#reset-filters')) return;
    search.value = '';
    sort.value = 'recommended';
    selectCategory('all');
    categoryButtons[0].focus();
  });
  sort.addEventListener('change', render);
  search.addEventListener('input', render);
  document.querySelector('#search-toggle').addEventListener('click', () => {
    document.querySelector('#search-row').hidden = false;
    collection.scrollIntoView();
    search.focus({ preventScroll: true });
  });
  document.querySelector('#clear-search').addEventListener('click', () => {
    search.value = '';
    render();
    search.focus();
  });
  document.querySelector('#seed-link').addEventListener('click', () => {
    search.value = '';
    selectCategory('zaden');
    collection.scrollIntoView();
  });
  categoryButtons[0].querySelector('span').textContent = products.length;
  render();
}
