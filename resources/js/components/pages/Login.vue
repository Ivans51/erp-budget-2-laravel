<template>
  <!-- Login Form -->
  <form @submit.prevent="handleLogin" class="space-y-6">
    <div>
      <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
        Email Address
      </label>
      <input
        id="email"
        v-model="form.email"
        type="email"
        required
        class="form-input"
        placeholder="Enter your email"
      />
    </div>

    <div>
      <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
        Password
      </label>
      <input
        id="password"
        v-model="form.password"
        type="password"
        required
        class="form-input"
        placeholder="Enter your password"
      />
    </div>

    <div class="flex items-center justify-between">
      <div class="flex items-center">
        <input
          id="remember-me"
          v-model="form.remember"
          type="checkbox"
          class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
        />
        <label for="remember-me" class="ml-2 block text-sm text-gray-900">
          Remember me
        </label>
      </div>
      <a href="#" class="text-sm text-indigo-600 hover:text-indigo-500">
        Forgot password?
      </a>
    </div>

    <div>
      <button
        type="submit"
        :disabled="isLoading"
        class="btn-primary w-full disabled:opacity-50 disabled:cursor-not-allowed"
      >
        {{ isLoading ? 'Signing in...' : 'Sign in' }}
      </button>
    </div>
  </form>

  <!-- Demo Actions -->
  <div class="mt-6 space-y-3">
    <button
      @click="demoLogin"
      class="btn-secondary w-full"
    >
      Demo Login (No Backend Required)
    </button>
  </div>

  <!-- Sign up link -->
  <div class="mt-6 text-center">
    <p class="text-sm text-gray-600">
      Don't have an account?
      <router-link to="/auth/register" class="text-indigo-600 hover:text-indigo-500 font-medium">
        Sign up here
      </router-link>
    </p>
  </div>
</template>

<script setup>
import {ref} from 'vue'
import {useRoute, useRouter} from 'vue-router'
import {apiService} from '@/services/api.js'
import {alertService} from '@/services/alert.js'

const router = useRouter()
const route = useRoute()

// Reactive data
const isLoading = ref(false)

const form = ref({
  email: '',
  password: '',
  remember: false
})


// Methods
const handleLogin = async () => {
  isLoading.value = true

  try {
    // Show loading alert
    alertService.loading('Signing in...', 'Please wait while we verify your credentials')

    // Call the Laravel API
    const response = await apiService.login({
      email: form.value.email,
      password: form.value.password
    })

    // Close loading alert
    alertService.close()

    if (response.success) {
      // Show success message and redirect
      await alertService.success('Login successful! Redirecting to dashboard...', 'Welcome!', {
      })

      // Redirect to intended route or dashboard
      const redirectTo = route.query.redirect || '/dashboard'
      router.push(redirectTo)
    } else {
      throw new Error(response.message || 'Login failed')
    }

  } catch (err) {
    // Use the alert service's HTTP error handler
    alertService.httpError(err, 'Login failed. Please try again.')
  } finally {
    isLoading.value = false
  }
}

const demoLogin = () => {
  form.value.email = 'test3@example.com'
  form.value.password = '12345678*'
  handleLogin()
}

// Check if user is already authenticated
const checkAuthStatus = () => {
  const token = localStorage.getItem('auth_token')
  if (token) {
    // User is already logged in, redirect to dashboard
    router.push('/dashboard')
  }
}

checkAuthStatus()
</script>
