<template>
  <div>
    <h1>Profil de l'utilisateur</h1>
    <p><strong>Nom:</strong> {{ user.name }}</p>
    <p><strong>Email:</strong> {{ user.email }}</p>
  </div>
</template>

<script>
import axios from '../axios'

export default {
  data() {
    return {
      user: {}
    }
  },
  created() {
    this.fetchUserProfile()
  },
  methods: {
    async fetchUserProfile() {
      try {
        const response = await axios.get('/user')
        this.user = response.data
      } catch (error) {
        console.error('Erreur lors de la récupération du profil utilisateur:', error)
      }
    }
  }
}
</script>
