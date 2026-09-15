import { products } from './data/products.js';
import { initializeCatalog } from './features/catalog.js';
import { initializeCart } from './features/cart.js';
import { initializeDialogs } from './features/dialogs.js';
import { createNotifier } from './ui/notifications.js';

const notify = createNotifier(document.querySelector('#toast'));

document.querySelector('#year').textContent = new Date().getFullYear();
initializeCatalog(products);
initializeCart(products, notify);
initializeDialogs(products);
