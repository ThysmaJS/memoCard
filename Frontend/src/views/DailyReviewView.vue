<template>
  <main
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-400 to-green-400 text-white"
  >
    <section
      class="w-full max-w-lg p-10 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md sm:max-w-2xl text-center"
    >
      <h1 class="text-4xl font-bold mb-6 text-white sm:text-5xl">Révision du Thème</h1>
      <div v-if="cards.length" class="card-container relative">
        <div v-if="!isReviewFinished">
          <div
            ref="card"
            class="card"
            :class="{ flipped, 'move-to-back': moveToBack }"
            @click="flipCard"
          >
            <div class="front face">
              <h2 class="text-2xl font-bold mb-4">{{ currentCard.front }}</h2>
            </div>
            <div class="back face">
              <h2 class="text-2xl font-bold mb-4">{{ currentCard.back }}</h2>
            </div>
          </div>
          <div class="flex justify-between mt-4">
            <button
              @click="resetToLevelOne"
              class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded"
            >
              Erreur
            </button>
            <button
              v-if="!isLastCard"
              @click="nextCard"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Suivant
            </button>
            <button
              v-if="isLastCard"
              @click="finishReview"
              class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
            >
              J'ai fini de réviser
            </button>
          </div>
        </div>
        <div v-else class="finish-section">
          <h2 class="text-3xl font-bold mb-4">Cette révision est terminée !</h2>
          <p class="text-lg mb-6">
            Félicitations, vous avez terminé votre révision. Vous pouvez maintenant revenir à
            l'accueil ou consulter vos révisions.
          </p>
          <div class="button-group flex flex-col space-y-4">
            <router-link
              :to="{ name: 'home' }"
              class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
            >
              Retour à l'accueil
            </router-link>
            <router-link
              :to="{ name: 'MesRevisions' }"
              class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded"
            >
              Mes révisions
            </router-link>
          </div>
        </div>
      </div>
      <div v-else class="loader-container">
        <div class="flickity-container">
          <div class="hand">
            <div class="card-loader card-1"><span></span></div>
            <div class="card-loader card-2"><span></span></div>
            <div class="card-loader card-3"><span></span></div>
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
      cards: [],
      currentCardIndex: 0,
      flipped: false,
      moveToBack: false,
      selectedThemeId: null,
      isReviewFinished: false,
      review: null
    }
  },
  computed: {
    currentCard() {
      return this.cards[this.currentCardIndex]
    },
    isLastCard() {
      return this.currentCardIndex === this.cards.length - 1
    }
  },
  created() {
    this.selectedThemeId = this.$route.params.themeId
    this.fetchCards()
    this.checkReview()
  },
  methods: {
    async fetchCards() {
      try {
        const response = await axios.get(`/themes/${this.selectedThemeId}/cards`)
        this.cards = response.data
      } catch (error) {
        console.error('Erreur lors de la récupération des cartes:', error)
      }
    },
    async checkReview() {
      try {
        const userResponse = await axios.get('/user', { withCredentials: true })
        const userId = userResponse.data ? userResponse.data.id : null
        const response = await axios.get(`/reviews/check`, {
          params: {
            theme_id: this.selectedThemeId,
            user_id: userId
          },
          withCredentials: true
        })
        this.review = response.data.review
      } catch (error) {
        console.error('Erreur lors de la vérification de la révision:', error)
      }
    },
    flipCard() {
      this.flipped = !this.flipped
    },
    nextCard() {
      const cardElement = this.$refs.card
      if (cardElement) {
        this.moveToBack = true
        setTimeout(() => {
          this.currentCardIndex = (this.currentCardIndex + 1) % this.cards.length
          this.flipped = false
          this.moveToBack = false
        }, 600)
      }
    },
    async finishReview() {
      this.isReviewFinished = true
      try {
        const userResponse = await axios.get('/user', { withCredentials: true })
        const userId = userResponse.data ? userResponse.data.id : null
        if (this.review && this.review.level !== null) {
          // Update existing review
          const reviewData = {
            theme_id: this.selectedThemeId,
            user_id: userId
          }
          await axios.post('/reviews/finish', reviewData, { withCredentials: true })
          console.log('Révision mise à jour avec succès')
        } else {
          // Create new review
          const reviewData = {
            review_date: new Date().toISOString().split('T')[0], // format YYYY-MM-DD
            max_level: 5, // exemple de niveau maximal
            user_id: userId,
            theme_id: this.selectedThemeId,
            level: 1 // exemple de niveau
          }
          await axios.post('/reviews', reviewData, { withCredentials: true })
          console.log('Nouvelle révision enregistrée avec succès')
        }
      } catch (error) {
        console.error("Erreur lors de l'enregistrement de la révision:", error)
      }
    },
    async resetToLevelOne() {
      try {
        const userResponse = await axios.get('/user', { withCredentials: true })
        const userId = userResponse.data ? userResponse.data.id : null
        if (this.review) {
          const reviewData = {
            theme_id: this.selectedThemeId,
            user_id: userId,
            level: 1 // Reset level to 1
          }
          await axios.post('/reviews/reset', reviewData, { withCredentials: true })
          this.$router.push({ name: 'MesRevisions' })
          console.log('Niveau de révision réinitialisé à 1 avec succès')
        }
      } catch (error) {
        console.error('Erreur lors de la réinitialisation du niveau de révision:', error)
      }
    }
  }
}
</script>

