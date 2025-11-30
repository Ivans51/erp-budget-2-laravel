<template>
  <div class="min-h-screen bg-gray-50 flex">
    <!-- Navigation Component -->
    <Navigation @menu-toggle="handleMenuToggle" />

    <div class="flex-1 lg:ml-64 flex flex-col min-h-screen">
      <!-- Main Content Wrapper -->
      <main
        class="flex-1 transition-all duration-300 ease-in-out pt-16 sm:pt-4 lg:pt-0 min-h-[calc(100vh-4rem)] lg:min-h-screen motion-reduce:transition-none contrast-more:border-l-2 contrast-more:border-gray-900"
        :class="{
          'scale-95 pointer-events-none lg:scale-100 lg:pointer-events-auto':
            isMobileMenuOpen,
        }"
      >
        <!-- Responsive Container for Router View -->
        <div class="w-full px-4 sm:px-6 lg:px-8 py-4 sm:py-6 lg:py-8">
          <div class="w-full">
            <!-- Router View - This is where Vue Router will render the current component -->
            <div
              class="transition-opacity duration-200 ease-in-out px-2 sm:px-4 lg:px-0 print:p-0"
            >
              <router-view v-slot="{ Component }">
                <transition
                  enter-active-class="transition-opacity duration-300 ease-out motion-reduce:transition-none"
                  enter-from-class="opacity-0"
                  leave-active-class="transition-opacity duration-300 ease-in motion-reduce:transition-none"
                  leave-to-class="opacity-0"
                  mode="out-in"
                >
                  <component :is="Component" class="w-full" />
                </transition>
              </router-view>
            </div>
          </div>
        </div>
      </main>

      <!-- Footer with Enhanced Responsive Design -->
      <Footer />
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import Navigation from "./Navigation.vue";
import Footer from "./Footer.vue";

const router = useRouter();

// Mobile menu state
const isMobileMenuOpen = ref(false);

// Check if current route is an auth route
const isAuthRoute = computed(() => {
  return router.currentRoute.value.path.startsWith("/auth");
});

// Handle menu toggle from navigation component
const handleMenuToggle = (isOpen) => {
  isMobileMenuOpen.value = isOpen;
};

// Initialize application
onMounted(() => {
  console.log("Vue Router + Laravel SPA initialized");

  // Set document title based on current route
  if (router.currentRoute.value.meta.title) {
    document.title = router.currentRoute.value.meta.title;
  }
});

// Watch for route changes to update document title and close mobile menu
router.afterEach((to) => {
  if (to.meta.title) {
    document.title = to.meta.title;
  }

  // Close mobile menu when route changes
  isMobileMenuOpen.value = false;
});
</script>
