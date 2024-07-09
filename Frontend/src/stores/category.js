import { defineStore } from 'pinia'
import axios from '../axios'

export const useCategoryStore = defineStore('category', {
  state: () => ({
    categories: []
  }),
  actions: {
    async fetchCategories() {
      const response = await axios.get('/user/categories')
      this.categories = response.data
    },
    addCategory(category) {
      this.categories.push(category)
    },
    updateCategory(updatedCategory) {
      const index = this.categories.findIndex((c) => c.id === updatedCategory.id)
      if (index !== -1) {
        this.categories.splice(index, 1, updatedCategory)
      }
    },
    removeCategory(id) {
      this.categories = this.categories.filter((c) => c.id !== id)
    }
  }
})
