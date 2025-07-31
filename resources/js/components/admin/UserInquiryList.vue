<template>
    <admin-user-header
        :user="user">
    </admin-user-header>
  <div class="container">
    <article class="text-center mb-3">
      <!-- 戻るボタン -->
      

      <!-- タイトル -->
      <h2 class="mt-3">{{ user.name }}様の問い合わせ一覧</h2>

      <!-- チャットリンク -->
      <button class="btn btn-primary d-inline-block btn-hover w-25 mb-3">
        {{ user.name }}様のチャット
      </button>

      <!-- 問い合わせ一覧 -->
      <div
        v-for="contact in contacts"
        :key="contact.id"
        class="p-2 border border-dark hover btn-hover"
      >
        <RouterLink
          :to="`/admin/userInquiry?id=${contact.id}&user_id=${user.id}&name=${user.name}`"
        >
          対応状況：{{ contact.admin_situation }} &emsp;
          問い合わせ日時：{{ formatDate(contact.created_at) }} &emsp;
          返信希望：{{ contact.replyRequest }} &emsp;
          件名：{{ contact.content }} &emsp;
          メールアドレス：{{ contact.email }}
        </RouterLink>
      </div>
    </article>
  </div>
</template>

<script setup>
import { ref,onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useAdminStore } from '../../stores/admin.js';
const store = useAdminStore();
const user = ref([]);
// クエリパラメータから取得
const route = useRoute();
user.value.id = route.query.id ?? ''
user.value.name = route.query.name ?? 'ユーザー'

// 仮の問い合わせデータ
const contacts = ref([
  {},
  // 必要ならさらに追加
])

// 日時を整形（+9時間）
function formatDate(datetimeStr) {
  const date = new Date(datetimeStr)
  date.setHours(date.getHours() + 9)
  return date.toLocaleString('ja-JP', {
    year: 'numeric',
    month: '2-digit',
    day: '2-digit',
    hour: '2-digit',
    hour12: false,
  }).replace(' ', ' ').replace(':00', '時')
}
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
        const response = await axios.post('/api/admin/userInquiryList',
            { id: user.value.id },// ✅ userId をリクエストボディに含める} // ← 空ボディ
            {
                headers: {
                Authorization: `Bearer ${token}`
                },
                withCredentials: true
            }
        );
        console.log('確認レスポンス:', response.data);
        console.log('ステータスコード:', response.status);
        contacts.value = response.data;
    } catch (error) {
        console.error('確認エラー:', error);
    }
};
onMounted(fetchData);

</script>