<template>
  <div class="container">
    <article class="text-center mb-3">
      <h2 class="mt-3">問い合わせ内容</h2>
      <section class="border py-3">
        <p class="px-2">返信希望：{{ contact.replyRequest }}</p>
        <p class="px-2">問い合わせ日時：{{ formattedContactTime }}</p>
        <p class="px-2">メールアドレス：{{ contact.email }}</p>
        <p class="px-2">件名：{{ contact.subject }}</p>
        <p class="px-2">内容：<br />{{ contact.content }}</p>
        <p class="px-2">対応状況：<br />{{ contact.admin_situation }}</p>

        <form @submit.prevent="submitSituationUpdate">
          <input type="hidden" :value="contact.id" name="id" />
          <label for="contactSituation">対応状況：</label>
          <select
            id="contactSituation"
            v-model="selectedSituation"
            class="inline-block"
          >
            <option value="" disabled>選択してください。</option>
            <option value="対応中">対応中</option>
            <option value="対応済み">対応済み</option>
            <option value="完了">完了</option>
          </select>
          <br />
          <button
            type="submit"
            class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-25"
          >
            対応状況変更
          </button>
        </form>
      </section>

      <router-link
        to="/admin/inquiryList"
        class="btn btn-primary d-inline-block btn-hover w-25 my-3"
      >
        お問い合わせ一覧へ
      </router-link>
    </article>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from 'axios'

const route = useRoute()
const router = useRouter()

const contact = ref({
  id: '',
  replyRequest: '',
  created_at: '',
  email: '',
  subject: '',
  content: '',
  admin_situation: ''
})

const selectedSituation = ref('')

// ダミーAPIまたはpropsの代わりに useRoute().query.id などで取得する想定
onMounted(async () => {
  try {
    const token = localStorage.getItem('token');
    if (!token) {
      console.error("認証トークンがありません！");
      return;
    }
    const response = await axios.post('/api/admin/Inquiry',
    { id : route.query.id},
    {
        headers: {
          Authorization: `Bearer ${token}`
        },
        withCredentials: true
    });
    contact.value = response.data
    console.log("response.data"+response.data);
  } catch (error) {
    console.error('データの取得に失敗しました', error)
  }
})

// 日付整形（+9時間）
const formattedContactTime = computed(() => {
  if (!contact.value.created_at) return ''
  const date = new Date(contact.value.created_at)
  date.setHours(date.getHours() + 9)
  return date.toLocaleString('ja-JP', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit'
  }).replace(/\//g, '年').replace('年', '年').replace('月', '月').replace('日', '日 ')
})

// 状況変更サブミット
const submitSituationUpdate = async () => {
  const token = localStorage.getItem('token');
  if (!token) {
    console.error("認証トークンがありません！");
    return;
  }
  try {
    await axios.post('/api/admin/situationUpdate', 
    {  
      id: contact.value.id,
      admin_situation: selectedSituation.value
    },
    {
      headers: {
        Authorization: `Bearer ${token}`
      },
      withCredentials: true
    });
    alert('対応状況を更新しました。')
    contact.value.admin_situation = selectedSituation.value
  } catch (error) {
    alert('更新に失敗しました。')
  }
}
</script>

<style scoped>
/* 必要に応じて Bootstrap または Tailwind 併用してください */
</style>
