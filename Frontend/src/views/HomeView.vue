<template>
  <main
    class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-400 to-green-400 text-white"
  >
    <TheWelcome class="text-center mb-12" />
    <section
      class="w-full max-w-lg p-10 bg-white bg-opacity-10 rounded-lg shadow-lg backdrop-blur-md sm:max-w-2xl"
    >
      <h1 class="text-4xl font-bold mb-6 text-white sm:text-5xl text-center">
        Bienvenue sur Project Memory
      </h1>
      <p class="text-lg mb-8 text-white sm:text-xl text-center">
        Retiens ce que tu souhaites grâce à la technique de la répétition espacée.<br />
        N'attends plus et lance-toi !
      </p>
      <div class="flex flex-col items-center sm:flex-row sm:justify-center">
        <a
          href="#features"
          class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded-full mb-4 sm:mb-0 sm:mr-4 transition duration-300 ease-in-out transform hover:scale-105"
          >Me connecter</a
        >
        <router-link
          to="/category"
          class="bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-6 rounded-full transition duration-300 ease-in-out transform hover:scale-105"
        >
          Catégories
        </router-link>
      </div>
    </section>
  </main>
</template>
<style scoped>
/* Additional scoped styles */
a {
  transition: transform 0.3s ease-in-out;
}
</style>
