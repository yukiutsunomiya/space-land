<template>
  <div class="container my-5">
    <h3 class="mb-4">{{ product.name }}の編集</h3>
    <form @submit.prevent="productUpdate">
      <input type="hidden" :value="product.id" name="id" />

      <p>名前：<input type="text" v-model="product.name" class="w-50" required /></p>
      <p>値段：<input type="number" v-model="product.price" class="w-50" required /></p>
      <p>メイン写真：<input type="text" v-model="product.img1" class="w-50" required /></p>
      <p>サブ写真：<input type="text" v-model="product.img2" class="w-50" /></p>
      <p>商品説明：<input type="text" v-model="product.description" class="w-50" required /></p>
      <p>商品発売年：<input type="text" v-model="product.releaseYear" class="w-50" /></p>
      <p>商品発売月：<input type="text" v-model="product.releaseMonth" class="w-50" /></p>
      <p>商品発売日：<input type="text" v-model="product.releaseDate" class="w-50" /></p>
      <p>商品状況：<input type="text" v-model="product.situation" class="w-50" /></p>
      <p>商品表示番号：<input type="text" v-model="product.order" class="w-50" /></p>

      <button type="submit" class="btn btn-primary d-inline-block mt-2 w-25">
        入力内容修正
      </button>
    </form>

    <router-link
      class="btn btn-secondary d-inline-block mt-3 w-25"
      :to="{ path: '/admin/product', query: { id: product.id } }"
    >
      {{ product.name }}の詳細へ戻る
    </router-link>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const product = ref({});
const route = useRoute();
const router = useRouter();
const productId = route.query.id;

const fetchData = async () => {
  try {
    const token = localStorage.getItem('token');
    if (!token) {
      console.error('認証トークンがありません');
      return;
    }

    const response = await axios.post('/api/admin/product', { id: productId }, {
      headers: { Authorization: `Bearer ${token}` },
      withCredentials: true,
    });

    product.value = response.data;
    console.log("response.data:"+response.data);
  } catch (error) {
    console.error('データ取得エラー:', error);
  }
};

onMounted(fetchData);

const productUpdate = async () => {
  try {
    const token = localStorage.getItem('token');
    if (!token) {
      console.error('認証トークンがありません');
      return;
    }

    const response = await axios.post('/api/admin/productUpdate', {
      id: product.value.id,
      name: product.value.name,
      price: product.value.price,
      img1: product.value.img1,
      img2: product.value.img2,
      description: product.value.description,
      releaseYear: product.value.releaseYear,
      releaseMonth: product.value.releaseMonth,
      releaseDate: product.value.releaseDate,
      situation: product.value.situation,
      order: product.value.order,
    }, {
      headers: { Authorization: `Bearer ${token}` },
      withCredentials: true,
    });

    // 保存完了後に戻る
    router.push({ path: '/admin/product', query: { id: productId } });
  } catch (error) {
    console.error('更新エラー:', error);
  }
};
</script>
