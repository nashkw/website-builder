import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import RoomsView from "../views/RoomsView.vue";
import ReviewsView from "../views/ReviewsView.vue";
import AboutView from '../views/AboutView.vue'
import ExploreView from "../views/ExploreView.vue";
import FindUsView from "../views/FindUsView.vue";
import FAQView from "../views/FAQView.vue";

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
      {
          path: '/explore',
          name: 'explore',
          component: ExploreView,
      },
      {
          path: '/find-us',
          name: 'findus',
          component: FindUsView,
      },
      {
          path: '/faq',
          name: 'faq',
          component: FAQView,
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
