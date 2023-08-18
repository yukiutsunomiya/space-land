/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 import './bootstrap';
 import '../css/app.css'; 
 import { createApp } from 'vue';
 import { createRouter, createWebHistory } from 'vue-router';
 import Top from './components/Top.vue';
 import News from './components/News.vue';
 import Items from './components/Items.vue';
 import Qanda from './components/Qanda.vue';
 import OnlineStore from './components/OnlineStore.vue';
 import DescriptionOfItem from './components/DescriptionOfItem.vue';
 import axios from 'axios' //追記
 import VueAxios from 'vue-axios' //追記 
 
 const routes = [
  {
    path: '/',
    name: 'Top',
    component: Top
  },
  {
    path: '/news',
    name: 'News',
    component: News
  },
  {
    path: '/items',
    name: 'Items',
    component: Items
  },
  {
    path: '/q-and-a',
    name: 'Qanda',
    component: Qanda
  },
  {
    path: '/online-store',
    name: 'OnlineStore',
    component: OnlineStore
  },
  {
    path: '/item',
    name: 'DescriptionOfItem',
    component: DescriptionOfItem
  },
  
 ];

 
 const router = createRouter({
   history: createWebHistory(),
   routes,
   scrollBehavior(to) {
    if (to.hash) {
      return { el: to.hash };
    } else {
      return { top: 0 };
    }
  }
 });
 
 export default router;
 
 /**
  * Next, we will create a fresh Vue application instance. You may then begin
  * registering components with the application instance so they are ready
  * to use in your application's views. An example is included for you.
  */
 
 const app = createApp({});
 
 import ExampleComponent from './components/ExampleComponent.vue';
 import ComoditySelect from './components/ComoditySelect.vue';
 import CartsSelect from './components/CartsSelect.vue';
 import changeCart from './components/changeCart.vue';
 import headerNav from './components/headerNav.vue';
 import Password from './components/Password.vue';
 import Ship from './components/Ship.vue';
 app.component('example-component', ExampleComponent);
 app.component('comodity-select', ComoditySelect);
 app.component('carts-select', CartsSelect);
 app.component('items', Items);
 app.component('change-cart', changeCart);
 app.component('header-nav', headerNav);
 app.component('password', Password);
 app.component('ship', Ship);

 /**
  * The following block of code may be used to automatically register your
  * Vue components. It will recursively scan this directory for the Vue
  * components and automatically register them with their "basename".
  *
  * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
  */
 
 // Object.entries(import.meta.globEager('./**/*.vue')).forEach(([path, definition]) => {
 //     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
 // });
 
 /**
  * Finally, we will attach the application instance to a HTML element with
  * an "id" attribute of "app". This element is included with the "auth"
  * scaffolding. Otherwise, you will need to add an element yourself.
  */
 
 app.use(router).use(VueAxios, axios).mount('#app');
 