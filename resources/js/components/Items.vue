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
              <div class="col-md-5 text-left col-margin-0 ">
                <img :src=" '/img/'+ product.img1" class="about-img">
              </div>
              <div class="col-md-7 about-box col-margin-0 bg-white p-3">
                <h4 class="text-center">{{product.name}}</h4>
                <p class="text-center">
                <br><br>
                {{product.price}}円
                </p>
                <div class="text-center pt-2">
                  <router-link :to="`/item?name=${product.name}&img1=${product.img1}&price=${product.price}`"  class="btn btn-primary btn-hover d-inline-block mr-l bttoon-right">もっと見る</router-link>
                  <template v-if="session === 'user'">
                    <a :href ="`/commodity?id=${product.id}&name=${product.name}&price=${product.price}&img1=${product.img1}&img2=${product.img2}`" class="btn btn-primary btn-hover d-inline-block">購入する</a>
                  </template>
                  <template v-else>
                    <button v-on:click="buttonClicked" class="btn btn-primary btn-hover d-inline-block">商品購入方法</button>
                  </template>
                  
                  <!--
                    <a :href ="`/commodity?id=${product.id}&name=${product.name}&price=${product.price}&img1=${product.img1}&img2=${product.img2}`" class="btn btn-primary btn-hover d-inline-block">購入する</a>
                  -->
                  <!--
                    
                    <router-link :to="`/commodity?name=${product.name}&img=${product.img1}&price=${product.price}`" class="btn btn-primary btn-hover d-inline-block">購入する</router-link>
                    <template>
                      <div class="post">
                        <h1>This is an Post page</h1>
                        <div v-for="post in posts" :key="post.id">
                            <router-link :to="`/post/${post.id}`">
                            {{ post.title }}
                            </router-link>
                          </div>
                      </div>
                    </template>
                  -->
                  <!--
                    <button type="button" onclick="location.href='../item1'" class="btn btn-primary btn-hover d-inline-block mr-l bttoon-right">もっと見る</button> 
                  -->
                  <!--
                    <button type="button" onclick="location.href='../commodity1'" class="btn btn-primary btn-hover d-inline-block">購入する</button> 
                  -->
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

        console.log(this.$route.query.session);
    },
    methods:{
        buttonClicked(){
          window.alert('商品を購入するにはユーザー登録またはログインの実施をよろしくお願いいたします。');
      }
    }
  }

</script>
<style scoped> 
.bttoon-right{
  margin-right: 15px;
  }
</style>