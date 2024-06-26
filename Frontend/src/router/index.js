import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CategoryView from '../views/CategoryView.vue'
import ThemeView from '../views/ThemeView.vue'
import ProfilView from '../views/ProfilView.vue'
import AppRegister from '../components/AppRegister.vue'
import AppLogin from '../components/AppLogin.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/category',
      name: 'category',
      component: CategoryView
    },
    {
      path: '/themes/:id',
      name: 'Theme',
      component: ThemeView
    },
    {
      path: '/profil',
      name: 'Profil',
      component: ProfilView
    },
    {
      path: '/register',
      name: 'Register',
      component: AppRegister
    },
    {
      path: '/login',
      name: 'Login',
      component: AppLogin
    }
  ]
})

export default router
