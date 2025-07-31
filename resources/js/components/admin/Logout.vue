<script setup>
import { onMounted } from 'vue'
//import axios from 'axios'
import { useRouter } from 'vue-router'
import { useAdminStore } from '../../stores/admin.js'; // ストアの正しいパスを指定
const router = useRouter();
const store = useAdminStore();

const logout =()=>{
    store.logout(); // ログアウト処理を呼び出す
    router.push('/admin/top');
    /*
    axios.post('api/logout').then((res)=>{
        console.log('logout response:'+res.data.message);
        st.setLogout();//追記
        router.push({name:'auth.login'})
    }).catch((err)=>{
        console.log('logout error:'+err);
    })
        */
}

onMounted(()=>{
    logout();
})
</script>
<template></template>
