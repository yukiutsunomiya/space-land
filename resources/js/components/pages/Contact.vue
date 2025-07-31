<template>
    <article id="contact">
        <h2 class="text-center mt-4 mb-2">contact</h2>
        <p class="text-center">お問い合わせ・もにまるずの販売・​コラボ制作依頼は</p>
        <p class="text-center">メール・もしくは以下のフォームからご連絡ください。</p>
        <div class="button_wrapper">
            <section>
                <template v-if="store.user !== null && store.isLoggedIn == true">
                    <a :href="`/chat??${store.user?.name}`" class="btn btn-primary d-inline-block mb-5 btn-hover w-25 ">チャットで対応の方</a>
                </template>
                
                <form @submit.prevent="contactConfirm" method="get">
                    <!-- お名前 -->
                    <input
                        v-model="form.name"
                        name="name"
                        required
                        placeholder="お名前"
                        class="d-inline-block mb-3 w-25"
                    /><br>

                    <!-- メールアドレス -->
                    <input
                        v-model="form.email"
                        name="email"
                        required
                        placeholder="メールアドレス"
                        class="d-inline-block mb-3 w-25"
                    /><br>

                    <!-- 返信希望 -->
                    <div class="d-inline-block mb-3 w-25">
                        <label class="me-3">
                        <input
                            type="radio"
                            value="返信を希望"
                            v-model="form.replyRequest"
                            name="replyRequest"
                            required
                        />
                        返信を希望
                        </label>
                        <label>
                        <input
                            type="radio"
                            value="返信を希望しない"
                            v-model="form.replyRequest"
                            name="replyRequest"
                        />
                        返信を希望しない
                        </label>
                    </div><br>

                    <!-- 件名 -->
                    <input
                        v-model="form.subject"
                        name="subject"
                        required
                        placeholder="件名"
                        class="d-inline-block mb-4 w-25"
                    /><br>

                    <!-- 内容 -->
                    <textarea
                        v-model="form.content"
                        name="content"
                        required
                        placeholder="お問い合わせ内容"
                        class="d-inline-block mb-4 w-25"
                    ></textarea><br>

                    <!-- 送信ボタン -->
                    <button
                        type="submit"
                        @click="contactConfirm"
                        class="btn btn-primary d-inline-block mb-5 btn-hover w-25"
                    >
                        送信する
                    </button>
                </form>
            </section>
        </div> 
    </article>
</template>
<script setup>
    import { ref } from 'vue';
    import { useRouter ,useRoute } from 'vue-router';
    import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
    // 現在のルート情報を取得
    const router = useRouter();
    const route = useRoute();
    const store = useAuthStore();
    console.log("store確認します：",store);
    const form = ref({
        name: route.query.name || store.user?.name || '',
        email: route.query.email || store.user?.email || '',
        subject: route.query.subject || '',
        content: route.query.content || '',
        replyRequest: route.query.replyRequest || ''
    });
    const contactConfirm = () => {
        const { name, email, subject, content, replyRequest } = form.value;
        if (!name || !email || !subject || !content || !replyRequest) {
            alert('すべての項目を入力してください。');
            return;
        }
        router.push({
            path: '/contactConfirm',
            query: {
                ...form.value
            }
        });
    };
</script>