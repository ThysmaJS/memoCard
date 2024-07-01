import axios from 'axios'

axios.defaults.withCredentials = true
axios.defaults.baseURL = 'http://localhost:8000'

const axiosInstance = axios.create({
  baseURL: 'http://localhost:8000/api',
  withCredentials: true
})

// Ajouter l'en-tête Authorization avec le token Bearer
axiosInstance.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

export default axiosInstance
