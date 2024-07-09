// stores/theme.js
import { defineStore } from 'pinia'
import axios from '../axios'

export const useThemeStore = defineStore('theme', {
  state: () => ({
    themes: [],
    allThemes: []
  }),
  actions: {
    async fetchThemes(categoryId) {
      const response = await axios.get(`/categories/${categoryId}/themes`)
      this.themes = response.data
    },
    async fetchAllThemes() {
      const response = await axios.get('/themes')
      this.allThemes = response.data
    },
    addTheme(theme) {
      this.themes.push(theme)
    },
    updateTheme(updatedTheme) {
      const index = this.themes.findIndex((t) => t.id === updatedTheme.id)
      if (index !== -1) {
        this.themes.splice(index, 1, updatedTheme)
      }
    },
    removeTheme(id) {
      this.themes = this.themes.filter((t) => t.id !== id)
    }
  }
})
