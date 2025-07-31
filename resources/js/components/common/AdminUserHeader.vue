<template>
    <h2 class="mx-5 mt-5 mb-3">{{user.name}}様</h2>
    <nav class="navbar navbar-expand-md">
    <!-- ハンバーガーメニュー -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item py-2">
                    <router-link class="nav-link fw-bold" :to="{ path: '/admin/userEdit', query: { id: user.id } }">
                        ユーザー情報変更
                    </router-link>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item py-2">
                    <router-link class="nav-link fw-bold" :to="{ path: '/admin/userOrderHistory', query: { id: user.id } }">
                        購入履歴
                    </router-link>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item py-2">
                    <!--
                    <router-link class="nav-link fw-bold" to="/admin/userCart?id={{user.id}}&name={{user.name}}">カート確認確認</router-link>
                    -->
                    <router-link class="nav-link fw-bold" :to="{ path: '/admin/userCart', query: { id: user.id ,name : user.name} }">
                        カート確認確認
                    </router-link>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item py-2">
                    <!--
                     <router-link class="nav-link fw-bold" to="/admin/userInquiryList?id={{user.id}}&name={{user.name}}">お問い合わせ確認</router-link>
                    -->
                    <router-link class="nav-link fw-bold" :to="{ path: '/admin/userInquiryList', query: { id: user.id ,name : user.name} }">
                        お問い合わせ確認
                    </router-link>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item py-2">
                    <!--
                    <router-link class="nav-link fw-bold" to="/admin/userDelete?id={{user.id}}" onclick="return confirm('退会してよろしいでしょうか？')" >{{user.name}}様のユーザー削除</router-link>
                    -->
                    <router-link class="nav-link fw-bold" :to="{ path: '/admin/userDelete', query: { id: user.id } }" onclick="return confirm('退会してよろしいでしょうか？')" >{{user.name}}様のユーザー削除</router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>
<script setup>
defineProps({
  user: Array,
});
</script>