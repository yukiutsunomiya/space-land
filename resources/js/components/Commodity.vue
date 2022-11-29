<template v-for="product in products" :key="product.name">
    <div class="container"> 
      <h2 class="pt-1 my-4 fw-bold">
        商品購入
      </h2>
      <h3 class="pt-1 mb-4 fw-bold update-information-h3">
        商品名：{{this.$route.query.name}}
      </h3>
      <p class="fw-bold">値段：{{this.$route.query.price}}円</p>
      <section class="text-center">
        <img :src="/img/ + this.$route.query.img" class="about-img">
      </section>
      <section class="pt-4 text-center">  
        <dl class="contact7">
          <dt>個数<span class="must">必須</span></dt>
          <dd>
            <select name="quantity" required>
              <option value="" selected>個数</option>
              <option value="one">１</option>
              <option value="two">２</option>
              <option value="three">３</option>
              <option value="four">４</option>
              <option value="five">５</option>
            </select>
          </dd>

          <dd>[textarea your-message]</dd>
        </dl>
        <p class="btn_contact7">[submit "この内容で送信する"]</p>
        
      </section>
    </div> 
</template>
<script>
  export default{
    data(){
      return{
        product:[],
      }
    },
    created(){
      this.axios.get('api/commodity?name=${this.$route.query.name}').then(response => {
        this.product = response.data;
        });
    },
  }
</script>
     
