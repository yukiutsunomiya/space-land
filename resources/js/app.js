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
 import Commodity from './components/Commodity.vue';
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
  {
    path: '/commodity',
    name: 'Commodity',
    component: Commodity
  }

 ];
 
 const router = createRouter({
   history: createWebHistory(),
   routes
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
 app.component('example-component', ExampleComponent);
 app.component('comodity-select', ComoditySelect);

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
 