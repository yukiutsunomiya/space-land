<template>
  <div class="container my-5">
    <h3 class="mb-4">{{ store.user.name }} 様のユーザー情報</h3>
    <div>
      <!-- <p>登録番号：{{ user.id }}</p> -->
      <p>名前：{{ store.user.name }}</p>
      <p>フリガナ：{{ store.user.furigana }}</p>
      <p>電話番号：{{ store.user.telephone }}</p>
      <p>メールアドレス：{{ store.user.email }}</p>
      <p>郵便番号：{{ store.user.zipCode }}</p>
      <p>都道府県：{{ store.user.prefectures }}</p>
      <p>住所：{{ store.user.address }}</p>
      <!-- <p>パスワード：{{ user.password }}</p> -->
    </div>

    <!-- 編集ボタン（クエリパラメータ付き） -->
    <router-link
      :to="{
        path: '/userEdit',
      }"
      class="btn btn-primary d-inline-block m-4 btn-hover w-25"
    >
      ユーザー情報変更
    </router-link>

    <!-- 退会ボタン -->
    <button
      @click="userDelete"
      class="btn btn-primary d-inline-block m-4 btn-hover w-25"
    >
      退会
    </button>
  </div>
</template>

<script setup>
    import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
    import { useRouter } from 'vue-router';
    import axios from 'axios';
    const store = useAuthStore();
    const router = useRouter();
    const userDelete = async () => {
        try {
            const token = localStorage.getItem('token');
            if (!token) {
                console.error("認証トークンがありません！");
                return;
            }
            console.log("token:",token);
            console.log("ユーザー情報:", store.user);
            console.log("ユーザーID:", store.user?.id);
            await axios.post('/api/userDelete', 
               {
                  id: store.user.id  // ← ここで user ID を渡す
                },
                {
                headers: { 
                    Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
                },
                withCredentials: true, // ✅ Sanctum 認証では必須
            });
          router.push('/logout')
       } catch (error) {
        console.error('確認エラー:', error);
        if (error.response) {
          console.error('サーバー応答:', error.response.data);
        }
      }
    };
</script>
