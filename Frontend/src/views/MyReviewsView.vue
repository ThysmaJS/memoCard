<template>
  <div class="revisions-page">
    <h1 class="text-3xl font-bold mb-6">Mes Révisions</h1>
    <Loader v-if="loading" />
    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
        v-for="(review, index) in reviews"
        :key="review.id"
        :style="{ backgroundColor: colors[index % colors.length] }"
        class="block rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300"
      >
        <h2 class="text-4xl font-bold mb-4">{{ review.theme.name }}</h2>
        <p class="text-lg mb-2">Niveau: {{ review.level }}</p>
        <p class="text-lg mb-6">{{ review.theme.description }}</p>
        <div v-if="isReviewDue(review.review_date)">
          <router-link
            :to="{ name: 'DailyReview', params: { themeId: review.theme.id } }"
            class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
          >
            Revoir ce thème
          </router-link>
        </div>
        <div v-else>
          <button class="bg-red-500 text-white px-4 py-2 rounded" disabled>
            Reviens le {{ formatDate(review.review_date) }} pour réviser
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Loader from '../components/AppLoader.vue'
import { useReviewStore } from '../stores/review'

export default {
  components: {
    Loader
  },
  data() {
    return {
      colors: ['#FFCDD2', '#E1BEE7', '#BBDEFB', '#C8E6C9', '#FFECB3', '#D1C4E9'],
      loading: true
    }
  },
  computed: {
    reviews() {
      return useReviewStore().reviews
    }
  },
  created() {
    this.fetchReviews()
  },
  methods: {
    async fetchReviews() {
      try {
        await useReviewStore().fetchUserReviews()
      } catch (error) {
        console.error('Erreur lors de la récupération des révisions:', error)
      } finally {
        this.loading = false
      }
    },
    isReviewDue(reviewDate) {
      const today = new Date()
      const review = new Date(reviewDate)
      return (
        today.getFullYear() === review.getFullYear() &&
        today.getMonth() === review.getMonth() &&
        today.getDate() === review.getDate()
      )
    },
    formatDate(date) {
      const d = new Date(date)
      const day = ('0' + d.getDate()).slice(-2)
      const month = ('0' + (d.getMonth() + 1)).slice(-2)
      const year = d.getFullYear()
      return `${day}/${month}/${year}`
    }
  }
}
</script>

<style scoped>
.revisions-page {
  padding: 2rem;
}
</style>
