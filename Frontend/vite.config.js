import { defineConfig } from 'vite'
import vue from '@vitejs/plugin-vue'

export default defineConfig({
  plugins: [vue()],
  build: {
    outDir: 'dist'
  },
  server: {
    host: '0.0.0.0',
    watch: {
      usePolling: true,
    },
  },
})
