import { categories } from '../data/products.js';

const comparators = {
  low: (first, second) => first.price - second.price,
  high: (first, second) => second.price - first.price,
  name: (first, second) => first.name.localeCompare(second.name, 'nl'),
};

export function selectProducts(
  products,
  { category = 'all', query = '', sort = 'recommended' } = {},
) {
  const normalizedQuery = query.trim().toLocaleLowerCase('nl');
  const result = products.filter((product) => {
    const matchesCategory = category === 'all' || product.category === category;
    const searchableText = `${product.name} ${product.subtitle} ${categories[product.category]}`;
    return matchesCategory && searchableText.toLocaleLowerCase('nl').includes(normalizedQuery);
  });
  const compare = comparators[sort];
  return compare ? result.sort(compare) : result;
}
