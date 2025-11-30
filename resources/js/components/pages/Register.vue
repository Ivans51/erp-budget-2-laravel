<template>
  <!-- Registration Form -->
    <form @submit.prevent="handleRegister" class="space-y-6">
      <div class="grid grid-cols-2 gap-4">
        <div>
          <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">
            First Name
          </label>
          <input
            id="firstName"
            v-model="form.firstName"
            type="text"
            required
            class="form-input"
            placeholder="John"
          />
        </div>
        <div>
          <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">
            Last Name
          </label>
          <input
            id="lastName"
            v-model="form.lastName"
            type="text"
            required
            class="form-input"
            placeholder="Doe"
          />
        </div>
      </div>

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
          placeholder="john.doe@example.com"
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
          minlength="8"
          class="form-input"
          placeholder="At least 8 characters"
        />
      </div>

      <div>
        <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-2">
          Confirm Password
        </label>
        <input
          id="confirmPassword"
          v-model="form.confirmPassword"
          type="password"
          required
          class="form-input"
          placeholder="Confirm your password"
        />
      </div>

      <div>
        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">
          Role
        </label>
        <select
          id="role"
          v-model="form.role"
          required
          class="form-input"
        >
          <option value="">Select a role</option>
          <option value="user">Regular User</option>
          <option value="admin">Administrator</option>
          <option value="developer">Developer</option>
        </select>
      </div>

      <div class="flex items-center">
        <input
          id="terms"
          v-model="form.terms"
          type="checkbox"
          required
          class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
        />
        <label for="terms" class="ml-2 block text-sm text-gray-900">
          I agree to the
          <a href="#" class="text-indigo-600 hover:text-indigo-500">Terms of Service</a>
          and
          <a href="#" class="text-indigo-600 hover:text-indigo-500">Privacy Policy</a>
        </label>
      </div>

      <div>
        <button
          type="submit"
          :disabled="isLoading"
          class="btn-primary w-full disabled:opacity-50 disabled:cursor-not-allowed"
        >
          {{ isLoading ? 'Creating Account...' : 'Create Account' }}
        </button>
      </div>
    </form>

    <!-- Demo Actions -->
    <div class="mt-6 space-y-3">
      <button
        @click="demoRegister"
        class="btn-secondary w-full"
      >
        Demo Register (No Backend Required)
      </button>
    </div>

    <!-- Error Display -->
    <div v-if="error" class="mt-4 bg-red-50 border border-red-200 rounded p-3">
      <p class="text-red-800 text-sm">{{ error }}</p>
    </div>

    <!-- Success Display -->
    <div v-if="success" class="mt-4 bg-green-50 border border-green-200 rounded p-3">
      <p class="text-green-800 text-sm">{{ success }}</p>
    </div>

    <!-- Sign in link -->
    <div class="mt-6 text-center">
      <p class="text-sm text-gray-600">
        Already have an account?
        <router-link to="/auth/login" class="text-indigo-600 hover:text-indigo-500 font-medium">
          Sign in here
        </router-link>
      </p>
    </div>
</template>

<script setup>
import {ref} from 'vue'
import {useRouter} from 'vue-router'

const router = useRouter()

// Reactive data
const isLoading = ref(false)
const error = ref('')
const success = ref('')

const form = ref({
  firstName: '',
  lastName: '',
  email: '',
  password: '',
  confirmPassword: '',
  role: '',
  terms: false
})


// Methods
const handleRegister = async () => {
  isLoading.value = true
  error.value = ''
  success.value = ''

  // Validation
  if (form.value.password !== form.value.confirmPassword) {
    error.value = 'Passwords do not match.'
    isLoading.value = false
    return
  }

  if (form.value.password.length < 8) {
    error.value = 'Password must be at least 8 characters long.'
    isLoading.value = false
    return
  }

  try {
    // This would typically call your Laravel API
    // const response = await apiService.register({
    //   first_name: form.value.firstName,
    //   last_name: form.value.lastName,
    //   email: form.value.email,
    //   password: form.value.password,
    //   role: form.value.role
    // })

    // For demo purposes, simulate registration
    await new Promise(resolve => setTimeout(resolve, 1500))

    success.value = 'Account created successfully! Redirecting to login...'

    // Redirect to login page
    setTimeout(() => {
      router.push('/auth/login')
    }, 2000)

  } catch (err) {
    error.value = err.message || 'Registration failed. Please try again.'
  } finally {
    isLoading.value = false
  }
}

const demoRegister = () => {
  form.value.firstName = 'John'
  form.value.lastName = 'Doe'
  form.value.email = 'john.doe@example.com'
  form.value.password = 'demo123456'
  form.value.confirmPassword = 'demo123456'
  form.value.role = 'user'
  form.value.terms = true
  handleRegister()
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
