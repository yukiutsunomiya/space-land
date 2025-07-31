<template>
    <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
      {{ store.user.name }}様のカート
    </h2>
    <article class="row text-center">
      <template v-for="item in cartItems" :key="item.id">
        <section class="col-lg-4 col-md-6 border mb-4">
          <p class="mt-3">商品名：{{ item.name }}</p>
          <img :src="'/img/' + item.img1" class="d-block mx-auto img-fluid" alt="商品画像" />

          <p class="mt-2">
            値段：{{ item.price }}円<br>
            個数：{{ item.quantity }}個<br>
            合計金額：{{ item.price * item.quantity }}円
          </p>

          <!-- カート削除 -->
          <button
            @click="cartDelete(item)" onclick="return confirm('カートの削除はよろしいですか？')" 
            class="btn btn-primary btn-hover d-inline-block mx-2 my-2">
            取り消し
          </button>

          <!-- 個数変更 -->
          <button
            @click="changeCart(item)" 
            class="btn btn-primary btn-hover d-inline-block mx-2 my-2">
            個数を変更する
          </button>

          <!-- 購入 -->
          <button 
            @click="confirm(item)" onclick="return confirm('商品の購入でよろしいでしょうか？')" 
            class="btn btn-primary btn-hover d-inline-block mx-2 my-2">
            購入する
          </button>
        </section>
      </template>
 
    </article>
    <button @click="cartDeletes" onclick="return confirm('すべてのカートの削除します。よろしいですか？')" class="btn btn-primary btn-hover d-inline-block mx-2 mb-4" name="purchase">すべてカート取り消し</button>
  </div>
</template>
<script setup>
  import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
  import { onMounted, ref } from 'vue';
  import { useRouter } from 'vue-router';
  import axios from 'axios';
  const cartItems = ref([]); // ✅ `ref([])`
  const store = useAuthStore();
  const router = useRouter();
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

          const response = await axios.get('/api/carts', {
              headers: { 
                  Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
              },
              withCredentials: true, // ✅ Sanctum 認証では必須
          });
          console.log('確認レスポンス:', response.data);
          console.log('ステータスコード:', response.status);
          cartItems.value = response.data;
          console.log("response.data:"+response.data);
          console.log("cartItems.value:"+cartItems.value);
      } catch (error) {
          console.error('確認エラー:', error);
      }
  };
  onMounted(fetchData);
  const cartDelete = async (item) => {
    try {
      const token = localStorage.getItem('token');
      if (!token) {
        console.error("認証トークンがありません！");
        return;
      }
    const response = await axios.get('/api/cartDelete', {
      headers: { 
        Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
      },
        withCredentials: true, // ✅ Sanctum 認証では必須
        params: { id: item.id } // ✅ `params` を使って `item.id` を渡す
      });
      console.log('確認レスポンス:', response.data);
      console.log('ステータスコード:', response.status);
      fetchData();
    } catch (error) {
      console.error('確認エラー:', error);
    }
  };
  const changeCart = (item) => {
     router.push({
      path: '/changeCart',
      query: {
        id: item.id,
        name: item.name,
        price: item.price,
        img1: item.img1,
        img2: item.img2,
        quantity: item.quantity
      }
    });
  };
  const cartDeletes = async () => {
    try {
      const token = localStorage.getItem('token');
      if (!token) {
        console.error("認証トークンがありません！");
        return;
      }
    const response = await axios.get('/api/cartDeletes', {
      headers: { 
        Authorization: `Bearer ${token}` // ✅ `Bearer` を追加
      },
        withCredentials: true, // ✅ Sanctum 認証では必須
        params: { user_id: store.user?.id } // ✅ `params` を使って `item.id` を渡す
      });
      console.log('確認レスポンス:', response.data);
      console.log('ステータスコード:', response.status);
      fetchData();
    } catch (error) {
      console.error('確認エラー:', error);
    }
  };


</script>