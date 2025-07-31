<template>
    <admin-user-header
        :user="user">
    </admin-user-header>
    <div class="container my-5">
        <h3 class="mb-4">{{user.name}}様のユーザー情報</h3>
        <div>
            <form @submit.prevent="userUpdate">
                <input type="hidden" :value="user.id" name="id" />
                <p>名前：<input type="text" v-model="user.name" name="name" class="w-50" required/></p>
                <p>フリガナ：<input type="text" v-model="user.furigana" name="furigana" class="w-50" required pattern="(?=.*?[\u30A1-\u30FC])[\u30A1-\u30FC\s]*"/></p>
                <p>電話番号：<input type="tel" v-model="user.telephone" name="telephone" class="w-50" required  pattern="0\d{9,10}" title="電話番号は10〜11桁の数字で入力してください（例：09012345678）"/></p>
                <p>メールアドレス：<input type="email" v-model="user.email" name="email" class="w-50" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="正しいメールアドレス形式で入力してください（例: user@example.com）"/></p>
                <p>郵便番号：<input type="text" v-model="user.zipCode" name="zipCode" class="w-50" required pattern="\d{3}-?\d{4}" title="郵便番号は7桁の数字（例：123-4567または1234567）で入力してください"/></p>

                <p class ="">
                都道府県：
                <select v-model="user.prefectures" name="prefectures" required class="form-control w-50 ">
                    <option disabled value="">都道府県</option>
                    <option v-for="pref in prefectures" :key="pref" :value="pref">
                    {{ pref }}
                    </option>
                </select>
                </p>

                <p>住所：<input type="text" v-model="user.address" name="address" class="w-50" /></p>

                <button type="submit" class="btn btn-primary d-inline-block mt-2 btn-hover w-25">
                    入力内容修正
                </button>
            </form>
            <router-link class="btn btn-primary d-inline-block mt-3 btn-hover w-25" :to="{ path: '/admin/user', query: { id: user.id } }">{{user.name}}様のユーザー情報へ戻る</router-link>
        </div>
    </div>
</template>
<script setup>
    import { onMounted, ref } from 'vue'; // ✅ 必須
    import { useRouter,useRoute } from 'vue-router';
    import { useAdminStore } from '../../stores/admin.js';
    import axios from 'axios';
    const user = ref([]);
    const store = useAdminStore();
    const router = useRouter();
    const route = useRoute();
    const userId = route.query.id;
    const prefectures = [
        "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県",
        "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
        "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県", "岐阜県",
        "静岡県", "愛知県", "三重県", "滋賀県", "京都府", "大阪府", "兵庫県", 
        "奈良県", "和歌山県", "鳥取県", "島根県", "岡山県", "広島県", "山口県", 
        "徳島県", "香川県", "愛媛県", "高知県", "福岡県", "佐賀県", "長崎県", 
        "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
    ]
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
        console.log("userId:", userId);
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
    const userUpdate = async () => {
    try {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error("認証トークンがありません！");
            return;
        }
        console.log("token:",token);
        console.log("ユーザー情報:", store.user);
        console.log("ユーザーID:", store.user?.id);
        console.log("userId:", userId);
        const response = await axios.post('/api/admin/userUpdate',
            {
                id: user.value.id,
                name: user.value.name,
                furigana: user.value.furigana,
                telephone: user.value.telephone,
                email: user.value.email,
                zipCode: user.value.zipCode,
                prefectures: user.value.prefectures,
                address: user.value.address,
            },
            {
                headers: {
                Authorization: `Bearer ${token}`
                },
                withCredentials: true
            }
        );
            console.log('確認レスポンス:', response.data);
            console.log('ステータスコード:', response.status);
            router.push({
                path: '/admin/user',
                query: { id: userId }
            });

        } catch (error) {
            console.error('確認エラー:', error);
        }
    };
</script>