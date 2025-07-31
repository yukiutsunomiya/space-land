<template>
  <div class="container">
    <article class="text-center mb-3">
      <h2 class="mt-3">問い合わせ一覧</h2>
      <a class="btn btn-primary d-inline-block btn-hover w-25 mb-3">チャット</a>
        <template v-for="contact in contacts" :key="contact.id">
          <div class="p-2 border border-dark hover btn-hover">
            <button @click="inquiry(contact.id)" class = "btn bg-transparent border-0">返信希望：{{contact.replyRequest}}&emsp; 問い合わせ日時：{{formatPurchaseTime(contact.created_at)}} &emsp; 件名：{{contact.content}} &emsp; メールアドレス：{{contact.email}} </button><br>
          </div>
        </template>
      </article>
    </div>
</template>
<script setup>
  import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
  import { onMounted, ref } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  const contacts = ref([]); // ✅ `ref([])`
  const store = useAuthStore();
  const router = useRouter();
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
    const response = await axios.get('/api/inquiryList', {
      headers: { 
        Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
      },
      withCredentials: true, // ✅ Sanctum 認証では必須
      });
      console.log('確認レスポンス:', response.data);
      console.log('ステータスコード:', response.status);
      contacts.value = response.data;
      console.log("response.data:"+response.data);
      console.log("contacts.value:"+contacts.value);
    } catch (error) {
      console.error('確認エラー:', error);
    }
  };
  onMounted(fetchData);
  const formatPurchaseTime = (createdAt) => {
    const date = new Date(createdAt);
    date.setHours(date.getHours() ); 
    return `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日 ${date.getHours()}時`;
  };
  const inquiry = (contactId) => {
    router.push({
      path: '/inquiry',
      query: {
        contact_id: contactId // ✅ contact.id のみを渡す
      }
    });
  };
</script>
