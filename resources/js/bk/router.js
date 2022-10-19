import { createRouter, createWebHistory } from "vue-router"
import TOP from './views/components/Top.vue'
import NEWS from './views/components/News.vue'
import ITEMS from './views/components/Items.vue'
import QANDA from './views/components/Qanda.vue'
import ONLINESTORE from './views/components/OnlineStore.vue'



const routes =   [
  {
    path: '/',
    name: 'top',
    component: TOP
  },
  {
      path: '/news',
      name: 'news',
      component: NEWS
  },
  {
      path: '/items',
      name: 'items',
      component: ITEMS
  },
  {
      path: '/q-and-a',
      name: 'q-and-a',
      component: QANDA
  },
  {
      path: '/online-store',
      name: 'online-store',
      component: ONLINESTORE
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
