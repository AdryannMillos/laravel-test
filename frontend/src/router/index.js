import { createRouter, createWebHistory } from 'vue-router'
import LoginSininView from '../views/LoginSininView.vue'
import TodoView from '../views/TodoView.vue'

const routes = [
  {
    path: '/',
    name: 'LoginSininView',
    component: LoginSininView
  },
  {
    path: '/my-todo',
    name: 'TodoView',
    component: TodoView
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router