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
                    <router-link 
                      :to="`/admin/product?id=${product.id}&name=${product.name}&img1=${product.img1}&price=${product.price}`" 
                      class="btn btn-primary btn-hover d-inline-block mr-l bttoon-right">
                      もっと見る
                    </router-link>
                </div>
              </div>          
            </div>   
          </section>  
        </template>          
      </div>
    </div>
  </article>      
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { useRouter } from 'vue-router';
import { useProductStore } from '../../stores/product.js';
import { useAuthStore } from '../../stores/auth.js';

const products = ref([]);
const authStore = useAuthStore(); // ✅ 意味が明確な変数名に変更
const router = useRouter();
const productStore = useProductStore();

// API から商品を取得
const fetchProducts = async () => {
  try {
    const response = await axios.get('/api/items');
    products.value = response.data;
  } catch (error) {
    console.error('API取得エラー:', error);
    products.value = [];
  }
};

onMounted(fetchProducts);
</script>

<style scoped>
.bttoon-right {
  margin-right: 15px;
}
</style>
