import axios from 'axios'

// API base URL - adjust for your environment
const API_BASE_URL = import.meta.env.VITE_API_URL || '/api'
console.log(API_BASE_URL)

// Create axios instance with default config
const api = axios.create({
    baseURL: API_BASE_URL,
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
    }
})

// Request interceptor to add auth token if available
api.interceptors.request.use(
    (config) => {
        const token = localStorage.getItem('auth_token')
        if (token) {
            config.headers.Authorization = `Bearer ${token}`
        }
        return config
    },
    (error) => {
        return Promise.reject(error)
    }
)

// Response interceptor for error handling
api.interceptors.response.use(
    (response) => response,
    (error) => {
        if (error.response?.status === 401) {
            // Handle unauthorized access
            localStorage.removeItem('auth_token')
            window.location.href = '/login'
        }
        return Promise.reject(error)
    }
)

// API Service Functions
export const apiService = {
    // Test API connection (now properly in api.php)
    async testConnection() {
        try {
            const response = await api.get('/test')
            return response.data
        } catch (error) {
            console.error('API test failed:', error)
            throw error
        }
    },

    // Authentication methods
    async login(credentials) {
        try {
            const response = await api.post('/v1/login', credentials)
            if (response.data.success && response.data.data.access_token) {
                localStorage.setItem('auth_token', response.data.data.access_token)
            }
            return response.data
        } catch (error) {
            throw error
        }
    },

    async register(userData) {
        try {
            const response = await api.post('/v1/register', userData)
            return response.data
        } catch (error) {
            throw error
        }
    },

    async logout() {
        try {
            const response = await api.post('/v1/logout')
            localStorage.removeItem('auth_token')
            return response.data
        } catch (error) {
            // Even if logout fails on server, clear local token
            localStorage.removeItem('auth_token')
            throw error
        }
    },

    async getProfile() {
        try {
            const response = await api.get('/profile')
            return response.data
        } catch (error) {
            throw error
        }
    },

    // Generic HTTP methods
    async get(url, params = {}) {
        try {
            const response = await api.get(url, { params })
            return response.data
        } catch (error) {
            throw error
        }
    },

    async post(url, data = {}) {
        try {
            const response = await api.post(url, data)
            return response.data
        } catch (error) {
            throw error
        }
    },

    async put(url, data = {}) {
        try {
            const response = await api.put(url, data)
            return response.data
        } catch (error) {
            throw error
        }
    },

    async delete(url) {
        try {
            const response = await api.delete(url)
            return response.data
        } catch (error) {
            throw error
        }
    }
}

export default api
