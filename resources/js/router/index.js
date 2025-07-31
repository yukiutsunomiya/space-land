 import { createRouter, createWebHistory } from 'vue-router';
 import Top from '../components/pages/Top.vue';
 import News from '../components/pages/News.vue';
 import Items from '../components/pages/Items.vue';
 import Qanda from '../components/pages/Qanda.vue';
 import OnlineStore from '../components/pages/OnlineStore.vue';
 import DescriptionOfItem from '../components/pages/DescriptionOfItem.vue';
 import Commodity from '../components/pages/Commodity.vue';
 import Carts from '../components/pages/Carts.vue';
 import Purchases from '../components/pages/Purchases.vue';
 import ChangeCart from '../components/pages/ChangeCart.vue';
 import InquiryList from '../components/pages/InquiryList.vue';
 import Inquiry from '../components/pages/Inquiry.vue';
 import Contact from '../components/pages/Contact.vue';
 import ContactConfirm from '../components/pages/ContactConfirm.vue';
 import User from '../components/pages/User.vue';
 import UserEdit from '../components/pages/UserEdit.vue';
 import Login from '../components/auth/Login.vue';
 import Logout from '../components/auth/Logout.vue';
 import Register from '../components/auth/Register.vue';
 import AdminTop from '../components/admin/Top.vue';
 import AdminRegister from '../components/admin/Register.vue';
 import AdminLogin from '../components/admin/Login.vue';
 import AdminLogout from '../components/admin/Logout.vue';
 import AdminUsers from '../components/admin/Users.vue';
 import AdminUser from '../components/admin/User.vue';
 import AdminUserEdit from '../components/admin/UserEdit.vue';
 import UserOrderHistory from '../components/admin/UserOrderHistory.vue';
 import UserCart from '../components/admin/UserCart.vue';
 import UserInquiryList from '../components/admin/UserInquiryList.vue';
 import UserInquiry from '../components/admin/UserInquiry.vue';
 import OrderHistory from '../components/admin/OrderHistory.vue';
 import AdminInquiryList from '../components/admin/InquiryList.vue';
 import AdminInquiry from '../components/admin/Inquiry.vue';
 import AdminProducts from '../components/admin/Products.vue';
 import AdminProduct from '../components/admin/Product.vue';
 import AdminProductEdit from '../components/admin/ProductEdit.vue';

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
    },
    {
      path: '/carts',
      name: 'Carts',
      component: Carts
    },
    {
      path: '/purchases',
      name: 'Purchases',
      component: Purchases
    },
    {
      path: '/changeCart',
      name: 'ChangeCart',
      component: ChangeCart
    },
    {
      path: '/inquiryList',
      name: 'InquiryList',
      component: InquiryList
    },
    {
      path: '/inquiry',
      name: 'Inquiry',
      component: Inquiry
    },
    {
      path: '/contact',
      name: 'Contact',
      component: Contact
    },
    {
      path: '/contactConfirm',
      name: 'ContactConfirm',
      component: ContactConfirm
    },
    {
      path: '/user',
      name: 'User',
      component: User
    },
    {
      path: '/userEdit',
      name: 'UserEdit',
      component: UserEdit
    },
    {
      path: '/login',
      name: 'auth.login',
      component: Login
    },
    {
      path: '/logout',
      name: 'auth.logout',
      component: Logout
    },
    {
      path: '/register',
      name: 'auth.register',
      component: Register
    },
    {
      path: '/admin/',
      name: 'admin.top',
      component: AdminTop
    },
    {
      path: '/admin/login',
      name: 'admin.login',
      component: AdminLogin
    },
    {
      path: '/admin/logout',
      name: 'admin.logout',
      component: AdminLogout
    },
    {
      path: '/admin/register',
      name: 'admin.register',
      component: AdminRegister
    },
    {
      path: '/admin/login',
      name: 'admin.login',
      component: AdminLogin
    },
     {
      path: '/admin/logout',
      name: 'admin.logout',
      component: AdminLogout
    },
    {
      path: '/admin/Users',
      name: 'admin.users',
      component: AdminUsers
    },
    {
      path: '/admin/User',
      name: 'admin.user',
      component: AdminUser
    },
    {
      path: '/admin/UserEdit',
      name: 'admin.userEdit',
      component: AdminUserEdit
    },
    {
      path: '/admin/UserOrderHistory',
      name: 'admin.UserOrderHistory',
      component: UserOrderHistory
    },
    {
      path: '/admin/UserCart',
      name: 'admin.userCart',
      component: UserCart
    },
    {
      path: '/admin/UserInquiryList',
      name: 'admin.UserInquiryList',
      component: UserInquiryList
    },
    {
      path: '/admin/UserInquiry',
      name: 'admin.UserInquiry',
      component: UserInquiry
    },
    {
      path: '/admin/OrderHistory',
      name: 'admin.OrderHistory',
      component: OrderHistory
    },
    {
      path: '/admin/InquiryList',
      name: 'admin.InquiryList',
      component: AdminInquiryList
    },
    {
      path: '/admin/Inquiry',
      name: 'admin.Inquiry',
      component: AdminInquiry
    },
    {
      path: '/admin/Products',
      name: 'admin.Products',
      component: AdminProducts
    },
    {
      path: '/admin/Product',
      name: 'admin.Product',
      component: AdminProduct
    },
    {
      path: '/admin/ProductEdit',
      name: 'admin.ProductEdit',
      component: AdminProductEdit
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
