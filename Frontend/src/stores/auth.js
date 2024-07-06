// stores/auth.js
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    isAuthenticated: false
  }),
  actions: {
    initialize() {
      this.isAuthenticated = localStorage.getItem('isAuthenticated') === 'true'
    },
    login() {
      this.isAuthenticated = true
      localStorage.setItem('isAuthenticated', 'true')
    },
    logout() {
      this.isAuthenticated = false
      localStorage.removeItem('isAuthenticated')
    }
  }
})
