<script setup>
import { RouterView } from 'vue-router'
import AppFooter from './components/AppFooter.vue'
import AppNavBar from './components/AppNavBar.vue'
</script>

<template>
  <link rel="manifest" href="/manifest.json" />
  <div class="min-h-screen bg-gradient-to-br from-blue-400 to-green-400 text-white">
    <AppNavBar />
    <div class="">
      <RouterView />
      <AppFooter />
    </div>
  </div>
</template>

<style scoped>
/* Additional scoped styles */
</style>
