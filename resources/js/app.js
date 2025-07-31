/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

 import './bootstrap';
 import '../css/app.css'; 
 import { createApp } from 'vue';
 import router from "./router";
 import axios from 'axios' //追記
 import VueAxios from 'vue-axios' //追記 
 import { createPinia } from 'pinia'
 import piniaPluginPersistedstate from 'pinia-plugin-persistedstate';
//  /import store from './stores/index.js' // Vuexストアをインポート
 //import { authGuard } from "./auth-guard";
 const store = createPinia();
 store.use(piniaPluginPersistedstate);
 
 
 /**
  * Next, we will create a fresh Vue application instance. You may then begin
  * registering components with the application instance so they are ready
  * to use in your application's views. An example is included for you.
  */
 import App from './App.vue';
 const app = createApp(App);

 import ExampleComponent from './components/ExampleComponent.vue';
 import ComoditySelect from './components/common/ComoditySelect.vue';
 import CartsSelect from './components/common/CartsSelect.vue';
 import HeaderInfo from './components/common/HeaderInfo.vue';
 import AdminHeader from './components/common/AdminHeader.vue';
 import Password from './components/common/Password.vue';
 import Ship from './components/common/Ship.vue';
 import AdminUserHeader from './components/common/AdminUserHeader.vue';
 app.component('example-component', ExampleComponent);
 app.component('comodity-select', ComoditySelect);
 app.component('carts-select', CartsSelect);
 app.component('header-info', HeaderInfo);
 app.component('admin-header', AdminHeader);
 app.component('password', Password);
 app.component('ship', Ship);
 app.component('admin-user-header', AdminUserHeader);

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
 
 //app.use(createPinia()).use(authGuard(router)).use(VueAxios, axios).mount('#app');
//app.use(createPinia());
//authGuard(router);
app.use(store).use(router).use(VueAxios, axios).mount('#app');
 