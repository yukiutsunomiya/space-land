<template>
    <section class="py-4 text-center mx-ax">
        <form  @submit.prevent="confirm(actionType)" method="get">
            <dl class="contact7">
                <dt>個数<span class="must">必須</span></dt>
                <dd>
                    <select name="quantity" v-model="selectValue" required>
                        <option value="1">１</option>
                        <option value="2">２</option>
                        <option value="3">３</option>
                        <option value="4">４</option>
                        <option value="5">５</option>
                    </select>
                </dd>
            </dl>
            <!--
            <input type = "text" name="product_id" :value= "props.product.id" class="d-none">
            <input type = "text" name="name" :value= "props.product.name" class="d-none">
            <input type = "text" name="price" :value= "props.product.price" class="d-none">
            <input type = "text" name="img1" :value= "props.product.img1" class="d-none">
            <input type = "text" name="img2" :value= "props.product.img2" class="d-none">
            <input type = "text" name="ship" value= "未発送" class="d-none">
            -->
            <p>合計請求額：
                <template v-if="selectValue === '1'" name="purchasePrice" value = "props.product.price">{{props.product.price}}円</template>
                <template v-if="selectValue === '2'" name="purchasePrice" value = "props.product.price">{{props.product.price * 2}}円</template>
                <template v-if="selectValue === '3'" name="purchasePrice" value = "props.product.price">{{props.product.price * 3}}円</template>
                <template v-if="selectValue === '4'" name="purchasePrice" value = "props.product.price">{{props.product.price * 4}}円</template>
                <template v-if="selectValue === '5'" name="purchasePrice" value = "props.product.price">{{props.product.price * 5}}円</template>
            </p>
            <button type="submit" @click="confirm('cart')" class="btn btn-primary btn-hover d-inline-block mx-4">カートに入れる</button>
            <button type="submit" @click="confirm('purchase')" onclick="return confirm('商品の購入でよろしいでしょうか？')"  class="btn btn-primary btn-hover d-inline-block mx-4">購入する</button>
        </form>
    </section>
</template>
<script setup>
import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
const store = useAuthStore();
const router = useRouter();
const props = defineProps({
    product: Object,
});
const selectValue = ref('');

// `/confirm` に GET でリクエスト
const confirm = async (type) => {
    const params = {  
        product_id: props.product.id,
        name: props.product.name,
        price: props.product.price,
        img1: props.product.img1,
        img2: props.product.img2,
        ship: "未発送",
        quantity: selectValue.value,
        user_id: store.user?.id,
        action: type
    };
    console.log("action:", params.action);
    try {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error("認証トークンがありません！");
            return;
        }
        console.log("token:",token);
        console.log("ユーザー情報:", store.user);
        console.log("ユーザーID:", store.user?.id);

        const response = await axios.get('/api/confirm', {
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