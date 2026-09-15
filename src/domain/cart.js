export const MAX_QUANTITY = 99;
export const CART_STORAGE_KEY = 'wellbeeing-cart';

export function sanitizeCart(value, products) {
  if (!value || typeof value !== 'object' || Array.isArray(value)) return {};
  return Object.fromEntries(
    products.flatMap(({ id }) => {
      const quantity = value[id];
      return Number.isInteger(quantity) && quantity > 0 && quantity <= MAX_QUANTITY
        ? [[id, quantity]]
        : [];
    }),
  );
}

export function setQuantity(cart, productId, quantity, products) {
  if (!products.some(({ id }) => id === productId) || !Number.isInteger(quantity)) return cart;
  const updatedCart = { ...cart };
  if (quantity <= 0) delete updatedCart[productId];
  else updatedCart[productId] = Math.min(quantity, MAX_QUANTITY);
  return updatedCart;
}

export function summarizeCart(cart, products) {
  const validCart = sanitizeCart(cart, products);
  const items = products
    .filter(({ id }) => validCart[id])
    .map((product) => ({
      product,
      quantity: validCart[product.id],
      total: product.price * validCart[product.id],
    }));
  return {
    items,
    count: items.reduce((count, item) => count + item.quantity, 0),
    subtotal: items.reduce((total, item) => total + item.total, 0),
  };
}

// Access is deferred: some browsers throw even when retrieving localStorage.
export function createCartStore(products, getStorage = () => window.localStorage) {
  let cart = {};
  try {
    cart = sanitizeCart(JSON.parse(getStorage().getItem(CART_STORAGE_KEY)), products);
  } catch {
    // A corrupt or unavailable cache must not prevent shopping in memory.
  }
  return {
    summary: () => summarizeCart(cart, products),
    quantity: (id) => cart[id] || 0,
    setQuantity(id, quantity) {
      cart = setQuantity(cart, id, quantity, products);
      try {
        getStorage().setItem(CART_STORAGE_KEY, JSON.stringify(cart));
        return { persisted: true };
      } catch {
        return { persisted: false };
      }
    },
  };
}
