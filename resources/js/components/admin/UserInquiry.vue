<template>
  <main>
    <div class="container">
      <article class="text-center mb-3">
        <h2 class="mt-3">{{ user.name }}様の問い合わせ内容</h2>

        <section class="border py-3">
          <p class="px-2">返信希望：{{ contact.replyRequest }}</p>
          <p class="px-2">件名：{{ contact.subject }}</p>
          <p class="px-2">メールアドレス：{{ contact.email }}</p>
          <p class="px-2">内容：<br />{{ contact.content }}</p>
          <p class="px-2">お問い合わせ日時：<br />{{ contact.created_at }}</p>
          <p class="px-2">対応状況：<br />{{ contact.admin_situation }}</p>

          <!-- 対応状況フォーム -->
          <form @submit.prevent="situationUpdate">
            <label for="contactSituation">対応状況：</label>
            <select
              id="contactSituation"
              v-model="contact.situation"
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

        <!-- 問い合わせ一覧へ戻る -->
        <RouterLink
          :to="`/admin/userInquiryList?id=${user.id}&name=${user.name}`"
          class="btn btn-primary d-inline-block btn-hover w-25 my-3"
        >
          {{ user.name }}様のお問い合わせ一覧へ
        </RouterLink>
      </article>
    </div>
  </main>
</template>
<script setup>
import { ref,onMounted } from 'vue'
import { useRoute } from 'vue-router'
import { useAdminStore } from '../../stores/admin.js';
const store = useAdminStore();
const user = ref([]);
const contact = ref([]);
// クエリパラメータから取得
const route = useRoute();
user.value.id = route.query.user_id;
user.value.name = route.query.name;
contact.value.id = route.query.id;

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
        console.log("contact.value.id:", contact.value.id);
        console.log("user.value.name:", user.value.name);
        console.log("user.value.id:", user.value.user_id);
        const response = await axios.post('/api/admin/userInquiry',
            { id: contact.value.id },// ✅ userId をリクエストボディに含める} // ← 空ボディ
            {
                headers: {
                Authorization: `Bearer ${token}`
                },
                withCredentials: true
            }
        );
        console.log('確認レスポンス:', response.data);
        console.log('ステータスコード:', response.status);
        const fetchedContact = response.data;
          contact.value = {
          ...fetchedContact,
          shipDraft: fetchedContact.situation
        };
    } catch (error) {
        console.error('確認エラー:', error);
    }
};
onMounted(fetchData);
const situationUpdate = async () => {
    try {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error("認証トークンがありません！");
            return;
        }
        console.log("token:",token);
        console.log("ユーザー情報:", store.user);
        console.log("ユーザーID:", store.user?.id);
        console.log("contact.value.id:", contact.value.id);
        console.log("user.value.name:", user.value.name);
        console.log("user.value.id:", contact.value.situation);
        await axios.post('/api/admin/situationUpdate',
            { id: contact.value.id , admin_situation :contact.value.situation },// ✅ userId をリクエストボディに含める} // ← 空ボディ
            {
                headers: {
                Authorization: `Bearer ${token}`
                },
                withCredentials: true
            }
        );
        contact.value.admin_situation = contact.value.situation;
    } catch (error) {
        console.error('確認エラー:', error);
    }
};
</script>