<template>
  <div class="settings-page">
    <h1 class="text-3xl font-bold mb-6">Réglages de Révision</h1>
    <Loader v-if="loading" />
    <div v-else>
      <div v-for="theme in themes" :key="theme.id" class="theme-settings mb-4">
        <h2 class="text-2xl font-semibold">{{ theme.name }}</h2>
        <label class="block mb-2">Niveaux de révision:</label>
        <input
          v-model.number="theme.levels"
          type="number"
          class="border rounded w-full p-2 mb-2"
          min="1"
        />
        <label class="block mb-2">Nouvelles cartes par jour:</label>
        <input
          v-model.number="theme.newCardsPerDay"
          type="number"
          class="border rounded w-full p-2 mb-2"
          min="1"
        />
        <button
          @click="saveSettings(theme)"
          class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
        >
          Enregistrer
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Loader from '../components/AppLoader.vue'
import { useThemeStore } from '../stores/theme'

export default {
  components: {
    Loader
  },
  data() {
    return {
      loading: true
    }
  },
  computed: {
    themes() {
      return useThemeStore().themes
    }
  },
  created() {
    this.fetchThemes()
  },
  methods: {
    async fetchThemes() {
      try {
        await useThemeStore().fetchThemes()
      } catch (error) {
        console.error('Erreur lors de la récupération des thèmes:', error)
      } finally {
        this.loading = false
      }
    },
    async saveSettings(theme) {
      try {
        await axios.post(`/api/themes/${theme.id}/settings`, {
          levels: theme.levels,
          newCardsPerDay: theme.newCardsPerDay
        })
        alert('Réglages enregistrés')
      } catch (error) {
        console.error("Erreur lors de l'enregistrement des réglages:", error)
      }
    }
  }
}
</script>

<style scoped>
.settings-page {
  padding: 2rem;
}
.theme-settings {
  background: #fff;
  padding: 1rem;
  border-radius: 0.5rem;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
</style>
