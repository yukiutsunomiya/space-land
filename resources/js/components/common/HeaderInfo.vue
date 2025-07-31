<template>
  <header class="header">
    <div class="container">
      <h2 class="fw-bold text-center mb-0 mt-2">Space Land</h2>
      <p class="fw-bold text-center my-3 ">（株）総合研究舎</p>
      <template v-if="store.user !== null && store.isLoggedIn == true">
        <p class="fw-bold">ログインユーザー名：{{ store.user.name }}</p>
      </template>
     
      <nav class="navbar navbar-expand-md">
        <!-- ハンバーガーメニュー -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
          <template v-if="isTargetPath()">
            <!--
              <header-nav></header-nav>
            -->
            <ul class="navbar-nav">
              <li class="nav-item dropdown py-2">
                <router-link class="nav-link dropdown-toggle fw-bold" to="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Space Land
                </router-link>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><router-link class="dropdown-item" to="/">HOME</router-link></li>
                  <li><router-link class="dropdown-item" to="/#about">ABOUT</router-link></li>
                </ul>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item py-2">
                <router-link class="nav-link fw-bold" to="/news">NEWS</router-link>
              </li>
            </ul> 
            <ul class="navbar-nav">
              <li class=" nav-item py-2">
                <router-link class="nav-link fw-bold" to="/items">ITEMS</router-link>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item py-2">
                <router-link class="nav-link fw-bold" to="/q-and-a">Q＆A</router-link>
              </li>
            </ul>
            <ul class="navbar-nav">
              <li class="nav-item py-2">
                <router-link class="nav-link fw-bold" to="/online-store">ONLINE STORE</router-link>
              </li>
            </ul>
          </template>
          <template v-else>
            <ul class="navbar-nav">
              <li class="nav-item dropdown py-2">
                <a class="nav-link dropdown-toggle fw-bold" href="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Space Land
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><router-link class="dropdown-item" to="/">HOME</router-link></li>
                  <li><router-link class="dropdown-item" to="/#about">ABOUT</router-link></li>
                </ul>
              </li>
            </ul>
            <ul class="navbar-nav ">
              <li class="nav-item py-2">
                <router-link class="nav-link fw-bold" to="/items">ITEMS</router-link>
              </li>
            </ul>
          </template>
          
           
            <template v-if="store.user !== null">
              <ul class="navbar-nav">
                <li class="nav-item dropdown py-2">
                  <a class="nav-link dropdown-toggle fw-bold" href="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ユーザー管理情報
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><router-link class="dropdown-item" to="/carts">CARTS</router-link></li>
                    <li><router-link class="dropdown-item" to="/purchases">購入履歴</router-link></li>
                    <li><router-link class="dropdown-item" to="/inquiryList">お問い合わせ履歴</router-link></li>
                    <li><router-link class="dropdown-item" to="/user">ユーザー情報</router-link></li>
                  </ul>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link to="/logout" 
                    onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" class="nav-link fw-bold">
                      ログアウト
                  </router-link>
                </li>
              </ul>
            </template>
          
          <template v-else>
            <ul class="navbar-nav">
              <li class="nav-item py-2">
                <router-link to="/login" class="nav-link fw-bold">login</router-link>
              </li>
            </ul>
            <!--@if (Route::has('register'))-->

            <ul class="navbar-nav">
             <li class="nav-item py-2">
                <router-link to="/register" class="nav-link fw-bold">Register</router-link>
              </li>
            </ul>        
          </template>
          <template v-if="route.path !== '/contactconfirm'">
            <ul class="navbar-nav ">
              <li class="nav-item py-2">
                <router-link class="nav-link fw-bold" to="/contact">CONTACT</router-link>
              </li>
            </ul>
          </template>
        </div>
      </nav>
    </div>
            
            <!--
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            @endif
                        @endauth
                    </div>
                @endif
            / ナビゲーション -->
  </header>
</template>
<script setup>
  import { useRoute } from 'vue-router';
  import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
  // 現在のルート情報を取得
  const route = useRoute();
  const store = useAuthStore();
  console.log("store確認します：",store);
  // 特定のパスと一致しているかを判定
  function isTargetPath() {
    return (
      route.path === '/' ||
      route.path === '/news' ||
      route.path === '/items' ||
      route.path === '/q-and-a' ||
      route.path === '/online-store'
    );
  }
</script>



<!--
<template>
  <ul class="navbar-nav">
    <li class="nav-item dropdown py-2">
      <a class="nav-link dropdown-toggle fw-bold" to="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        HOME
      </a>
      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
        <li><router-link class="dropdown-item" to="/">ABOUT</router-link></li>
        <li><router-link class="dropdown-item" to="/">CONTACT</router-link></li>
      </ul>
    </li>
  </ul>
</template>

    <script>
  export default{
    data(){
      return{
        products:[], 
        session:this.$route.query.session
      }
    },
    mounted:{
        function () {
            jQuery(function ($) {
                $(".dropdown-toggle").click(function () {
                    var location = $(this).attr('href');
                    window.location.href = location;
                    return false;
                })
            })
        }
    }
  }
  </script>


-->
