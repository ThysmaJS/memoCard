<template>
  <div class="theme-page">
    <h1 class="text-3xl font-bold mb-6">Thème: {{ theme.name }}</h1>
    <div class="rounded-lg shadow-md p-6">
      <h2 class="text-4xl font-bold mb-4">{{ theme.name }}</h2>
      <p class="text-lg mb-2">Créé par: {{ theme.createdBy }}</p>
      <p class="text-lg mb-6">{{ theme.description }}</p>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="(item, index) in theme.items"
          :key="item.id"
          :style="{ backgroundColor: colors[index % colors.length] }"
          class="rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300"
        >
          <h3 class="text-2xl font-bold mb-4">{{ item.name }}</h3>
          <p>{{ item.description }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      theme: {
        id: 1,
        name: '',
        createdBy: '',
        description: '',
        items: []
      },
      colors: ['#FFCDD2', '#E1BEE7', '#BBDEFB', '#C8E6C9', '#FFECB3', '#D1C4E9']
    }
  },
  created() {
    const themeId = this.$route.params.id
    // Fetch theme data based on the themeId
    // For simplicity, using hardcoded data here
    const themes = [
      {
        id: 2,
        name: 'Thème Exemple',
        createdBy: 'Alice',
        description: 'Description détaillée du thème exemple.',
        items: [
          { id: 1, name: 'Item 1', description: "Description de l'item 1" },
          { id: 2, name: 'Item 2', description: "Description de l'item 2" },
          { id: 3, name: 'Item 3', description: "Description de l'item 3" },
          { id: 4, name: 'Item 4', description: "Description de l'item 4" },
          { id: 5, name: 'Item 5', description: "Description de l'item 5" },
          { id: 6, name: 'Item 6', description: "Description de l'item 6" }
        ]
      }
    ]
    this.theme = themes.find((t) => t.id == themeId)
  }
}
</script>

<style scoped>
.theme-page {
  padding: 2rem;
}
</style>
