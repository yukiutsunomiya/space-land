<!--

-->
<template>
  <div class="container">
    <article class="text-center mb-3">
      <h2 class="mt-3">問い合わせ内容</h2>

      <section class="border pt-3">
        <p class="px-2">返信希望：{{ contact.replyRequest }}</p>
        <p class="px-2">問い合わせ日時：{{ contactTime }}</p>
        <p class="px-2">メールアドレス：{{ contact.email }}</p>
        <p class="px-2">件名：{{ contact.subject }}</p>
        <p class="px-2">内容：<br>{{ contact.content }}</p>
      </section>

      <router-link
        to="/inquiryList"
        class="btn btn-primary d-inline-block btn-hover w-25 my-3"
      >
        お問い合わせ一覧へ
      </router-link>
    </article>
  </div>
</template>
<script setup>
    import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
    import { onMounted, ref } from 'vue';
    import { useRoute } from 'vue-router';
    import axios from 'axios';
    const contact = ref([]); // ✅ `ref([])`
    const store = useAuthStore();
    const route = useRoute();
    const contactId = route.query.contact_id;
    const params = {
        id: contactId
    };
    const fetchData = async () => {
        try {
            const token = localStorage.getItem('token');
            if (!token) {
                console.error("認証トークンがありません！");
                return;
            }
            console.log("token:",token);
            console.log("ユーザー情報:", store.user);
            console.log("ユーザーID:", store.user?.id);

            const response = await axios.get('/api/inquiry', {
                headers: { 
                    Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
                },
                withCredentials: true, // ✅ Sanctum 認証では必須
                params
            });
            console.log('確認レスポンス:', response.data);
            console.log('ステータスコード:', response.status);
            contact.value = response.data;
            console.log("response.data:"+response.data);
            console.log("contact.value:"+contact.value);
        } catch (error) {
            console.error('確認エラー:', error);
        }
    };
    onMounted(fetchData);
</script>
