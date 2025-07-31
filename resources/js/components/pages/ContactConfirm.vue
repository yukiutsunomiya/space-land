<template>
  <article class="text-center">
    <h2 class="mt-3">内容確認</h2>
    <div>
      <form method="get" @submit.prevent="sendContact(actionType)">
        <p>名前：{{ form.name }}</p>
        <input name="name" :value="form.name" type="hidden" />

        <p>メールアドレス：{{ form.email }}</p>
        <input name="email" :value="form.email" type="hidden" />

        <p>返信希望：{{ form.replyRequest }}</p>
        <input name="replyRequest" :value="form.replyRequest" type="hidden" />

        <p>件名：{{ form.subject }}</p>
        <input name="subject" :value="form.subject" type="hidden" />

        <p>内容：{{ form.content }}</p>
        <input name="content" :value="form.content" type="hidden" />

        <input type="hidden" name="admin_situation" value="対応中" />

        <button
          type="submit"
          name="back"
           @click="sendContact('back')"
          class="btn btn-primary d-inline-block mb-3 btn-hover w-25"
        >
          入力内容修正
        </button>
        <br />
        <button
          type="submit"
          name="submit"
          @click="sendContact('submit')"
          class="btn btn-primary d-inline-block mb-4 btn-hover w-25"
        >
          送信する
        </button>
      </form>
    </div>
  </article>
</template>

<script setup>
import { useRoute ,useRouter } from 'vue-router';
import { ref } from 'vue';
import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
const route = useRoute();
const router = useRouter();
const store = useAuthStore();
const form = ref({
  name: route.query.name || '',
  email: route.query.email || '',
  replyRequest: route.query.replyRequest || '',
  subject: route.query.subject || '',
  content: route.query.content || ''
});

const sendContact = async (type) => {
  const params = {
    name: form.value.name, // ✅ `.value` を追加
    email: form.value.email,
    replyRequest: form.value.replyRequest,
    subject: form.value.subject,
    content: form.value.content,
    admin_situation: "対応中",
    user_id: store.user?.id || '',
    action: type
  };
  if(params.action ==='back'){
    router.push({
      path: '/contact',
      query: {
        ...form.value
      }
    });
  }else if(params.action ==='submit'){
    try {
      const response = await axios.get('/api/sendContact', {
        params // ✅ `params` をオブジェクトとして渡す
      });

      console.log('確認レスポンス:', response.data);
      console.log('ステータスコード:', response.status);
      router.push('/inquiryList');
    } catch (error) {
      console.error('確認エラー:', error);
    }
  }
};
</script>