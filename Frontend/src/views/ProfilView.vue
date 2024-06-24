<template>
  <div class="profile-page">
    <div class="profile-header bg-black bg-opacity-50 p-6 rounded-lg shadow-md mb-6">
      <div class="flex items-center">
        <img :src="user.profilePicture" alt="Photo de profil" class="rounded-full w-32 h-32 mr-6" />
        <div>
          <h1 class="text-3xl font-bold">{{ user.name }}</h1>
          <p class="text-lg">{{ user.description }}</p>
        </div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
      <div class="categories bg-black bg-opacity-50 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Mes Catégories</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <router-link
            v-for="(category, index) in categories"
            :key="category.id"
            :to="'/themes/' + category.id"
            class="block p-4 rounded-lg shadow hover:shadow-lg transition-transform duration-300 transform hover:-translate-y-1"
            :style="{ backgroundColor: colors[index % colors.length] }"
          >
            <h3 class="text-xl font-bold">{{ category.name }}</h3>
          </router-link>
        </div>
      </div>

      <div class="themes bg-black bg-opacity-50 p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-4">Mes Thèmes</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div
            v-for="(theme, index) in themes"
            :key="theme.id"
            class="block p-4 rounded-lg shadow hover:shadow-lg transition-transform duration-300 transform hover:-translate-y-1"
            :style="{ backgroundColor: colors[index % colors.length] }"
          >
            <h3 class="text-xl font-bold">{{ theme.name }}</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="update-info bg-black bg-opacity-50 p-6 rounded-lg shadow-md">
      <h2 class="text-2xl font-bold mb-4">Modifier mes informations</h2>
      <form @submit.prevent="updateInfo">
        <div class="mb-4">
          <label for="email" class="block text-lg font-medium mb-2">Email</label>
          <input
            type="email"
            v-model="user.email"
            id="email"
            class="w-full p-2 border rounded-lg"
          />
        </div>
        <div class="mb-4">
          <label for="password" class="block text-lg font-medium mb-2">Nouveau mot de passe</label>
          <input
            type="password"
            v-model="user.password"
            id="password"
            class="w-full p-2 border rounded-lg"
          />
        </div>
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
          Mettre à jour
        </button>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
        profilePicture: 'https://via.placeholder.com/150', // URL de la photo de profil
        name: 'John Doe',
        description: 'Développeur passionné de Vue.js et Node.js.',
        email: 'john.doe@example.com',
        password: ''
      },
      categories: [
        { id: 1, name: 'Catégorie 1' },
        { id: 2, name: 'Catégorie 2' },
        { id: 3, name: 'Catégorie 3' }
      ],
      themes: [
        { id: 1, name: 'Thème 1' },
        { id: 2, name: 'Thème 2' },
        { id: 3, name: 'Thème 3' }
      ],
      colors: ['#FFCDD2', '#E1BEE7', '#BBDEFB', '#C8E6C9', '#FFECB3', '#D1C4E9']
    }
  },
  methods: {
    updateInfo() {
      // Logique pour mettre à jour l'email et le mot de passe
      console.log('Email:', this.user.email)
      console.log('Mot de passe:', this.user.password)
      alert('Informations mises à jour avec succès !')
    }
  }
}
</script>

<style scoped>
.profile-page {
  padding: 2rem;
}
.profile-header img {
  border-radius: 50%;
}
</style>
