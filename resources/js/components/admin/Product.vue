<template>
  <article class="light_blue_background">
    <div class="container-fluid">
      <h2 class="py-4 text-center fw-bold d-block">
        {{ itemName }}
      </h2>

      <section class="text-center">
        <img :src="'/img/' + $route.query.img1" class="about-img" />
      </section>
      <p class="h5 pt-2">
        発売日：2021年7月　販売中<br />
        価格：{{ $route.query.price }}円<br />
        音楽を食べる生き物、宇宙ハムスターの「ブルーハムハム」と、手づくりのやわらかフィギュア「もにまるず」のコラボが登場！
      </p>

      <div class="d-flex justify-content-center pb-5">
        <button
          v-if="id"
          type="button"
          @click="goToEdit(id)"
          class="text-center btn btn-primary btn-hover me-5"
        >
          編集する
        </button>
        <button
          type="button"
          @click="goToList"
          class="text-center btn btn-primary btn-hover"
        >
          一覧に戻る
        </button>
      </div>
    </div>
  </article>
</template>

<script>
export default {
  data() {
    return {
      product: {},
      id: this.$route.query.id,
      itemName: this.$route.query.name,
      session: this.$route.query.session,
    };
  },
  created() {
    const itemName = this.itemName;
    this.axios
      .get(`api/item?name=${itemName}`)
      .then((response) => {
        this.product = response.data;
        console.log(response);
      })
      .catch((error) => {
        console.error('商品情報の取得に失敗しました', error);
      });
  },
  methods: {
    goToEdit(id) {
      this.$router.push(`/admin/productEdit?id=${id}`);
    },
    goToList() {
      this.$router.push('/admin/products');
    },
  },
};
</script>
