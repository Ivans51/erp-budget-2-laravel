import { createRouter, createWebHistory } from 'vue-router'

import BaseLayout from '../components/layout/BaseLayout.vue'
import AuthLayout from '../components/layout/AuthLayout.vue'
import Dashboard from '../components/pages/Dashboard.vue'
import Login from '../components/pages/Login.vue'
import Register from '../components/pages/Register.vue'
import NotFound from '../components/pages/NotFound.vue'

// Define routes
const routes = [
  // Redirect root to login
  {
    path: '/',
    redirect: '/auth/login'
  },

  // Auth layout with children
  {
    path: '/auth',
    component: AuthLayout,
    children: [
      {
        path: 'login',
        name: 'Login',
        component: Login,
        meta: {
          title: 'Login - ERP Budget',
          authLayoutProps: {
            title: 'ERP Budget',
            description: 'Financial Management System'
          }
        }
      },
      {
        path: 'register',
        name: 'Register',
        component: Register,
        meta: {
          title: 'Register - ERP Budget',
          authLayoutProps: {
            title: 'Create your account',
            description: 'Join ERP Budget to manage your finances'
          }
        }
      }
    ]
  },

  {
    path: '/dashboard',
    component: BaseLayout,
    children: [
      {
        path: '',
        name: 'Dashboard',
        component: Dashboard,
        meta: {
          title: 'Dashboard - Vue Router + Laravel',
          requiresAuth: true
        }
      }
    ]
  },
  // Catch-all route for SPA
  {
    path: '/:pathMatch(.*)*',
    name: 'NotFound',
    component: NotFound,
    meta: {
      title: 'Page Not Found - Vue Router + Laravel'
    }
  }
]

// Create router instance
const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    if (savedPosition) {
      return savedPosition
    } else {
      return { top: 0 }
    }
  }
})

// Route guards
router.beforeEach((to, from, next) => {
  // Set document title
  if (to.meta.title) {
    document.title = to.meta.title
  }

  // Check for authentication (example)
  const isAuthenticated = localStorage.getItem('auth_token')

  if (to.matched.some(record => record.meta.requiresAuth)) {
    if (!isAuthenticated) {
      next({
        name: 'Login',
        query: { redirect: to.fullPath }
      })
    } else {
      next()
    }
  } else {
    next()
  }
})

export default router
