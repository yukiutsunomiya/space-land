<template>
    <div class="container my-5">
        <h3>ユーザー情報</h3>
        <template v-for="user in users" :key="user.id">
          <div class="p-2 border border-dark hover btn-hover">
            <button @click="userFind(user.id)" class = "btn bg-transparent border-0">番号：{{user.id}} &emsp; 名前：{{user.name}} &emsp; メールアドレス：{{user.email}} &emsp; 電話番号：{{user.telephone}} </button><br>
          </div>
        </template>
    </div>
</template>
<script setup>
    import { useAdminStore } from '../../stores/admin.js'; // ストアの正しいパスを指定
    import { onMounted, ref } from 'vue';
    import { useRouter } from 'vue-router';
    import axios from 'axios';
    const users = ref([]); // ✅ `ref([])`
    const store = useAdminStore();
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
            const response = await axios.post('/api/admin/users',{}, // ← 空ボディ
            {
                headers: {
                Authorization: `Bearer ${token}`
                },
                withCredentials: true
            }
            );
            console.log('確認レスポンス:', response.data);
            console.log('ステータスコード:', response.status);
            users.value = response.data;
            console.log("response.data:"+response.data);
            console.log("users.value:"+users.value);
        } catch (error) {
            console.error('確認エラー:', error);
        }
    };
    onMounted(fetchData);
    
    const userFind = (userId) => {
        router.push({
            path: '/admin/user',
            query: {
                id : userId
            }
        });
    };
</script>
