import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RoomsView from "../views/RoomsView.vue";
import ReviewsView from "../views/ReviewsView.vue";
import AboutView from '../views/AboutView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
      {
          path: '/',
          name: 'home',
          component: HomeView,
      },
      {
          path: '/rooms',
          name: 'rooms',
          component: RoomsView,
      },
      {
          path: '/reviews',
          name: 'reviews',
          component: ReviewsView,
      },
      {
          path: '/about',
          name: 'about',
          component: AboutView,
      },
  ]
})

router.afterEach((to, from, failure) => {
  if (!failure) {
    setTimeout(() => {
      HSStaticMethods.autoInit();
    }, 100)
  }
});

export default router
