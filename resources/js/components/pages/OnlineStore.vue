<template v-for="product in products" :key="product.name">
  <article class="collaboration-article">
    <div class="container-fluid">
      <h2 class="text-center pt-4"> ONLINE STORE</h2>
      <p class="text-center">キャラクターコラボの「もにまるず 」も制作しています。</p>
      <div class="row">
        <template v-for="product in products" :key="product.name">
          <section class="col-lg-4 col-md-6 col-sm-12 mb-2">
            <template v-if="store.user !== null && store.isLoggedIn == true">
              <a @click="selectProductAndNavigate(product)" class="btn btn-primary btn-hover d-inline-block">
                <img :src=" '/img/'+ product.img1" class="about-img">
              </a>
            </template>
            <template v-else>
              <button v-on:click="buttonClicked" class="btn btn-hover d-inline-block">
                <img :src=" '/img/'+ product.img1" class="about-img">
              </button>
            </template>
          </section>
        </template>
      </div>
    </div>
  </article>
</template>
<script>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useProductStore } from '../../stores/product.js';
import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定

export default {
  setup() {
    const products = ref([]);
    const store = useAuthStore();
    const router = useRouter();
    const productStore = useProductStore();

    // 商品データを取得
    const fetchProducts = async () => {
      try {
        const response = await axios.get('/api/items');
        products.value = response.data;
      } catch (error) {
        console.error('API取得エラー:', error);
        products.value = []; // エラー時の対応
      }
    };

    // ログインを促すアラート
    const buttonClicked = () => {
      alert('商品を購入するにはユーザー登録またはログインの実施をよろしくお願いいたします。');
    };

    // 商品を選択して Store に保存し、ページ遷移
    const selectProductAndNavigate = (product) => {
      productStore.setProduct(product);
      router.push('/commodity'); // パラメータなしで遷移
    };

    onMounted(fetchProducts);

    return {
      products,
      store, // ✅ `store` を `return` に含める
      buttonClicked,
      selectProductAndNavigate
    };
  }
};
</script>
  <style scoped>
    img{
        height: 320px;
        width: 320px;
    }
  </style>