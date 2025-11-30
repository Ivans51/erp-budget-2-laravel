<template>
  <footer
    class="bg-white border-t border-gray-200 mt-8 sm:mt-12 lg:mt-16 transition-all duration-300 ease-in-out motion-reduce:transition-none contrast-more:border-l-2 contrast-more:border-gray-900"
  >
    <div class="max-w-7xl mx-auto py-2 sm:py-2 lg:py-4 px-4 sm:px-6 lg:px-8">
      <div class="flex flex-col items-center justify-center text-center">
        <p class="text-sm sm:text-base font-semibold text-gray-800">
          ERP Budget &copy; {{ currentYear }}
        </p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { computed } from "vue";

const currentYear = computed(() => new Date().getFullYear());
</script>
