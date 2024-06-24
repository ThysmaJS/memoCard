<template>
  <div class="categories-page">
    <h1 class="text-3xl font-bold mb-6">Catégories</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <router-link
        v-for="(category, index) in categories"
        :key="category.id"
        :to="'/themes/' + category.id"
        :style="{ backgroundColor: colors[index % colors.length] }"
        class="block rounded-lg shadow-md p-6 hover:shadow-lg transition-transform duration-300 transform hover:-translate-y-1 hover:scale-105"
      >
        <h2 class="text-4xl font-bold mb-4">{{ category.name }}</h2>
        <p class="text-lg mb-2">Créé par: {{ category.createdBy }}</p>
        <p>{{ category.description }}</p>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [
        {
          id: 1,
          name: 'Catégorie 1',
          createdBy: 'Alice',
          description: 'Description de la catégorie 1'
        },
        {
          id: 2,
          name: 'Catégorie 2',
          createdBy: 'Bob',
          description: 'Description de la catégorie 2'
        },
        {
          id: 3,
          name: 'Catégorie 3',
          createdBy: 'Charlie',
          description: 'Description de la catégorie 3'
        },
        {
          id: 4,
          name: 'Catégorie 4',
          createdBy: 'Dave',
          description: 'Description de la catégorie 4'
        },
        {
          id: 5,
          name: 'Catégorie 5',
          createdBy: 'Eve',
          description: 'Description de la catégorie 5'
        },
        {
          id: 6,
          name: 'Catégorie 6',
          createdBy: 'Frank',
          description: 'Description de la catégorie 6'
        }
      ],
      colors: ['#FFCDD2', '#E1BEE7', '#BBDEFB', '#C8E6C9', '#FFECB3', '#D1C4E9']
    }
  }
}
</script>

<style scoped>
.categories-page {
  padding: 2rem;
}
</style>
