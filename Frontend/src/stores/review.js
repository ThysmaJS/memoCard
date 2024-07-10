// stores/review.js
import { defineStore } from 'pinia'
import axios from '../axios'

export const useReviewStore = defineStore('review', {
  state: () => ({
    reviews: [],
    allReviews: []
  }),
  actions: {
    async fetchUserReviews() {
      try {
        const response = await axios.get('/user/reviews', {
          withCredentials: true
        })
        this.reviews = response.data
      } catch (error) {
        console.error('Erreur lors de la récupération des révisions:', error)
      }
    },
    addReview(review) {
      this.reviews.push(review)
    },
    updateReview(updatedReview) {
      const index = this.reviews.findIndex((r) => r.id === updatedReview.id)
      if (index !== -1) {
        this.reviews.splice(index, 1, updatedReview)
      }
    },
    removeReview(id) {
      this.reviews = this.reviews.filter((r) => r.id !== id)
    }
  }
})
