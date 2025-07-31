<template>
  <!-- トップスライド -->
  <article class="light_blue_background pb-4">
    <div class="container-fluid">
      <h2 class="text-center pt-4">ITEMS</h2>
      <p class="text-center">キャラクターコラボの「もにまるず 」も制作しています。</p>
      <div class="row">
        <template v-for="product in products" :key="product.name">
          <section class="about-section mt-4 mx-auto">
            <div class="row justify-content-center">
              <div class="col-lg-5 text-left col-margin-0">
                <img :src="'/img/' + product.img1" class="about-img">
              </div>
              <div class="col-lg-7 about-box col-margin-0 bg-white p-3">
                <h4 class="text-center">{{ product.name }}</h4>
                <p class="text-center">価格：{{ product.price }}円</p>
                <div class="text-center pt-2">
                  <template v-if="store.user !== null && store.isLoggedIn == true">
                    <router-link 
                      :to="`/item?session=user&name=${product.name}&img1=${product.img1}&price=${product.price}`" 
                      class="btn btn-primary btn-hover d-inline-block mr-l bttoon-right">
                      もっと見る
                    </router-link>
                  </template>
                  <template v-else>
                    <router-link 
                      :to="`/item?name=${product.name}&img1=${product.img1}&price=${product.price}`" 
                      class="btn btn-primary btn-hover d-inline-block mr-l bttoon-right">
                      もっと見る
                    </router-link>
                  </template>
                  <template v-if="store.user !== null && store.isLoggedIn == true">
                    <button @click="selectProductAndNavigate(product)" class="btn btn-primary btn-hover d-inline-block">
                      購入する      
                    </button>
                  </template>
                  <template v-else>
                    <button @click="buttonClicked" class="btn btn-primary btn-hover d-inline-block">
                      商品購入方法
                    </button>
                  </template>
                </div>
              </div>          
            </div>   
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
    const store = useAuthStore(); // ✅ 変数名を `authStore` に変更
    const router = useRouter();
    const productStore = useProductStore();

    // API から商品を取得
    const fetchProducts = async () => {
      try {
        const response = await axios.get('/api/items'); // ✅ 修正: `/` を追加
        products.value = response.data;
      } catch (error) {
        console.error('API取得エラー:', error);
        products.value = []; // ✅ 修正: エラー時にデータをクリア
      }
    };

    // アラートメッセージの表示
    const buttonClicked = () => {
      alert('商品を購入するにはユーザー登録またはログインの実施をよろしくお願いいたします。');
    };

    // 商品を選択して Store に保存し、ページ遷移
    const selectProductAndNavigate = (product) => {
      if (!product) return; // ✅ 修正: `product` が `undefined` なら処理しない
      productStore.setProduct(product);
      router.push('/commodity');
    };

    onMounted(fetchProducts); // ✅ 修正: `onMounted(productStore)` → `onMounted(fetchProducts)`

    return {
      products,
      store, // ✅ `store` → `authStore`
      buttonClicked,
      selectProductAndNavigate
    };
  }
};
</script>

<style scoped>
.bttoon-right {
  margin-right: 15px;
}
</style>


<style scoped>
.bttoon-right {
  margin-right: 15px;
}
</style>