import js from '@eslint/js';
import globals from 'globals';

export default [
  { ignores: ['legacy/**', '.idea/**'] },
  js.configs.recommended,
  {
    files: ['src/**/*.js'],
    languageOptions: { globals: globals.browser },
    rules: { eqeqeq: 'error', 'no-var': 'error', 'prefer-const': 'error' },
  },
  { files: ['scripts/**/*.js', 'tests/**/*.js'], languageOptions: { globals: globals.node } },
];
