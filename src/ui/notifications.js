const TOAST_DURATION_MS = 3000;

export function createNotifier(element) {
  let timer;
  return (message) => {
    element.textContent = message;
    element.classList.add('visible');
    clearTimeout(timer);
    timer = setTimeout(() => element.classList.remove('visible'), TOAST_DURATION_MS);
  };
}
