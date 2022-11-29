<template v-for="product in products" :key="product.name">
  <article class="collaboration-article">
    <div class="container-fluid">
      <h2 class="text-center pt-4"> ONLINE STORE</h2>
      <p class="text-center">キャラクターコラボの「もにまるず 」も制作しています。</p>
      <div class="row">
        <template v-for="product in products" :key="product.name">
          <section class="col-lg-4 col-md-6 col-sm-12 mb-2">
            <router-link :to="`/commodity?name=${product.name}&img=${product.img1}&price=${product.price}`">
              <img :src=" '/img/'+ product.img1" class="about-img">
            </router-link>       
          </section>
        </template>
      </div>
    </div>
  </article>
</template>
<script>
    export default{
      data(){
        return{
          products:[],
        }
      },
      created(){
        this.axios.get('api/items').then(response => {
          this.products = response.data;
          });
      },
    }
  </script>
  <style scoped>
    img{
        height: 320px;
        width: 320px;
    }
  </style>