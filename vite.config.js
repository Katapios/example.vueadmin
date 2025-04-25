import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: './install/js/example.vueadmin',
    emptyOutDir: true,
    rollupOptions: {
      input: './src/main.js',
      output: {
        entryFileNames: 'app.bundle.js',
        assetFileNames: 'app.bundle.css',
      }
    }
  }
});