import { defineStore } from 'pinia';
import axios from 'axios';

export const useAdminStore = defineStore('admin', {
  state: () => ({
    user: null,
    token: null, // ✅ `null` にする
    isLoggedIn: false,
  }),
  persist: true, // 永続化を有効化
  actions: {
    async login(credentials) {
      try {
        await axios.get('/sanctum/csrf-cookie');
        console.log('CSRFトークンの取得成功');

        const response = await axios.post('/api/admin/login', credentials, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          withCredentials: true,
        });

        this.user = response.data.user;
        this.token = response.data.token; // ✅ `value` ではなく直接代入
        this.isLoggedIn = true;

        localStorage.setItem('token', response.data.token); // ✅ 修正済み
        console.log('取得したトークン:', response.data.token);
        console.log('トークンの型:', typeof response.data.token);
        console.log('ログイン成功:', response.data);

      } catch (error) {
        if (error.response) {
          console.error('サーバーエラー:', error.response.status, error.response.data.message || error.message);
        } else if (error.request) {
          console.error('ネットワークエラー:', error.message);
        } else {
          console.error('エラー発生:', error.message);
        }
      }
    },

    async register(registerForm) {
      try {
        await axios.get('/sanctum/csrf-cookie');
        console.log('CSRFトークンの取得成功');

        const response = await axios.post('/api/admin/register', registerForm, {
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          withCredentials: true,
        });

        this.user = response.data.user;
        this.token = response.data.token; // ✅ `value` ではなく直接代入
        this.isLoggedIn = true;

        localStorage.setItem('token', response.data.token); // ✅ 修正済み
        console.log('ユーザー登録成功:', response.data);

      } catch (error) {
        if (error.response) {
          console.error('サーバーエラー:', error.response.status, error.response.data.message || error.message);
        } else if (error.request) {
          console.error('ネットワークエラー:', error.message);
        } else {
          console.error('エラー発生:', error.message);
        }
      }
    },

    logout() {
      localStorage.removeItem('token'); // ✅ トークンを削除
      this.token = null;
      this.user = null;
      this.isLoggedIn = false; // ✅ 認証状態をクリア
    },
  },
});