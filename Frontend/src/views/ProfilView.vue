<template>
  <main
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-400 to-green-400 text-white"
  >
    <section
      class="w-full max-w-lg p-10 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md sm:max-w-2xl"
    >
      <h1 class="text-4xl font-bold mb-6 text-white sm:text-5xl text-center">
        Profil de l'utilisateur
      </h1>
      <div class="bg-white bg-opacity-10 rounded-lg p-4 mb-6 shadow-lg">
        <p><strong>Nom:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
      </div>

      <!-- Onglets -->
      <div class="flex space-x-4 mb-6 justify-center">
        <button
          @click="activeTab = 'categories'"
          :class="{
            'bg-blue-500 text-white': activeTab === 'categories',
            'bg-gray-200 text-black': activeTab !== 'categories'
          }"
          class="px-4 py-2 rounded focus:outline-none"
        >
          Catégories
        </button>
        <button
          @click="activeTab = 'themes'"
          :class="{
            'bg-blue-500 text-white': activeTab === 'themes',
            'bg-gray-200 text-black': activeTab !== 'themes'
          }"
          class="px-4 py-2 rounded focus:outline-none"
        >
          Thèmes
        </button>
      </div>

      <!-- Catégories -->
      <div
        v-if="activeTab === 'categories'"
        class="bg-white bg-opacity-10 rounded-lg p-4 shadow-lg"
      >
        <h2 class="text-xl font-semibold mb-4">Catégories</h2>
        <ul class="list-disc list-inside mb-4">
          <li v-for="category in categories" :key="category.id">
            {{ category.name }}
            <div class="flex space-x-2 mt-2">
              <button
                @click="editCategory(category)"
                class="bg-yellow-500 text-white px-2 py-1 rounded"
              >
                Modifier
              </button>
              <button
                @click="deleteCategory(category.id)"
                class="bg-red-500 text-white px-2 py-1 rounded"
              >
                Supprimer
              </button>
            </div>
          </li>
        </ul>
        <button
          @click="showCategoryForm = true"
          class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4"
        >
          Créer une catégorie
        </button>
        <div v-if="showCategoryForm || showEditCategoryForm" class="mt-4 text-black">
          <input
            v-model="currentCategory.name"
            placeholder="Nom de la catégorie"
            class="border rounded w-full p-2 mb-2"
          />
          <textarea
            v-model="currentCategory.description"
            placeholder="Description de la catégorie"
            class="border rounded w-full p-2 mb-2"
          ></textarea>
          <div class="flex space-x-2">
            <button
              @click="saveCategory"
              v-if="!showEditCategoryForm"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Ajouter
            </button>
            <button
              @click="updateCategory"
              v-if="showEditCategoryForm"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Mettre à jour
            </button>
            <button
              @click="cancelCategoryAction"
              class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
            >
              Annuler
            </button>
          </div>
        </div>
      </div>

      <!-- Thèmes -->
      <div v-if="activeTab === 'themes'" class="bg-white bg-opacity-10 rounded-lg p-4 shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Thèmes</h2>
        <select
          v-model="selectedCategoryId"
          @change="fetchThemes"
          class="border rounded w-full p-2 mb-4 text-black"
        >
          <option value="" disabled>Choisir une catégorie</option>
          <option v-for="category in categories" :key="category.id" :value="category.id">
            {{ category.name }}
          </option>
        </select>
        <ul class="list-disc list-inside mb-4" v-if="selectedCategoryId">
          <li v-for="theme in themes" :key="theme.id">
            {{ theme.name }}
            <div class="flex space-x-2 mt-2">
              <button @click="editTheme(theme)" class="bg-yellow-500 text-white px-2 py-1 rounded">
                Modifier
              </button>
              <button
                @click="deleteTheme(theme.id)"
                class="bg-red-500 text-white px-2 py-1 rounded"
              >
                Supprimer
              </button>
            </div>
          </li>
        </ul>
        <button
          @click="showThemeForm = true"
          class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4"
        >
          Créer un thème
        </button>
        <div v-if="showThemeForm || showEditThemeForm" class="mt-4 text-black">
          <input
            v-model="currentTheme.name"
            placeholder="Nom du thème"
            class="border rounded w-full p-2 mb-2"
          />
          <textarea
            v-model="currentTheme.description"
            placeholder="Description du thème"
            class="border rounded w-full p-2 mb-2"
          ></textarea>
          <select v-model="currentTheme.category_id" class="border rounded w-full p-2 mb-2">
            <option value="" disabled>Choisir une catégorie</option>
            <option v-for="category in categories" :key="category.id" :value="category.id">
              {{ category.name }}
            </option>
          </select>
          <div class="flex space-x-2">
            <button
              @click="saveTheme"
              v-if="!showEditThemeForm"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Ajouter
            </button>
            <button
              @click="updateTheme"
              v-if="showEditThemeForm"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Mettre à jour
            </button>
            <button
              @click="cancelThemeAction"
              class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
            >
              Annuler
            </button>
          </div>
        </div>
      </div>
    </section>
  </main>
