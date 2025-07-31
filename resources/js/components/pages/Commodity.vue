<template>
  <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
      商品購入
    </h2>
    <h3 class="pt-1 mb-4 fw-bold update-information-h3">
      商品名：{{ product?.name || '未選択' }}
    </h3>
    <p class="fw-bold">値段：{{ product?.price || '未定' }}円</p>
    <section class="text-center">
      <img :src="'/img/' + (product?.img1 || 'placeholder.jpg')" class="about-img">
    </section>
    <comodity-select :product="product"></comodity-select>
  </div>
</template>

<script>
  import { ref } from 'vue';
  import { useProductStore } from '../../stores/product.js';

  export default {
    setup() {
      const productStore = useProductStore();
      const product = ref(productStore.selectedProduct || {}); // ✅ `null` を考慮

      console.log(product.value); // ✅ 商品データを出力

      return {
        product
      };
    }
  };
</script>
