<template>
  <!-- Mobile Menu Toggle Button -->
  <div class="lg:hidden fixed top-4 left-4 z-50">
    <button
      @click="toggleMobileMenu"
      class="p-3 text-gray-600 hover:text-gray-900 focus:outline-none transition-all duration-300 rounded-lg"
      :class="isMobileMenuOpen ? 'bg-transparent' : 'bg-white shadow-lg'"
    >
      <span class="sr-only">Open navigation menu</span>
      <Menu v-if="!isMobileMenuOpen" class="h-6 w-6" />
      <X v-else class="h-6 w-6" />
    </button>
  </div>

  <!-- Vertical Navigation Sidebar -->
  <nav
    class="fixed left-0 top-0 h-full w-64 bg-white border-r border-gray-200 z-40 transform transition-transform duration-300 ease-in-out flex flex-col"
    :class="{
      '-translate-x-full': !isMobileMenuOpen && isMobile,
      'translate-x-0': isMobileMenuOpen || !isMobile,
    }"
  >
    <!-- Logo/Brand -->
    <div class="px-6 py-8">
      <div class="flex items-center gap-3">
        <div class="bg-blue-600 text-white p-2 rounded-lg">
          <Wallet class="h-6 w-6" />
        </div>
        <div>
          <h1 class="text-lg font-bold text-gray-900 leading-tight">
            ERP Budget
          </h1>
          <p class="text-xs text-gray-500">Financial Management</p>
        </div>
      </div>
    </div>

    <!-- Navigation Links -->
    <div class="flex-1 px-4 overflow-y-auto custom-scrollbar">
      <div
        class="mb-2 px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider"
      >
        Menu
      </div>
      <div class="space-y-1">
        <router-link
          v-for="link in navLinks"
          :key="link.name"
          :to="link.path"
          @click="closeMobileMenu"
          class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 group"
          :class="
            isActive(link.name)
              ? 'bg-blue-50 text-blue-600'
              : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
          "
        >
          <span
            class="mr-3 transition-colors"
            :class="
              isActive(link.name)
                ? 'text-blue-600'
                : 'text-gray-400 group-hover:text-gray-500'
            "
          >
            <component :is="link.icon" class="h-5 w-5" />
          </span>
          {{ link.label }}
        </router-link>
      </div>
    </div>

    <!-- User Profile & Logout -->
    <div class="p-4 border-t border-gray-200">
      <div class="flex items-center gap-3 mb-4 px-2">
        <div
          class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-sm"
        >
          JS
        </div>
        <div class="flex-1 min-w-0">
          <p class="text-sm font-medium text-gray-900 truncate">John Smith</p>
          <p class="text-xs text-gray-500 truncate">Financial Manager</p>
        </div>
        <button class="text-gray-400 hover:text-gray-600">
          <ChevronRight class="h-5 w-5" />
        </button>
      </div>

      <button
        @click="logout"
        class="w-full flex items-center justify-center px-4 py-2 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors"
      >
        <LogOut class="h-4 w-4 mr-2" />
        Logout
      </button>
    </div>
  </nav>

  <!-- Mobile Menu Overlay -->
  <transition name="fade">
    <div
      v-if="isMobileMenuOpen && isMobile"
      class="lg:hidden fixed inset-0 bg-gray-900/20 backdrop-blur-sm z-30"
      @click="closeMobileMenu"
    ></div>
  </transition>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { useRoute, useRouter } from "vue-router";
import {
  LayoutDashboard,
  Wallet,
  Receipt,
  FileText,
  Building2,
  Users,
  LogOut,
  Menu,
  X,
  ChevronRight,
} from "lucide-vue-next";

const emit = defineEmits(["menu-toggle"]);

const route = useRoute();
const router = useRouter();

// Reactive data
const isMobileMenuOpen = ref(false);
const isMobile = ref(false);

// Navigation links
const navLinks = [
  {
    name: "Dashboard",
    label: "Dashboard",
    path: "/dashboard",
    icon: LayoutDashboard,
  },
  {
    name: "BudgetManagement",
    label: "Budget Management",
    path: "/budget",
    icon: Wallet,
  },
  {
    name: "ExpenseTracking",
    label: "Expense Tracking",
    path: "/expenses",
    icon: Receipt,
  },
  {
    name: "FinancialReports",
    label: "Financial Reports",
    path: "/reports",
    icon: FileText,
  },
  {
    name: "Departments",
    label: "Departments",
    path: "/departments",
    icon: Building2,
  },
  {
    name: "UserManagement",
    label: "User Management",
    path: "/users",
    icon: Users,
  },
];

// Methods
const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  emit("menu-toggle", isMobileMenuOpen.value);
};

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false;
  emit("menu-toggle", isMobileMenuOpen.value);
};

const isActive = (linkName) => {
  return (
    route.name === linkName ||
    (linkName === "Dashboard" && route.path === "/dashboard")
  );
};

const logout = () => {
  localStorage.removeItem("auth_token");
  router.push({ name: "Login" });
  closeMobileMenu();
};

const checkMobile = () => {
  isMobile.value = window.innerWidth < 1024;
};

onMounted(() => {
  checkMobile();
  window.addEventListener("resize", checkMobile);
});

onUnmounted(() => {
  window.removeEventListener("resize", checkMobile);
});
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}

.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #e2e8f0;
  border-radius: 2px;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #cbd5e1;
}

/* Fade transition for overlay */
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
  opacity: 0;
}
</style>