<style scoped>
.card-container {
  perspective: 1000px;
}

.card {
  width: 100%;
  height: 300px;
  position: relative;
  transform-style: preserve-3d;
  transition:
    transform 0.6s,
    opacity 0.6s;
  cursor: pointer;
}

.card.flipped {
  transform: rotateY(180deg);
}

.card.no-transition {
  transition: none !important;
}

.card.move-to-back {
  animation: moveToBack 2s forwards;
}

.face {
  border: 2px solid #ffffff;
  border-radius: 10px;
  padding: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.card .front,
.card .back {
  position: absolute;
  width: 100%;
  height: 100%;
  backface-visibility: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
}

.card .back {
  transform: rotateY(180deg);
}

@keyframes moveToBack {
  0% {
    transform: translateX(0) scale(1);
    opacity: 1;
  }
  50% {
    transform: translateX(150%) scale(0.8);
    opacity: 0.5;
  }
  100% {
    transform: translateX(-150%) scale(1);
    opacity: 0;
  }
}

/* Loader styles */
.loader-container {
  display: flex;
  margin-left: 35%;
  align-items: center;
  height: 300px;
}

.flickity-container {
  display: flex;
  justify-content: center;
  align-items: center;
}
.hand {
  position: relative;
  height: 100px;
}

.card-loader {
  font-size: 22px;
  height: 100px;
  width: 70px;
  border: 3px solid #262722;
  border-radius: 3px;
  background-color: lavender;
  position: absolute;
  top: 0;
  transition: transform 0.2s ease;
  display: flex;
  justify-content: center;
  align-items: center;
  transition-timing-function: cubic-bezier(0.18, 0.89, 0.32, 1.28);
}

.card-loader span {
  background-color: #8badc8;
  display: none;
  width: 50px;
  height: 50px;
  border-radius: 25px;
}

.card-loader.card-1 {
  z-index: 3;
  margin-left: 20px;
  animation-duration: 3s;
  animation-name: card-1;
  animation-iteration-count: infinite;
}

.card-loader.card-2 {
  z-index: 2;
  margin-left: 10px;
  animation-duration: 3s;
  animation-name: card-2;
  animation-iteration-count: infinite;
}

.card-loader.card-3 {
  z-index: 1;
  animation-duration: 3s;
  animation-name: card-3;
  animation-iteration-count: infinite;
}

@keyframes card-1 {
  0% {
  }
  16.66666% {
    transform: translateX(95px) rotate(15deg);
  } /* slide out */
  33.33333% {
    transform: translateX(-20px);
    z-index: 1;
  } /* to back */
  49.99999% {
    transform: translateX(-20px);
    z-index: 1;
  }
  66.66666% {
    transform: translateX(-10px);
    z-index: 2;
  } /* to middle */
  83.33333% {
    transform: translateX(-10px);
    z-index: 2;
  }
}

@keyframes card-2 {
  0% {
  }
  16.66666% {
    transform: translateX(0);
  }
  33.33333% {
    transform: translateX(10px);
    z-index: 3;
  } /* to front */
  49.99999% {
    transform: translateX(105px) rotate(15deg);
  } /* slide out */
  66.66666% {
    transform: translateX(-10px);
    z-index: 1;
  } /* to back */
  83.33333% {
    transform: translateX(-10px);
    z-index: 1;
  } /* stay still */
}

@keyframes card-3 {
  0% {
    z-index: 1;
  } /* to back */
  16.66666% {
    transform: translateX(0);
  }
  33.33333% {
    transform: translateX(10px);
    z-index: 2;
  } /* to middle */
  49.99999% {
    transform: translateX(10px);
    z-index: 2;
  } /* stay still */
  66.66666% {
    transform: translateX(20px);
    z-index: 3;
  } /* to front */
  83.33333% {
    transform: translateX(115px) rotate(15deg);
  } /* slide out */
}

/* Finish section styles */
.finish-section {
  margin-top: 2rem;
  padding: 2rem;
  background-color: rgba(255, 255, 255, 0.1);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.button-group {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.button-group router-link {
  width: 100%;
  max-width: 200px;
  margin-bottom: 1rem;
}
</style>
