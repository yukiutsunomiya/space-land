<template>
    <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
      {{ store.user.name }}様の購入履歴
    </h2>
    <article class="row text-center">
        <template v-for="purchase in purchases" :key="purchase.id">
            <section class="col-lg-4 col-md-6 border mb-4">
            <p class="mt-3">商品名：{{purchase.name}}</p>
            <img :src="'/img/' + purchase.img1" class="d-block mx-auto img-fluid">
            <p class="mt-2">
                値段：{{purchase.price}}円<br> 
                個数：{{purchase.quantity}}個<br>
                合計金額：{{ purchaseSum(purchase.price, purchase.quantity) }}円<br>
                購入日時：{{ formatPurchaseTime(purchase.created_at) }}
            </p>
            </section>
        </template>
    </article>
  </div>
</template>
<script setup>
    import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
    import { onMounted, ref } from 'vue';
    //import { useRouter } from 'vue-router';
    import axios from 'axios';
    const purchases = ref([]); // ✅ `ref([])`
    // 各購入アイテムに対して合計金額を計算する
    const purchaseSum = (price, quantity) => price * quantity;

    // 日時を日本時間（+9時間）に変換する
    const formatPurchaseTime = (createdAt) => {
        const date = new Date(createdAt);
        date.setHours(date.getHours() ); 
        return `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日 ${date.getHours()}時`;
    };

  const store = useAuthStore();
  //const router = useRouter();
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

          const response = await axios.get('/api/purchases', {
              headers: { 
                  Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
              },
              withCredentials: true, // ✅ Sanctum 認証では必須
          });
          console.log('確認レスポンス:', response.data);
          console.log('ステータスコード:', response.status);
          purchases.value = response.data;
      } catch (error) {
          console.error('確認エラー:', error);
      }
  };
  onMounted(fetchData);
</script>