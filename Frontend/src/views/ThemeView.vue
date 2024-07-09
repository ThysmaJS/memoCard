<template>
  <div class="theme-page">
    <h1 class="text-3xl font-bold mb-6">Thèmes pour la catégorie: {{ categoryName }}</h1>
    <Loader v-if="loading" />
    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <router-link
        v-for="(theme, index) in themes"
        :key="theme.id"
        :to="{ name: 'CardsView', params: { themeId: theme.id } }"
        :style="{ backgroundColor: colors[index % colors.length] }"
        class="block rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300"
      >
        <h2 class="text-4xl font-bold mb-4">{{ theme.name }}</h2>
        <p class="text-lg mb-2">Créé par: {{ theme.user.name }}</p>
        <p class="text-lg mb-6">{{ theme.description }}</p>
      </router-link>
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
        this.themes = response.data
        // Suppose que categoryName est une propriété des thèmes. Sinon, vous aurez besoin d'une requête séparée.
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
    }
  }
}
</script>

<style scoped>
.theme-page {
  padding: 2rem;
}
</style>
