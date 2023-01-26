<template v-for="product in products" :key="product.name">
  <article class="collaboration-article">
    <div class="container-fluid">
      <h2 class="text-center pt-4"> ONLINE STORE</h2>
      <p class="text-center">キャラクターコラボの「もにまるず 」も制作しています。</p>
      <div class="row">
        <template v-for="product in products" :key="product.name">
          <section class="col-lg-4 col-md-6 col-sm-12 mb-2">
            <template v-if="session === 'user'">
              <a :href ="`/commodity?id=${product.id}&name=${product.name}&price=${product.price}&img1=${product.img1}&img2=${product.img2}`" >
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
    export default{
      data(){
        return{
          products:[],
          session:this.$route.query.session
        }
      },
      created(){
        this.axios.get('api/items').then(response => {
          this.products = response.data;
          });
      },
      methods:{
          buttonClicked(){
            window.alert('商品を購入するにはユーザー登録またはログインの実施をよろしくお願いいたします。');
        }
      }
    }
  </script>
  <style scoped>
    img{
        height: 320px;
        width: 320px;
    }
  </style>