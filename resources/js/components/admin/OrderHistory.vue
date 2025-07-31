<template>
  <div class="container-fluid text-center mb-4">
    <h2 class="pt-1 my-4 fw-bold">購入履歴</h2>

    <p>発送状況：{{ shipSituation }}</p>

    <form @submit.prevent="filterByShipSituation">
      <!--
      <input type="hidden" :value="userName" name="user_name" />
      <input type="hidden" :value="userId" name="id" />
      -->
      

      <label for="ship_situation">発送状況変更：</label>
      <select v-model="selectedShipSituation" id="ship_situation" name="ship_situation" class="ml-2 inline-block">
        <option value="" disabled hidden>選択してください。</option>
        <option value="全履歴">全履歴</option>
        <option value="未発送">未発送</option>
        <option value="発送済み">発送済み</option>
        <option value="完了">完了</option>
      </select>

      <button type="submit" class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-25">
        対応状況変更
      </button>
    </form>

    <article class="row text-center mt-5">
      <section class="col-lg-4 col-md-6 border pb-4" v-for="purchase in purchases" :key="purchase.id">
        <p class="mt-3">商品名：{{ purchase.name }}</p>
        <img :src="`/img/${purchase.img1}`" class="d-block mx-auto img-fluid" />

        <p class="mt-2">
          値段：{{ purchase.price }}円<br />
          個数：{{ purchase.quantity }}個<br />
          合計金額：{{ purchase.price * purchase.quantity }}円<br />
          購入日時：{{ formatDate(purchase.created_at) }}<br />
          発送状況：{{ purchase.ship }}
        </p>

        <form @submit.prevent="updateShipStatus(purchase)">
          <input type="hidden" :value="shipSituation" name="ship_situation" />
          <input type="hidden" :value="purchase.user_id" name="user_id" />
          <input type="hidden" :value="purchase.id" name="id" />

          <label for="ship">発送状況変更：</label>
          <select v-model="purchase.newShip" id="ship" name="ship" class="mr-1 inline-block">
            <option value="" disabled hidden>選択してください。</option>
            <option value="未発送">未発送</option>
            <option value="発送済み">発送済み</option>
            <option value="完了">完了</option>
          </select>

          <button type="submit" class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-50">
            発送状況変更
          </button>
        </form>

        <RouterLink :to="`/admin/user?id=${purchase.user_id}`" class="btn btn-primary d-inline-block mt-3 btn-hover w-50">
          購入者情報確認
        </RouterLink>
      </section>
    </article>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter();

const shipSituation = ref('');
const selectedShipSituation = ref('');
const purchases = ref([]);

// 日付フォーマット
const formatDate = (rawDate) => {
  const date = new Date(rawDate);
  date.setHours(date.getHours() + 9);
  return `${date.getFullYear()}年${date.getMonth() + 1}月${date.getDate()}日 ${date.getHours()}時`;
};

// 初期データ取得や条件付きで使えるように引数を受け取るようにする
const fetchPurchases = async (shipSituationParam = '') => {
  try {
    const token = localStorage.getItem('token');
    if (!token) {
      console.error("認証トークンがありません！");
      return;
    }

    const response = await axios.post(
      '/api/admin/orderHistory',
      {
        ship_situation: shipSituationParam,
      },
      {
        headers: {
          Authorization: `Bearer ${token}`
        },
        withCredentials: true
      }
    );

    const fetchedPurchases = response.data;

    if (Array.isArray(fetchedPurchases)) {
      purchases.value = fetchedPurchases.map(p => ({
        ...p,
        shipDraft: p.situation
      }));
    } else {
      purchases.value = {
        ...fetchedPurchases,
        shipDraft: fetchedPurchases.situation
      };
    }

    shipSituation.value = shipSituationParam;
    console.log("確認:", response.data);
  } catch (error) {
    console.error('購入履歴の取得に失敗しました:', error);
  }
};

onMounted(() => {
  fetchPurchases("全履歴");
});

const filterByShipSituation = () => {
  fetchPurchases(selectedShipSituation.value);
};

// 発送状況の更新
const updateShipStatus = async (purchase) => {
  const token = localStorage.getItem('token');
  if (!token) {
    console.error("認証トークンがありません！");
    return;
  }
  try {
    await axios.post('/api/admin/shipUpdate', {
      id: purchase.id,
      ship: purchase.newShip,
    },
    {
      headers: {
        Authorization: `Bearer ${token}`
      },
      withCredentials: true
    });
    purchase.ship = purchase.newShip;
    purchase.newShip = ''; // 初期化
  } catch (error) {
    console.error('発送状況の更新に失敗しました:', error);
  }
};
</script>
