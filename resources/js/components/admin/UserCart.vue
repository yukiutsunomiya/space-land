<template>
  <div class="container-fluid text-center">
    <admin-user-header
        :user="user">
    </admin-user-header>
    <h2 class="pt-1 my-4 fw-bold">
      {{ user.name }}様のカート
    </h2>

    <article class="row text-center">
      <section
        class="col-lg-4 col-md-6 border mb-4"
        v-for="cart in carts"
        :key="cart.id"
      >
        <p class="mt-3">商品名：{{ cart.name }}</p>
        <img :src="`/img/${cart.img1}`" class="d-block mx-auto img-fluid" />

        <p class="mt-2">
          値段：{{ cart.price }}円<br />
          個数：{{ cart.quantity }}個<br />
          合計金額：{{ cart.price * cart.quantity }}円
        </p>

        <!-- ボタンやアクションは必要に応じて実装してください -->
        <!--
        <button @click="deleteCart(cart.id)" class="btn btn-primary btn-hover d-inline-block mx-2 my-2">
          取り消し
        </button>

        <RouterLink
          :to="`/changeCart?id=${cart.id}&product_id=${cart.product_id}&name=${cart.name}&price=${cart.price}&img1=${cart.img1}&img2=${cart.img2}&quantity=${cart.quantity}`"
          class="btn btn-primary btn-hover d-inline-block mx-2 my-2"
        >
          個数を変更する
        </RouterLink>

        <button @click="purchase(cart)" class="btn btn-primary btn-hover d-inline-block mx-2 my-2">
          購入する
        </button>
        -->
      </section>
    </article>

    <!--
    <button @click="deleteAllCarts" class="btn btn-primary btn-hover d-inline-block mx-2 mb-4">
      すべてカート取り消し
    </button>
    -->
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue'; // ✅ 必須
    import { useRouter,useRoute } from 'vue-router';
    import { useAdminStore } from '../../stores/admin.js';
    import axios from 'axios';
    const user = ref([]);
    const carts = ref([]);
    const store = useAdminStore();
    const router = useRouter();
    const route = useRoute();
    user.value.id = route.query.id;
    user.value.name = route.query.name;
    const fetchData = async () => {
    try {
        const token = localStorage.getItem('token');
        if (!token) {
            console.error("認証トークンがありません！");
            return;
        }
        console.log("token:",token);
        console.log("ユーザー情報:", store.user);
        console.log("ユーザーID:", store.user?.id);
        const response = await axios.post('/api/admin/userCart',
            { id: user.value.id },// ✅ userId をリクエストボディに含める} // ← 空ボディ
            {
                headers: {
                Authorization: `Bearer ${token}`
                },
                withCredentials: true
            }
        );
            console.log('確認レスポンス:', response.data);
            console.log('ステータスコード:', response.status);
            carts.value = response.data;
        } catch (error) {
            console.error('確認エラー:', error);
        }
    };
    onMounted(fetchData);
</script>