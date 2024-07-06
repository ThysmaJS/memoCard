import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { useAuthStore } from './stores/auth' // Import useAuthStore
import './index.css'
import './assets/main.css'
import './axios'

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)

const authStore = useAuthStore(pinia)
authStore.initialize() // Call the initialization method to restore the authentication state

app.mount('#app')
