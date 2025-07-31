<template>
    <div class="container-fluid text-center">
        <h2 class="pt-1 my-4 fw-bold">
            商品個数変更
        </h2>
        <h3 class="pt-1 mb-4 fw-bold update-information-h3">
            商品名：{{cartItem.name}}
        </h3>
        <p class="fw-bold">値段：{{cartItem.price}}円</p>
        <section class="text-center">
            <img :src="'/img/'+ cartItem.img1" class="about-img">
            <div class="py-4  mx-ax">
                <form @submit.prevent="updateCart(actionType)" method="get">
                    <dl class="contact7">
                        <dt>個数<span class="must">必須</span></dt>
                        <dd>
                            <select name="quantity" v-model="selectValue" required>
                                <option value="選択してください。" selected hidden>選択してください。</option>
                                <option value="1">１</option>
                                <option value="2">２</option>
                                <option value="3">３</option>
                                <option value="4">４</option>
                                <option value="5">５</option>
                            </select>
                        </dd>
                    </dl>
                    <!--
                    <input type="hidden" name="id" :value="cartItem.id">
                    <input type="hidden" name="product_id" :value="cartItem.product_id">
                    <input type="hidden" name="name" :value="cartItem.name">
                    <input type="hidden" name="price" :value="cartItem.price">
                    <input type="hidden" name="img1" :value="cartItem.img1">
                    <input type="hidden" name="img2" :value="cartItem.img2">
                    -->
                   
                    <p>合計請求額：{{ purchasePrice }}
                    </p>
                    <button type="submit" @click="updateCart('cart')" class="btn btn-primary btn-hover d-inline-block mx-4">カートに再度入れる</button>
                    <button type="submit" @click="updateCart('purchase')"  onclick="return confirm('商品の購入でよろしいでしょうか？')"  class="btn btn-primary btn-hover d-inline-block mx-4">購入する</button>
                </form>
            </div>
        </section>
    </div>
</template>
<script setup>
    import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
    import {  ref , computed } from 'vue';
    import { useRouter ,useRoute } from 'vue-router';
    import axios from 'axios';
    const store = useAuthStore();
    const router = useRouter();
    const route = useRoute();
    const selectValue = ref(''); // ✅ 初期値
    // `route.query` からデータを取得
   const cartItem = ref({
        id: route.query.id || '',
        name: route.query.name || '',
        price: parseInt(route.query.price) || 0,
        img1: route.query.img1 || '',
        img2: route.query.img2 || '',
        quantity: route.query.quantity || '1'
    });
    const purchasePrice = computed(() => {
        const quantity = parseInt(selectValue.value);
        return isNaN(quantity) ? 0 : cartItem.value.price * quantity;
    });
    const updateCart = async (type) => {
        const params = {
            id: route.query.id,
            product_id: route.query.id,
            name: route.query.name,
            price: route.query.price,
            img1: route.query.img1,
            img2: route.query.img2,
            quantity: selectValue.value,
            user_id: store.user?.id,
            action: type
        };
        try {
            const token = localStorage.getItem('token');
            if (!token) {
                console.error("認証トークンがありません！");
                return;
            }
            const response = await axios.get('/api/updateCart', {
                headers: { 
                    Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
                },
                withCredentials: true, // ✅ Sanctum 認証では必須
                params
            });
            console.log('確認レスポンス:', response.data);
            console.log('ステータスコード:', response.status);
            if (params.action === "cart") {
                console.log("カートに追加処理");
                router.push('/carts');
            } else if (params.action === "purchase") {
                console.log("購入処理");
                router.push('/purchases');
            } else {
                console.error("未定義のアクションです:", params.action);
            }
        } catch (error) {
            console.error('確認エラー:', error);
        }
    };
</script>