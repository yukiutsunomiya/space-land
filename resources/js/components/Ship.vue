<template>
    <label for="ship" class="col-md-4 col-form-label text-md-end">発送状況：</label>
    <select id="ship" v-model="selected" name="ship" class="mr-1 inline-block">
        <template v-if="selected ===  '未発送'">
            <option value="未発送">未発送</option>
        </template>
        <template v-if="selected ===  '発送済み'">
            <option value="発送済み">発送済み</option>
        </template>
        <template v-if="selected ===  '完了'">
            <option value="完了">完了</option>
        </template>
    </select>
    <button type="submit" class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-25" onclick="return confirm('ユーザー情報を修正してよろしいでしょうか。')" >変更</button>
</template>
  <script>
      export default{
        props: ["ship"],
        data(){
            return{ 
                selected: this.$route.query.ship
            }
        },
        created(){
            
        },
        methods:{
        }
      }
    </script>