</template>

<script>
import axios from '../axios'

export default {
  data() {
    return {
      user: {},
      activeTab: 'categories', // Default active tab
      categories: [], // Initialize empty categories
      themes: [], // Initialize empty themes
      selectedCategoryId: null, // Track selected category for themes
      showCategoryForm: false,
      showThemeForm: false,
      showEditCategoryForm: false,
      showEditThemeForm: false,
      currentCategory: {
        id: null,
        name: '',
        description: ''
      },
      currentTheme: {
        id: null,
        name: '',
        description: '',
        category_id: null
      }
    }
  },
  created() {
    this.fetchUserProfile()
    this.fetchCategories() // Fetch categories when component is created
  },
  methods: {
    async fetchUserProfile() {
      try {
        const response = await axios.get('/user')
        this.user = response.data
      } catch (error) {
        console.error('Erreur lors de la récupération du profil utilisateur:', error)
      }
    },
    async fetchCategories() {
      try {
        const response = await axios.get('/categories')
        this.categories = response.data
      } catch (error) {
        console.error('Erreur lors de la récupération des catégories:', error)
      }
    },
    async fetchThemes() {
      if (this.selectedCategoryId) {
        try {
          const response = await axios.get(`/categories/${this.selectedCategoryId}/themes`)
          this.themes = response.data
        } catch (error) {
          console.error('Erreur lors de la récupération des thèmes:', error)
        }
      } else {
        this.themes = []
      }
    },
    async saveCategory() {
      try {
        const response = await axios.post('/categories', this.currentCategory)
        this.categories.push(response.data)
        this.currentCategory = { id: null, name: '', description: '' }
        this.showCategoryForm = false
      } catch (error) {
        console.error('Erreur lors de la création de la catégorie:', error)
      }
    },
    async editCategory(category) {
      this.currentCategory = { ...category }
      this.showEditCategoryForm = true
      this.showCategoryForm = false
    },
    async updateCategory() {
      try {
        const response = await axios.put(
          `/categories/${this.currentCategory.id}`,
          this.currentCategory
        )
        const index = this.categories.findIndex(
          (category) => category.id === this.currentCategory.id
        )
        this.categories.splice(index, 1, response.data)
        this.currentCategory = { id: null, name: '', description: '' }
        this.showEditCategoryForm = false
      } catch (error) {
        console.error('Erreur lors de la mise à jour de la catégorie:', error)
      }
    },
    async deleteCategory(id) {
      try {
        await axios.delete(`/categories/${id}`)
        this.categories = this.categories.filter((category) => category.id !== id)
      } catch (error) {
        console.error('Erreur lors de la suppression de la catégorie:', error)
      }
    },
    cancelCategoryAction() {
      this.currentCategory = { id: null, name: '', description: '' }
      this.showCategoryForm = false
      this.showEditCategoryForm = false
    },
    async saveTheme() {
      try {
        const response = await axios.post('/themes', this.currentTheme)
        this.themes.push(response.data)
        this.currentTheme = { id: null, name: '', description: '', category_id: null }
        this.showThemeForm = false
      } catch (error) {
        console.error('Erreur lors de la création du thème:', error)
      }
    },
    async editTheme(theme) {
      this.currentTheme = { ...theme }
      this.showEditThemeForm = true
      this.showThemeForm = false
    },
    async updateTheme() {
      try {
        const response = await axios.put(`/themes/${this.currentTheme.id}`, this.currentTheme)
        const index = this.themes.findIndex((theme) => theme.id === this.currentTheme.id)
        this.themes.splice(index, 1, response.data)
        this.currentTheme = { id: null, name: '', description: '', category_id: null }
        this.showEditThemeForm = false
      } catch (error) {
        console.error('Erreur lors de la mise à jour du thème:', error)
      }
    },
    async deleteTheme(id) {
      try {
        await axios.delete(`/themes/${id}`)
        this.themes = this.themes.filter((theme) => theme.id !== id)
      } catch (error) {
        console.error('Erreur lors de la suppression du thème:', error)
      }
    },
    cancelThemeAction() {
      this.currentTheme = { id: null, name: '', description: '', category_id: null }
      this.showThemeForm = false
      this.showEditThemeForm = false
    }
  }
}
</script>

<style scoped>
/* Additional scoped styles */
button {
  transition: transform 0.3s ease-in-out;
}
</style>
