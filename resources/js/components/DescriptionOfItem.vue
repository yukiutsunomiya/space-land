<template >
  <article class="light_blue_background">
    <div class="container-fluid">
      <h2 class="py-4 text-center fw-bold d-block">
          {{this.$route.query.name}}
        </h2>
        <section class="text-center">
          <img :src="/img/ + this.$route.query.img1" class="about-img">
        </section>
        <p class="h5 pt-2">
          発売日：2021年7月　販売中<br>
          価格：{{this.$route.query.price}}円<br>
          音楽を食べる生き物、宇宙ハムスターの「ブルーハムハム」と、手づくりのやわらかフィギュア「もにまるず」のコラボが登場！
        </p>

        <div class="text-center pt-3 py-4">
          <template v-if="session === 'user'">
            <button type="button" onclick="location.href='../items?session=user'" class="btn btn-primary btn-hover">一覧に戻る</button> 
          </template>
          
          <template v-else>
            <button type="button" onclick="location.href='../items'" class="btn btn-primary btn-hover">一覧に戻る</button> 
          </template>
        </div>  
    </div> 
  </article>
</template>
<script>
  export default{
    data(){
      return{
        product:[],
        itemName : this.$route.query.name,
        session : this.$route.query.session
      }
    },
    created(){
      this.axios.get('api/item?name=${itemName}').then(response => {
        this.product = response.data;
        console.log(response);
        });
    },
  }
</script>