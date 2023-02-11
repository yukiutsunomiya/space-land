<template>
  <label for="noPassword" class=""><input id="noPassword" type="radio" name="password" value="ng" v-model="password">パスワードを変更しない　</label>
	<label for="okPassword"><input id="okPassword" type="radio" name="password" value="ok" v-model="password">パスワードを変更する</label>
<div v-if="password === 'ok'">
    <p>パスワード：<input type="text" name="password" value="" size="30"></p>
</div>
<div v-if="password === 'ng'">
</div>

</template>
<script>
    export default{
      props: ["cartQuantity"],
      data(){
        return{
          selectValue : this.$route.query.cartQuantity
        }
      },
      created(){
      },
      methods:{
      }
    }
  </script>