<template>
  <main
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-400 to-green-400 text-white"
  >
    <div
      class="w-full max-w-lg p-10 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md sm:max-w-2xl"
    >
      <h1 class="text-4xl font-bold mb-6 text-white sm:text-5xl text-center">Register Form</h1>
      <form @submit.prevent="saveData" class="space-y-4">
        <div>
          <label for="name" class="block text-lg font-medium text-white">First Name</label>
          <input
            type="text"
            v-model="users.name"
            name="name"
            id="name"
            class="form-control mt-1 block w-full px-3 py-2 bg-white bg-opacity-20 text-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-300"
          />
        </div>
        <div>
          <label for="email" class="block text-lg font-medium text-white">Email</label>
          <input
            type="email"
            v-model="users.email"
            name="email"
            id="email"
            class="form-control mt-1 block w-full px-3 py-2 bg-white bg-opacity-20 text-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-300"
          />
        </div>
        <div>
          <label for="password" class="block text-lg font-medium text-white">Password</label>
          <input
            type="password"
            v-model="users.password"
            name="password"
            id="password"
            class="form-control mt-1 block w-full px-3 py-2 bg-white bg-opacity-20 text-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-opacity-50 focus:ring-blue-300"
          />
        </div>
        <div>
          <input
            type="submit"
            value="Save"
            class="btn btn-success w-full py-2 px-4 bg-green-500 hover:bg-green-600 text-white font-bold rounded-full transition duration-300 ease-in-out transform hover:scale-105 cursor-pointer"
          />
        </div>
      </form>
    </div>
  </main>
</template>

<script>
import axios from 'axios'

export default {
  name: 'AppRegister',
  data() {
    return {
      users: {
        name: '',
        email: '',
        password: ''
      },
      error: ''
    }
  },
  methods: {
    saveData() {
      axios
        .post('http://localhost:8000/api/register', this.users, { withCredentials: true })
        .then(({ data }) => {
          console.log(data)
          alert('saved')
        })
        .catch((err) => {
          console.error(err)
          this.error = err.response ? err.response.data.message : 'An error occurred'
        })
    }
  }
}
</script>

<style scoped>
/* Additional scoped styles if necessary */
</style>
