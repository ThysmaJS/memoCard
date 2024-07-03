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
        <button
          @click="activeTab = 'cards'"
          :class="{
            'bg-blue-500 text-white': activeTab === 'cards',
            'bg-gray-200 text-black': activeTab !== 'cards'
          }"
          class="px-4 py-2 rounded focus:outline-none"
        >
          Cartes
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

      <!-- Cartes -->
      <div v-if="activeTab === 'cards'" class="bg-white bg-opacity-10 rounded-lg p-4 shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Cartes</h2>
        <select
          v-model="selectedThemeId"
          @change="fetchCards"
          class="border rounded w-full p-2 mb-4 text-black"
        >
          <option value="" disabled>Choisir un thème</option>
          <option v-for="theme in allThemes" :key="theme.id" :value="theme.id">
            {{ theme.name }}
          </option>
        </select>
        <ul class="list-disc list-inside mb-4" v-if="selectedThemeId">
          <li v-for="card in cards" :key="card.id">
            {{ card.front }} / {{ card.back }}
            <div class="flex space-x-2 mt-2">
              <button @click="editCard(card)" class="bg-yellow-500 text-white px-2 py-1 rounded">
                Modifier
              </button>
              <button @click="deleteCard(card.id)" class="bg-red-500 text-white px-2 py-1 rounded">
                Supprimer
              </button>
            </div>
          </li>
        </ul>
        <button
          @click="showCardForm = true"
          v-if="!showEditCardForm"
          class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded mb-4"
        >
          Créer des cartes
        </button>
        <div v-if="showCardForm && !showEditCardForm" class="mt-4 text-black">
          <div v-for="(card, index) in newCards" :key="index" class="mb-4">
            <input
              v-model="card.front"
              placeholder="Recto de la carte"
              class="border rounded w-full p-2 mb-2"
            />
            <input
              v-model="card.back"
              placeholder="Verso de la carte"
              class="border rounded w-full p-2 mb-2"
            />
          </div>
          <div class="flex space-x-2">
            <button
              @click="addCardFields"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Ajouter une autre carte
            </button>
            <button
              @click="saveCards"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Ajouter
            </button>
            <button
              @click="cancelCardAction"
              class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded"
            >
              Annuler
            </button>
          </div>
        </div>
        <div v-if="showEditCardForm && !showCardForm" class="mt-4 text-black">
          <input
            v-model="currentCard.front"
            placeholder="Recto de la carte"
            class="border rounded w-full p-2 mb-2"
          />
          <input
            v-model="currentCard.back"
            placeholder="Verso de la carte"
            class="border rounded w-full p-2 mb-2"
          />
          <div class="flex space-x-2">
            <button
              @click="updateCard"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Mettre à jour
            </button>
            <button
              @click="cancelCardAction"
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
      allThemes: [], // Initialize empty allThemes
      cards: [], // Initialize empty cards
      selectedCategoryId: null, // Track selected category for themes
      selectedThemeId: null, // Track selected theme for cards
      showCategoryForm: false,
      showThemeForm: false,
      showCardForm: false,
      showEditCategoryForm: false,
      showEditThemeForm: false,
      showEditCardForm: false,
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
      },
      currentCard: {
        id: null,
        front: '',
        back: '',
        theme_id: null
      },
      newCards: [{ front: '', back: '' }] // Default 1 new card
    }
  },
  created() {
    this.fetchUserProfile()
    this.fetchCategories() // Fetch categories when component is created
    this.fetchAllThemes() // Fetch all themes for cards tab
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
    async fetchAllThemes() {
      try {
        const response = await axios.get('/themes')
        this.allThemes = response.data
      } catch (error) {
        console.error('Erreur lors de la récupération de tous les thèmes:', error)
      }
    },
    async fetchCards() {
      if (this.selectedThemeId) {
        try {
          const response = await axios.get(`/themes/${this.selectedThemeId}/cards`)
          this.cards = response.data
        } catch (error) {
          console.error('Erreur lors de la récupération des cartes:', error)
        }
      } else {
        this.cards = []
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
    },
    async saveCards() {
      if (this.newCards.length < 1) {
        alert('Veuillez ajouter au moins 1 carte.')
        return
      }

      const cardsToSave = this.newCards.map((card) => ({
        ...card,
        theme_id: this.selectedThemeId
      }))

      try {
        const response = await axios.post('/cards/batch', { cards: cardsToSave })
        this.cards.push(...response.data)
        this.newCards = [{ front: '', back: '' }] // Reset new cards
        this.showCardForm = false
      } catch (error) {
        console.error('Erreur lors de la création des cartes:', error)
      }
    },
    async editCard(card) {
      this.currentCard = { ...card }
      this.showEditCardForm = true
      this.showCardForm = false
    },
    async updateCard() {
      try {
        const response = await axios.put(`/cards/${this.currentCard.id}`, {
          front: this.currentCard.front,
          back: this.currentCard.back
        })
        const index = this.cards.findIndex((card) => card.id === this.currentCard.id)
        this.cards.splice(index, 1, response.data)
        this.currentCard = { id: null, front: '', back: '', theme_id: null }
        this.showEditCardForm = false
      } catch (error) {
        console.error('Erreur lors de la mise à jour de la carte:', error)
      }
    },
    async deleteCard(id) {
      try {
        await axios.delete(`/cards/${id}`)
        this.cards = this.cards.filter((card) => card.id !== id)
      } catch (error) {
        console.error('Erreur lors de la suppression de la carte:', error)
      }
    },
    cancelCardAction() {
      this.currentCard = { id: null, front: '', back: '', theme_id: null }
      this.newCards = [{ front: '', back: '' }] // Reset new cards
      this.showCardForm = false
      this.showEditCardForm = false
    },
    addCardFields() {
      this.newCards.push({ front: '', back: '' })
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
