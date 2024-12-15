import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

// https://vite.dev/config/
export default defineConfig({
  plugins: [
    laravel([
      'resources/scss/app.scss',
      'resources/ts/Document.ts',
      'resources/ts/Highlight.ts',
      'resources/ts/UsageExample.tsx'
    ]),
    react()
  ],
  build: {
    manifest: true
  }
});
