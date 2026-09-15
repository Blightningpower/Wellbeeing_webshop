const currencyFormatter = new Intl.NumberFormat('nl-NL', {
  style: 'currency',
  currency: 'EUR',
});

export const formatMoney = (cents) => currencyFormatter.format(cents / 100);

export function escapeHtml(value) {
  const replacements = { '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' };
  return String(value).replace(/[&<>"']/g, (character) => replacements[character]);
}

export function productImageUrl(filename) {
  return new URL(`../../assets/images/${encodeURIComponent(filename)}`, import.meta.url).href;
}
