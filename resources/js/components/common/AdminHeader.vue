<template>
    <header>
        <div class="container">
          <h2 class="fw-bold text-center mb-0 mt-2">Space Land</h2>
          <p class="fw-bold text-center my-3 ">（株）総合研究舎</p>
          <template v-if="store.user !== null && store.isLoggedIn == true">
            <p class="fw-bold">管理者ログインユーザー名：{{ store.user.name }}</p>
          </template>
          <nav class="navbar navbar-expand-md">
            <!-- ハンバーガーメニュー -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
                <template v-if="store.user !== null && store.isLoggedIn == true">
                    <ul class="navbar-nav">
                    <li class="nav-item py-2">
                      <router-link class="nav-link fw-bold" to="/admin/users">お客様情報一覧</router-link>
                    </li>
                  </ul>
                  <ul class="navbar-nav">
                    <li class="nav-item py-2">
                      <router-link class="nav-link fw-bold" to="/admin/orderHistory">注文履歴</router-link>
                    </li>
                  </ul>
                  <ul class="navbar-nav">
                    <li class="nav-item py-2">
                      <router-link class="nav-link fw-bold" to="/admin/inquiryList">お問い合わせ一覧</router-link>
                    </li>
                  </ul>
                  <ul class="navbar-nav">
                    <li class="nav-item dropdown py-2">
                      <router-link class="nav-link dropdown-toggle fw-bold" to="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        商品関連
                      </router-link>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><router-link class="dropdown-item" to="/admin/productRegistration">商品登録</router-link></li>
                        <li><router-link class="dropdown-item" to="/admin/products">商品情報一覧</router-link></li>
                        <li><router-link class="dropdown-item" to="/admin/productOrderChange">商品順番変更</router-link></li>
                      </ul>
                    </li>
                  </ul>
                  <ul class="navbar-nav">
                    <li class="nav-item py-2">
                      <router-link to="/admin/logout" 
                         class="nav-link fw-bold">
                        管理者ログアウト
                      </router-link>
                    </li>
                  </ul>
                </template>
                <template v-else>
                    <ul class="navbar-nav">
                        <li class="nav-item py-2">
                            <router-link to="/" class="nav-link fw-bold">Space Landトップページ</router-link>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item py-2">
                            <router-link to="/admin/login" class="nav-link fw-bold">管理者ログイン</router-link>
                        </li>
                    </ul>
                    <template v-if="route.path === '/admin/register'">
                        <ul class="navbar-nav">
                            <li class="nav-item py-2">
                                <router-link to="/admin/register" class="nav-link fw-bold">管理者登録</router-link>
                            </li>
                        </ul>
                    </template>
                </template>  
            </div>
          </nav>
        </div>
    </header>
</template>
<script setup>
  import { useRoute } from 'vue-router';
  import { useAdminStore } from '../../stores/admin.js'; // ストアの正しいパスを指定
  // 現在のルート情報を取得
  const route = useRoute();
  const store = useAdminStore();
  console.log("store確認します：",store);
  // 特定のパスと一致しているかを判定
</script>