<template>
    <admin-user-header
        :user="user">
    </admin-user-header>
    <div class="container my-5">
        <section class="text-center">
            <h2 class="mb-4 fw-bold">{{user.name}}様のユーザー情報</h2>
            <div>
                <p>登録番号：{{user.id}}</p>
                <p>名前：{{user.name}}</p>
                <p>フリガナ：{{user.furigana}}</p>
                <p>電話番号：{{user.telephone}}</p>
                <p>メールアドレス：{{user.email}}</p>
                <p>郵便番号：{{user.zipCode}}</p>
                <p>都道府県：{{user.prefectures}}</p>
                <p>住所：{{user.address}}</p>
                <!--<p>パスワード：{{user-> password}}</p>-->
            </div>
        </section>
    </div>
</template>
<script setup>
    import { onMounted, ref } from 'vue'; // ✅ 必須
    import { useRouter,useRoute } from 'vue-router';
    import { useAdminStore } from '../../stores/admin.js';
    import axios from 'axios';
    const user = ref([]);
    const purchases = ref([]);
    const store = useAdminStore();
    const router = useRouter();
    const route = useRoute();
    const userId = route.query.id;
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
        console.log("parameterId:", userId);
        const response = await axios.post('/api/admin/user',
            { id: userId },// ✅ userId をリクエストボディに含める} // ← 空ボディ
            {
                headers: {
                Authorization: `Bearer ${token}`
                },
                withCredentials: true
            }
        );
            console.log('確認レスポンス:', response.data);
            console.log('ステータスコード:', response.status);
            user.value = response.data;
        } catch (error) {
            console.error('確認エラー:', error);
        }
    };
    onMounted(fetchData);
</script>