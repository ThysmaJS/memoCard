<template>
  <main
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-400 to-green-400 text-white"
  >
    <section
      class="w-full max-w-lg p-10 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md sm:max-w-2xl text-center"
    >
      <h1 class="text-4xl font-bold mb-6 text-white sm:text-5xl">Cartes du Thème</h1>
      <div v-if="cards.length" class="card-container relative">
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
        <button
          @click="nextCard"
          class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mt-4"
        >
          Suivant
        </button>
      </div>
      <div v-else>
        <p class="text-xl">Aucune carte disponible pour ce thème.</p>
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
      selectedThemeId: null // Add this to track selected theme ID
    }
  },
  computed: {
    currentCard() {
      return this.cards[this.currentCardIndex]
    }
  },
  created() {
    this.selectedThemeId = this.$route.params.themeId // Get themeId from route params
    this.fetchCards()
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
        }, 600) // Duration should match the CSS transition duration
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
</style>
