<template>
  <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center p-4">
    <div class="max-w-6xl mx-auto flex items-center justify-between">
      <!-- Left Side - Text Content -->
      <div class="flex-1 pr-12">
        <h1 class="text-6xl font-bold text-gray-800 mb-4">
          Oops....
        </h1>
        <h2 class="text-4xl font-semibold text-gray-700 mb-6">
          Page not found
        </h2>
        <p class="text-xl text-gray-600 mb-8">
          This Page doesn't exist or was removed!
        </p>
        <p class="text-lg text-gray-500 mb-8">
          We suggest you back to home.
        </p>
        <button
          @click="goHome"
          class="btn-primary flex items-center gap-2"
        >
          <ArrowLeft class="w-5 h-5" />
          Back to home
        </button>
      </div>

      <!-- Right Side - Image -->
      <div class="flex-1 flex justify-center">
        <div class="text-center">
          <img
            :src="notFoundImage"
            alt="Page Not Found"
            class="max-w-lg h-auto opacity-90"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'
import { ArrowLeft } from 'lucide-vue-next'
import notFoundImage from '/resources/img/not found.png'

const router = useRouter()

const goHome = () => {
  router.push('/')
}
</script>

<style scoped>
/* Responsive design */
@media (max-width: 768px) {
  .max-w-6xl {
    flex-direction: column;
    text-align: center;
  }

  .flex-1.pr-12 {
    padding-right: 0;
    margin-bottom: 3rem;
  }
}
</style>
