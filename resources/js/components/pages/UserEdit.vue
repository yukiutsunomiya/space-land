<template>
  <div class="container my-5">
    <h3 class="mb-4">{{ store.user.name }} 様のユーザー情報</h3>
    <div>
      <form @submit.prevent="userUpdate">
        <input type="hidden" :value="form.id" name="id" />

        <p>名前：<input type="text" v-model="form.name" name="name" class="w-50" required/></p>
        <p>フリガナ：<input type="text" v-model="form.furigana" name="furigana" class="w-50" required pattern="(?=.*?[\u30A1-\u30FC])[\u30A1-\u30FC\s]*"/></p>
        <p>電話番号：<input type="tel" v-model="form.telephone" name="telephone" class="w-50" required  pattern="0\d{9,10}" title="電話番号は10〜11桁の数字で入力してください（例：09012345678）"/></p>
        <p>メールアドレス：<input type="email" v-model="form.email" name="email" class="w-50" required pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" title="正しいメールアドレス形式で入力してください（例: user@example.com）"/></p>
        <p>郵便番号：<input type="text" v-model="form.zipCode" name="zipCode" class="w-50" required pattern="\d{3}-?\d{4}" title="郵便番号は7桁の数字（例：123-4567または1234567）で入力してください"/></p>

        <p>
          都道府県：
          <select v-model="form.prefectures" name="prefectures" required class="form-control w-50">
            <option disabled value="">都道府県</option>
            <option v-for="pref in prefectures" :key="pref" :value="pref">
              {{ pref }}
            </option>
          </select>
        </p>

        <p>住所：<input type="text" v-model="form.address" name="address" class="w-50" /></p>

        <button type="submit" class="btn btn-primary d-inline-block mt-2 btn-hover w-25">
          入力内容修正
        </button>
      </form>

      <router-link
        :to="{ path: '/user' }"
        class="btn btn-primary d-inline-block mt-3 btn-hover w-25"
      >
        {{ store.user.name }}様のユーザー情報へ戻る
      </router-link>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import { useAuthStore } from '../../stores/auth.js'

const router = useRouter()
const store = useAuthStore()

// 都道府県リスト
const prefectures = [
  "北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県",
  "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県",
  "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県", "岐阜県",
  "静岡県", "愛知県", "三重県", "滋賀県", "京都府", "大阪府", "兵庫県", 
  "奈良県", "和歌山県", "鳥取県", "島根県", "岡山県", "広島県", "山口県", 
  "徳島県", "香川県", "愛媛県", "高知県", "福岡県", "佐賀県", "長崎県", 
  "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"
]

// ストアのユーザー情報をフォームにコピー（リアクティブ）
const form = reactive({
  id: store.user.id,
  name: store.user.name,
  furigana: store.user.furigana,
  telephone: store.user.telephone,
  email: store.user.email,
  zipCode: store.user.zipCode,
  prefectures: store.user.prefectures,
  address: store.user.address
})

// ユーザー情報の更新処理
const userUpdate = async () => {
  if (!confirm('ユーザー情報を修正してよろしいでしょうか。')) {
    return
  }

  try {
    const token = localStorage.getItem('token')
    if (!token) {
      console.error("認証トークンがありません！")
      return
    }
    // API に POST リクエスト
    const response = await axios.post('/api/userUpdate', form, {
      headers: {
        Authorization: `Bearer ${token}`
      },
      withCredentials: true
    })

    // store の user 情報を更新
    store.updateUserField('name', form.name)
    store.updateUserField('furigana', form.furigana)
    store.updateUserField('telephone', form.telephone)
    store.updateUserField('email', form.email)
    store.updateUserField('zipCode', form.zipCode)
    store.updateUserField('prefectures', form.prefectures)
    store.updateUserField('address', form.address)

    console.log('確認レスポンス:', response.data)
    router.push('/user')
  } catch (error) {
    console.error('確認エラー:', error)
  }
}
</script>
