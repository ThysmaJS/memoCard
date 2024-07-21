<template>
  <div class="theme-page">
    <div class="relative mb-6">
      <button @click="goBack" class="mb-2 flex items-center text-blue-500 hover:text-blue-700">
        <svg
          class="w-6 h-6 mr-2"
          fill="none"
          stroke="currentColor"
          viewBox="0 0 24 24"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M15 19l-7-7 7-7"
          ></path>
        </svg>
        Retour
      </button>
      <h1 class="text-3xl font-bold mt-2 ml-16">Thèmes pour la catégorie: {{ categoryName }}</h1>
    </div>
    <Loader v-if="loading" />
    <div v-else>
      <div v-if="themes.length === 0" class="text-center text-lg text-gray-500">
        Aucun thème actif pour le moment
      </div>
      <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(theme, index) in themes"
          :key="theme.id"
          :style="{ backgroundColor: colors[index % colors.length] }"
          class="block rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300"
        >
          <h2 class="text-4xl font-bold mb-4">{{ theme.name }}</h2>
          <p class="text-lg mb-2">Créé par: {{ theme.user.name }}</p>
          <p class="text-lg mb-6">{{ theme.description }}</p>
          <div class="flex flex-col space-y-2">
            <router-link
              :to="{ name: 'CardsView', params: { themeId: theme.id } }"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Voir les cartes
            </router-link>
            <router-link
              :to="{ name: 'DailyReview', params: { themeId: theme.id } }"
              class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
            >
              Commencer la Révision
            </router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
import Loader from '../components/AppLoader.vue'

export default {
  components: {
    Loader
  },
  data() {
    return {
      categoryName: '',
      themes: [],
      colors: ['#FFCDD2', '#E1BEE7', '#BBDEFB', '#C8E6C9', '#FFECB3', '#D1C4E9'],
      loading: true
    }
  },
  created() {
    const categoryId = this.$route.params.id
    this.fetchThemes(categoryId)
  },
  methods: {
    async fetchThemes(categoryId) {
      try {
        const response = await axios.get(`/api/categories/${categoryId}/all-themes`)
        this.themes = response.data.filter((theme) => theme.public) // Filtrer pour ne garder que les thèmes publics
        if (this.themes.length > 0) {
          this.categoryName = this.themes[0].category.name
        } else {
          this.categoryName = 'Cette catégorie'
        }
      } catch (error) {
        console.error('Erreur lors de la récupération des thèmes:', error)
      } finally {
        this.loading = false
      }
    },
    goBack() {
      this.$router.go(-1)
    }
  }
}
</script>

<style scoped>
.theme-page {
  padding: 2rem;
}
button.absolute {
  position: absolute;
}
</style>
