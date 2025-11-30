<template>
  <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
      <!-- Logo/Brand -->
      <div class="flex justify-center">
        <div class="flex items-center space-x-2">
          <Wallet class="w-16 h-16 text-white bg-indigo-500 p-2 rounded-2xl" />
        </div>
      </div>

      <!-- Auth Header -->
      <div class="mt-6 text-center">
        <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
          {{ title }}
        </h2>
        <p class="mt-2 text-center text-sm text-gray-600">
          {{ description }}
        </p>
      </div>
    </div>

    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
      <div class="bg-white py-4 px-4 shadow sm:rounded-lg sm:px-6">
        <router-view/>
      </div>

      <!-- Copyright -->
      <div class="mt-6 text-center">
        <p class="text-xs text-gray-500">
          © {{ currentYear }} ERP Budget. All rights reserved.
        </p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'
import { useRoute } from 'vue-router'
import { Wallet } from 'lucide-vue-next'

const route = useRoute()

// Get props from route meta or use defaults
const title = computed(() => {
  return route.meta?.authLayoutProps?.title || 'Authentication'
})

const description = computed(() => {
  return route.meta?.authLayoutProps?.description || 'Please sign in to continue'
})

// Get current year for copyright
const currentYear = computed(() => {
  return new Date().getFullYear()
})
</script>

<style scoped>
</style>
