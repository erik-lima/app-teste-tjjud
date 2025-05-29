import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/',
    name: 'homeScreen',
    component: () => import(/* webpackChunkName: "home" */ '../views/Home.vue')
  },
  {
    path: '/livros',
    component: () => import(/* webpackChunkName: "books" */ '../views/Books.vue')
  },
  {
    path: '/autores',
    component: () => import(/* webpackChunkName: "authors" */ '../views/Authors.vue')
  },
  {
    path: '/assuntos',
    component: () => import(/* webpackChunkName: "subjects" */ '../views/Subjects.vue')
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
