<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">登録</div>

          <div class="card-body">
            <form method="post" @submit.prevent="register">
              <!-- 名前 -->
              <div class="mb-3 row">
                <label for="name" class="col-md-4 col-form-label text-md-end">名前</label>
                <div class="col-md-6">
                  <input
                    id="name"
                    type="text"
                    class="form-control"
                    v-model="registerForm.name"
                    required
                    placeholder="山田 太郎"
                  />
                  <div v-if="errors?.name" class="text-danger small">{{ errors.name[0] }}</div>
                </div>
              </div>

              <!-- フリガナ -->
              <div class="mb-3 row">
                <label for="furigana" class="col-md-4 col-form-label text-md-end">フリガナ</label>
                <div class="col-md-6">
                  <input
                    id="furigana"
                    type="text"
                    class="form-control"
                    v-model="registerForm.furigana"
                    required
                    placeholder="ヤマダ タロウ"
                  />
                  <div v-if="errors?.furigana" class="text-danger small">{{ errors.furigana[0] }}</div>
                </div>
              </div>

              <!-- 電話番号 -->
              <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">お電話番号</label>
                <div class="col-md-6">
                  <input
                    type="tel"
                    class="form-control"
                    v-model="registerForm.telephone"
                    required
                    placeholder="09012345678"
                  />
                  <div v-if="errors?.telephone" class="text-danger small">{{ errors.telephone[0] }}</div>
                </div>
              </div>

              <!-- メールアドレス -->
              <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">メールアドレス</label>
                <div class="col-md-6">
                  <input
                    type="email"
                    class="form-control"
                    v-model="registerForm.email"
                    required
                    placeholder="example@example.com"
                  />
                  <div v-if="errors?.email" class="text-danger small">{{ errors.email[0] }}</div>
                </div>
              </div>

              <!-- 郵便番号 -->
              <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">郵便番号</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    v-model="registerForm.zipCode"
                    required
                    placeholder="1234567"
                  />
                  <div v-if="errors?.zipCode" class="text-danger small">{{ errors.zipCode[0] }}</div>
                </div>
              </div>

              <!-- 都道府県 -->
              <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">都道府県</label>
                <div class="col-md-6">
                  <select v-model="registerForm.prefectures" required class="form-control">
                    <option disabled value="">都道府県を選択</option>
                    <option v-for="pref in prefectures" :key="pref" :value="pref">{{ pref }}</option>
                  </select>
                </div>
              </div>

              <!-- 住所 -->
              <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">ご住所</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    class="form-control"
                    v-model="registerForm.address"
                    required
                    placeholder="○○市○○町"
                  />
                </div>
              </div>

              <!-- パスワード -->
              <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">パスワード</label>
                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control"
                    v-model="registerForm.password"
                    required
                    minlength="8"
                    placeholder="8文字以上"
                  />
                </div>
              </div>

              <!-- 確認用パスワード -->
              <div class="mb-3 row">
                <label class="col-md-4 col-form-label text-md-end">パスワード（確認）</label>
                <div class="col-md-6">
                  <input
                    type="password"
                    class="form-control"
                    v-model="passwordConfirmation"
                    required
                    placeholder="再入力"
                  />
                </div>
              </div>

              <!-- ボタン -->
              <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">登録</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, reactive } from 'vue';
//import axios from 'axios';
import { useAuthStore } from '../../stores/auth.js'; // ストアの正しいパスを指定
import { useRouter } from 'vue-router';
const store = useAuthStore();
console.log(store);
const router = useRouter();
// コンポーネント名を指定したい場合（オプション）
// <script setup> では defineOptions を使って名前を定義できます（Vue 3.3+）
// defineOptions({ name: 'Register' });

// 各種状態を定義
const registerForm = reactive({
  name: "",
  furigana: "", // 空文字に設定（必要に応じて適切な値に変更）
  telephone: "",
  email: "",
  zipCode: "",
  prefectures:"",
  address:"",
  password: "",
});
const message = ref(null);
const passwordConfirmation = ref("");

const errors = ref(null);
// 都道府県の一覧を定義
const prefectures = [
  "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県",
  "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
  "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県", "岐阜県",
  "静岡県", "愛知県", "三重県", "滋賀県", "京都府", "大阪府", "兵庫県", 
  "奈良県", "和歌山県", "鳥取県", "島根県", "岡山県", "広島県", "山口県", 
  "徳島県", "香川県", "愛媛県", "高知県", "福岡県", "佐賀県", "長崎県", 
  "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
];

// 登録処理
async function register() {
  errors.value = {}; // エラー初期化

  // クライアント側バリデーション
  const katakanaRegex = /^[\u30A1-\u30FC\s]+$/;
  const phoneRegex = /^[0-9]{10,11}$/;
  const zipRegex = /^[0-9]{7}$/;

  if (!katakanaRegex.test(registerForm.furigana)) {
    errors.value.furigana = ['フリガナは全角カタカナで入力してください。'];
  }

  if (!phoneRegex.test(registerForm.telephone)) {
    errors.value.telephone = ['電話番号は10〜11桁の数字で入力してください。'];
  }

  if (!zipRegex.test(registerForm.zipCode)) {
    errors.value.zipCode = ['郵便番号は7桁の数字で入力してください。'];
  }

  if (registerForm.password !== passwordConfirmation.value) {
    errors.value.password = ['パスワードと確認用パスワードが一致しません。'];
  }

  // エラーがある場合は送信しない
  if (Object.keys(errors.value).length > 0) {
    return;
  }

  try {
    console.log('送信データ:', registerForm);
    await store.register(registerForm);

    if (store.isLoggedIn) {
      router.push('/');
    } else {
      errors.value.general = ['ログインに失敗しました。'];
    }
  } catch (error) {
    console.error('登録中にエラーが発生:', error);
    message.value = '登録中に問題が発生しました。';

    if (error.response?.status === 422) {
      errors.value = error.response.data.errors;
    } else {
      errors.value = { general: ['不明なエラーが発生しました'] };
    }
  }
}
</script>


