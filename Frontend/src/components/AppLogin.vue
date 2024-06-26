<template>
  <main
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-400 to-green-400 text-white"
  >
    <div class="w-full max-w-md p-8 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md">
      <h2 class="text-4xl font-bold mb-6 text-white text-center">Login</h2>

      <form @submit.prevent="LoginData" class="space-y-4">
        <div class="form-group">
          <label for="email" class="block text-lg font-medium text-white">Email</label>
          <input
            type="email"
            v-model="user.email"
            class="mt-1 block w-full px-3 py-2 bg-white bg-opacity-20 text-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-300"
          />
        </div>

        <div class="form-group">
          <label for="password" class="block text-lg font-medium text-white">Password</label>
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
          Login
        </button>
      </form>
    </div>
  </main>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AppLogin',
  data() {
    return {
      user: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    async LoginData() {
      try {
        const response = await axios.post('/api/login', this.user, {
          withCredentials: true
        })
        const data = response.data
        if (data.status === true) {
          alert('Login Successfully')
          this.$router.push({ name: 'HelloWorld' })
        } else {
          alert('Login failed')
        }
      } catch (error) {
        console.error(error)
        alert('Error, please try again')
      }
    }
  }
}
</script>

<style scoped>
/* Additional scoped styles if necessary */
</style>
