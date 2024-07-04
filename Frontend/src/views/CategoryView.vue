<template>
  <div class="categories-page">
    <h1 class="text-3xl font-bold mb-6">Catégories</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <router-link
        v-for="(category, index) in categories"
        :key="category.id"
        :to="'/themes/' + category.id"
        :style="{ backgroundColor: colors[index % colors.length] }"
        class="block rounded-lg shadow-md p-6 hover:shadow-lg transition-transform duration-300 transform hover:-translate-y-1 hover:scale-105"
      >
        <h2 class="text-4xl font-bold mb-4">{{ category.name }}</h2>
        <p>{{ category.description }}</p>
      </router-link>
    </div>
  </div>
</template>

<script>
import axios from 'axios'

export default {
  data() {
    return {
      categories: [],
      colors: ['#FFCDD2', '#E1BEE7', '#BBDEFB', '#C8E6C9', '#FFECB3', '#D1C4E9']
    }
  },
  created() {
    this.fetchAllCategories()
  },
  methods: {
    async fetchAllCategories() {
      try {
        const response = await axios.get('/api/categories/all')
        this.categories = response.data
      } catch (error) {
        console.error('Erreur lors de la récupération des catégories:', error)
      }
    }
  }
}
</script>

<style scoped>
.categories-page {
  padding: 2rem;
}
</style>
