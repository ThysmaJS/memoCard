<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const authStore = useAuthStore()
const isOpen = ref(false)

const toggleMenu = () => {
  isOpen.value = !isOpen.value
}

const logout = () => {
  authStore.logout()
  // Vous pouvez également appeler une API pour déconnecter l'utilisateur côté serveur
}
</script>

<template>
  <header class="bg-opacity-10 p-4 flex justify-between items-center bg-white shadow-lg rounded-lg">
    <div class="text-xl font-bold text-white">Memo Card</div>
    <button v-if="!isOpen" @click="toggleMenu" class="lg:hidden fixed top-4 right-4 z-50">
      <svg
        class="w-6 h-6 text-white"
        fill="none"
        stroke="currentColor"
        viewBox="0 0 24 24"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          stroke-width="2"
          d="M4 6h16M4 12h16m-7 6h7"
        ></path>
      </svg>
    </button>
    <nav class="hidden lg:flex space-x-4 text-white">
      <RouterLink to="/" class="hover:text-gray-200 transition duration-300">Accueil</RouterLink>
      <RouterLink
        v-if="!authStore.isAuthenticated"
        to="/Register"
        class="hover:text-gray-200 transition duration-300"
        >Inscription</RouterLink
      >
      <RouterLink
        v-if="authStore.isAuthenticated"
        to="/profil"
        class="hover:text-gray-200 transition duration-300"
        >Profil</RouterLink
      >
      <RouterLink
        v-if="authStore.isAuthenticated"
        to="/Settings"
        class="hover:text-gray-200 transition duration-300"
        >Paramètres</RouterLink
      >
      <RouterLink
        v-if="authStore.isAuthenticated"
        to="/mes-revisions"
        class="hover:text-gray-200 transition duration-300"
        >Mes Révisions</RouterLink
      >
      <RouterLink
        v-if="!authStore.isAuthenticated"
        to="/Login"
        class="hover:text-gray-200 transition duration-300"
        >Connexion</RouterLink
      >
      <button
        v-if="authStore.isAuthenticated"
        @click="logout"
        class="hover:text-gray-200 transition duration-300"
      >
        Déconnexion
      </button>
    </nav>
    <transition name="slide-fade">
      <div
        v-if="isOpen"
        class="lg:hidden fixed top-0 right-0 w-32 bg-white bg-opacity-10 p-4 z-40 shadow-lg rounded-lg"
        style="backdrop-filter: blur(10px)"
      >
        <button @click="toggleMenu" class="fixed top-4 right-4 z-50">
          <svg
            class="w-6 h-6 text-white"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </button>
        <nav>
          <RouterLink
            to="/"
            class="block py-2 hover:text-gray-200 transition duration-300"
            @click="toggleMenu"
            >Accueil</RouterLink
          >
          <RouterLink
            v-if="!authStore.isAuthenticated"
            to="/Register"
            class="block py-2 hover:text-gray-200 transition duration-300"
            @click="toggleMenu"
            >Inscription</RouterLink
          >
          <RouterLink
            v-if="authStore.isAuthenticated"
            to="/profil"
            class="block py-2 hover:text-gray-200 transition duration-300"
            @click="toggleMenu"
            >Profil</RouterLink
          >
          <RouterLink
            v-if="authStore.isAuthenticated"
            to="/Settings"
            class="block py-2 hover:text-gray-200 transition duration-300"
            @click="toggleMenu"
            >Paramètres</RouterLink
          >
          <RouterLink
            v-if="authStore.isAuthenticated"
            to="/mes-revisions"
            class="block py-2 hover:text-gray-200 transition duration-300"
            @click="toggleMenu"
            >Mes Révisions</RouterLink
          >
          <RouterLink
            v-if="!authStore.isAuthenticated"
            to="/Login"
            class="block py-2 hover:text-gray-200 transition duration-300"
            @click="toggleMenu"
            >Connexion</RouterLink
          >
          <button
            v-if="authStore.isAuthenticated"
            @click="
              () => {
                toggleMenu()
                logout()
              }
            "
            class="block py-2 hover:text-gray-200 transition duration-300"
          >
            Déconnexion
          </button>
        </nav>
      </div>
    </transition>
  </header>
</template>

<style scoped>
.slide-fade-enter-active,
.slide-fade-leave-active {
  transition:
    transform 0.3s ease,
    opacity 0.3s ease;
}
.slide-fade-enter-from,
.slide-fade-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
.slide-fade-enter-to,
.slide-fade-leave-from {
  transform: translateX(0);
  opacity: 1;
}
</style>
