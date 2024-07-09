import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import CategoryView from '../views/CategoryView.vue'
import ThemeView from '../views/ThemeView.vue'
import ProfilView from '../views/ProfilView.vue'
import AppRegister from '../components/AppRegister.vue'
import AppLogin from '../components/AppLogin.vue'
import CardsView from '../views/CardsView.vue'
import SettingsView from '../views/SettingsView.vue'
import DailyReview from '../views/DailyReviewView.vue' // Assurez-vous que le composant existe

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
    },
    {
      path: '/themes/:themeId/cards',
      name: 'CardsView',
      component: CardsView
    },
    {
      path: '/settings',
      name: 'Settings',
      component: SettingsView
    },
    {
      path: '/themes/:themeId/review',
      name: 'DailyReview',
      component: DailyReview
    }
  ]
})

export default router
