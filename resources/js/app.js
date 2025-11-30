import './bootstrap';
import { createApp } from 'vue'
import App from './components/App.vue'
import router from './router/index.js'

// Create Vue app
const app = createApp(App)

// Use Vue Router
app.use(router)

// Global properties (optional)
app.config.globalProperties.$apiBaseUrl = import.meta.env.VITE_API_URL || '/api'

// Mount the app to the DOM
app.mount('#app')
