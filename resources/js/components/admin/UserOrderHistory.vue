<template>
    <admin-user-header
        :user="user">
    </admin-user-header>
  <div class="container-fluid text-center mb-3">
    <h2 class="pt-1 my-4 fw-bold">{{ user.name }}様の購入履歴</h2>

    <p>発送状況：{{ ship_situation }}</p>

    <form @submit.prevent="userOrderHistory">
      <label for="ship_situation">発送状況変更：</label>
      <select id="ship_situation" name="ship" class="ml-2 inline-block" v-model="ship">
        <option value="" disabled selected hidden>選択してください。</option>
        <option value="全履歴">全履歴</option>
        <option value="未発送">未発送</option>
        <option value="発送済み">発送済み</option>
        <option value="完了">完了</option>
      </select>
      <button type="submit" class="btn btn-primary mt-2 ml-2 btn-hover w-25">
        対応状況変更
      </button>
    </form>

    <article class="row text-center mb-3 mt-5">
      <template v-for="purchase in purchases" :key="purchase.id">
        <section class="col-lg-4 col-md-6 border pb-3">
          <p class="mt-3">商品名：{{ purchase.name }}</p>
          <img :src="`/img/${purchase.img1}`" class="d-block mx-auto img-fluid" />
          <p class="mt-2">
            値段：{{ purchase.price }}円<br />
            個数：{{ purchase.quantity }}個<br />
            合計金額：{{ purchase.price * purchase.quantity }}円<br />
            購入日時：{{ formatDate(purchase.created_at) }}<br />
            発送状況：{{ purchase.ship }}
          </p>
          <form @submit.prevent="shipUpdate(purchase)">
            <input type="hidden" :value="purchase.id" name="id" />
            <label for="ship">発送状況変更：</label>
            <select id="ship" name="ship" class="mr-1 inline-block" v-model="purchase.shipDraft">
              <option value="" disabled selected hidden>選択してください。</option>
              <option value="未発送">未発送</option>
              <option value="発送済み">発送済み</option>
              <option value="完了">完了</option>
            </select>
            <button type="submit" class="btn btn-primary mt-2 ml-2 btn-hover w-50">
              発送状況変更
            </button>
          </form>
        </section>
      </template>
    </article>
  </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import { useRouter, useRoute } from 'vue-router';
import { useAdminStore } from '../../stores/admin.js';
import axios from 'axios';

const user = ref({});
const purchases = ref({});
const purchase = ref({});
const ship_situation = ref('');
const ship = ref(""); // ← select の選択値を取得する用
const store = useAdminStore();
const router = useRouter();
const route = useRoute();

const userId = route.query.id;

// 購入日時フォーマット関数
const formatDate = (isoString) => {
  const date = new Date(isoString);
  date.setHours(date.getHours() + 9); // 日本時間へ変換
  return `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日 ${date.getHours()}時`;
};

const fetchData = async () => {
  const token = localStorage.getItem('token');
  if (!token) {
    console.error("認証トークンがありません！");
    return;
  }

  try {
    const userResponse = await axios.post('/api/admin/user',
      { id: userId },
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        withCredentials: true
      }
    );
    user.value = userResponse.data;
    ship_situation.value = "全選択";
    purchases.value = fetchedPurchases.map(p => ({
        ...p,
        shipDraft: p.ship // ← ここがポイント！
    }));
  } catch (error) {
    console.error('ユーザーデータ取得エラー:', error);
  }

  try {
    const purchasesResponse = await axios.post('/api/admin/userPurchases',
      { id: userId },
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        withCredentials: true
      }
    );
    purchases.value = purchasesResponse.data;
  } catch (error) {
    console.error('購入履歴取得エラー:', error);
  }
};
onMounted(fetchData);
const userOrderHistory = async () => {
  const token = localStorage.getItem('token');
  if (!token) {
    console.error("認証トークンがありません！");
    return;
  }

  try {
    const purchasesResponse = await axios.post('/api/admin/userOrderHistory',
      { id: user.value.id ,ship: ship.value },
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        withCredentials: true
      }
    );
    ship_situation.value = ship.value;
    purchases.value = purchasesResponse.data;
    console.log("ship_situation："+ship_situation.value);
    console.log("purchases.value："+purchases.value);
  } catch (error) {
    console.error('ユーザーデータ取得エラー:', error);
  }
};

const shipUpdate = async (purchase) => {
  const token = localStorage.getItem('token');
  if (!token) {
    console.error("認証トークンがありません！");
    return;
  }
  purchase.ship = purchase.shipDraft;
  try {
    await axios.post('/api/admin/shipUpdate',
      {id: purchase.id, ship: purchase.ship},
      {
        headers: {
          Authorization: `Bearer ${token}`,
        },
        withCredentials: true
      }
    );
    // user.value = userResponse.data;
  } catch (error) {
    console.error('ユーザーデータ取得エラー:', error);
  }
  
};
</script>
