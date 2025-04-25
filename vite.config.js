import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: './install/js/example.vueadmin', // не вложенная папка!
    rollupOptions: {
      input: './src/main.js',
      output: {
        entryFileNames: 'app.bundle.js',
        assetFileNames: 'app.bundle.css',
      },
    },
    emptyOutDir: true
  }
});