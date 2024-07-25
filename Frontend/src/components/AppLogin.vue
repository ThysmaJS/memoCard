<template>
  <main
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-400 to-green-400 text-white"
  >
    <div class="w-full max-w-md p-8 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md">
      <h2 class="text-4xl font-bold mb-6 text-white text-center">Connexion</h2>

      <form @submit.prevent="login" class="space-y-4">
        <div class="form-group">
          <label for="email" class="block text-lg font-medium text-white">Email</label>
          <input
            type="email"
            v-model="user.email"
            class="mt-1 block w-full px-3 py-2 bg-white bg-opacity-20 text-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-300"
          />
        </div>

        <div class="form-group">
          <label for="password" class="block text-lg font-medium text-white">Mot de passe</label>
          <input
            type="password"
            v-model="user.password"
            class="mt-1 block w-full px-3 py-2 bg-white bg-opacity-20 text-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-300"
          />
        </div>

        <button
          type="submit"
          class="w-full py-2 px-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full transition duration-300 ease-in-out transform hover:scale-105 cursor-pointer"
        >
          Se connecter
        </button>
      </form>
    </div>
  </main>
</template>

<script setup>
import { useAuthStore } from '../stores/auth'
import axios from '../axios'
import { useRouter } from 'vue-router'
import { ref } from 'vue'

const authStore = useAuthStore()
const router = useRouter()
const user = ref({
  email: '',
  password: ''
})

const login = async () => {
  try {
    const response = await axios.post('/auth/login', user.value)
    const data = response.data
    if (data.status === true) {
      localStorage.setItem('token', data.token)
      authStore.login()
      router.push({ name: 'home' }) // Redirection vers la page d'accueil
      alert('Login Successfully')
    } else {
      alert('Login failed')
    }
  } catch (error) {
    console.error(error)
    alert('Error, please try again')
  }
}
</script>

<style scoped>
/* Additional scoped styles if necessary */
</style>
