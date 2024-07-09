// src/stores/card.js
import { defineStore } from 'pinia'
import axios from '../axios'

export const useCardStore = defineStore('card', {
  state: () => ({
    cards: []
  }),
  actions: {
    async fetchCards(themeId) {
      const response = await axios.get(`/themes/${themeId}/cards`)
      this.cards = response.data
    },
    addCards(cards) {
      this.cards.push(...cards)
    },
    updateCard(updatedCard) {
      const index = this.cards.findIndex((c) => c.id === updatedCard.id)
      if (index !== -1) {
        this.cards.splice(index, 1, updatedCard)
      }
    },
    removeCard(id) {
      this.cards = this.cards.filter((c) => c.id !== id)
    }
  }
})
