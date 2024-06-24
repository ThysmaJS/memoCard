<template>
  <footer
    class="p-6 flex flex-col items-center text-white rounded-lg shadow-lg border border-gray-300"
  >
    <div class="mb-4 sm:mb-0 text-center sm:text-left mt-2">
      <nav class="flex space-x-4">
        <RouterLink to="/" class="hover:text-gray-200 transition duration-300">Accueil</RouterLink>
        <RouterLink to="/signup" class="hover:text-gray-200 transition duration-300"
          >Inscription</RouterLink
        >
        <RouterLink to="/profile" class="hover:text-gray-200 transition duration-300"
          >Profil</RouterLink
        >
      </nav>
    </div>
    <div
      class="w-full max-w-4xl mt-6 border-t border-gray-200 pt-4 text-center text-sm text-gray-200"
    >
      &copy; 2024 Project Memory. Tous droits réservés.
    </div>
  </footer>
</template>

<script setup>
import { RouterLink } from 'vue-router'
</script>

<style scoped>
/* Scoped styles if needed */
</style>
