<script setup>
import { useAdminStore } from '../../stores/admin.js';
import { ref } from 'vue';
import { useRouter } from 'vue-router';

const store = useAdminStore();
const router = useRouter();

const email = ref('');
const password = ref('');
const emailError = ref(false);
const passwordError = ref(false);

async function login() {
    // フロントバリデーション
    emailError.value = !email.value;
    passwordError.value = !password.value;

    if (emailError.value || passwordError.value) {
        console.log('バリデーションエラー');
        return;
    }

    try {
        await store.login({ email: email.value, password: password.value });

        if (store.isLoggedIn) {
            console.log('ログイン成功:', store);
            router.push('/admin/top');
        } else {
            console.log('ログイン失敗');
        }
    } catch (error) {
        console.error('ログイン中にエラーが発生:', error);
    }
}
</script>

<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ログイン</div>

                <div class="card-body">
                    <form method="post" @submit.prevent="login">
                        <!-- メールアドレス -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">メールアドレス</label>
                            <div class="col-md-6">
                                <input
                                    id="email"
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    v-model="email"
                                    :class="{ 'is-invalid': emailError }"
                                    autocomplete="email"
                                    autofocus
                                />
                            </div>
                        </div>

                        <!-- パスワード -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">パスワード</label>
                            <div class="col-md-6">
                                <input
                                    id="password"
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    v-model="password"
                                    :class="{ 'is-invalid': passwordError }"
                                    autocomplete="current-password"
                                />
                            </div>
                        </div>

                        <!-- ログイン状態保持 -->
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                                    <label class="form-check-label" for="remember">
                                        ログイン状態を保持する
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- ログインボタン -->
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    ログイン
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
