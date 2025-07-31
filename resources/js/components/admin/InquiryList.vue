<template>
  <main>
    <div class="container">
      <article class="text-center mb-3">
        <h2 class="mt-3">問い合わせ一覧</h2>
        <router-link
          to="/admin/chatList"
          class="btn btn-primary d-inline-block btn-hover w-25 mb-3"
        >
          チャット一覧へ
        </router-link>

        <div
          v-for="contact in contacts"
          :key="contact.id"
          class="p-2 border border-dark hover btn-hover"
        >
          <router-link
            :to="`/admin/inquiry?id=${contact.id}`"
          >
            対応状況：{{ contact.admin_situation }}
            &emsp; 問い合わせ日時：{{ formatDate(contact.created_at) }}
            &emsp; 返信希望：{{ contact.replyRequest }}
            &emsp; ユーザー名：{{ contact.name }}
            &emsp; 件名：{{ contact.subject }}
            &emsp; メールアドレス：{{ contact.email }}
            &emsp; 対応状況：{{ contact.admin_situation }}
          </router-link>
        </div>
      </article>
    </div>
  </main>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import axios from 'axios'

const contacts = ref([])

onMounted(async () => {
  try {
    const token = localStorage.getItem('token');
    if (!token) {
      console.error("認証トークンがありません！");
      return;
    }
    const response = await axios.post('/api/admin/InquiryList',
    {},
    {
        headers: {
          Authorization: `Bearer ${token}`
        },
        withCredentials: true
    });
    contacts.value = response.data
    console.log("response.data"+response.data);
  } catch (error) {
    console.error('データの取得に失敗しました', error)
  }
})

function formatDate(datetime) {
  const date = new Date(datetime)
  date.setHours(date.getHours() + 9)
  return date.toLocaleString('ja-JP', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit'
  }).replace(/\//g, '年').replace('年', '年').replace('月', '月').replace('日', '日 ')
}
</script>

<style scoped>
.btn-hover:hover {
  opacity: 0.8;
  cursor: pointer;
}
</style>
