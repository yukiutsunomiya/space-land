<template>
    <select name="quantity" v-model="selectValue" required>
        <option  value="1">１</option>
        <option value="2">２</option>
        <option value="3">３</option>
        <option value="4">４</option>
        <option value="5">５</option>
    </select>
</template>
<script>
    export default{
        props: ["cartQuantity"],
        data(){
            return{
            cartQuantity:cartQuantity,
            }
        },
      
      created(){
        this.carts = JSON.stringify(this.carts_json);
        this.cart2s = this.carts.split('},');
        
        console.log("carts_json"+this.carts_json);
        console.log("JSON.stringify(this.carts_json)"+JSON.stringify(this.carts_json));
        console.log("JSON.parse(JSON.stringify(this.carts_json)"+JSON.parse(JSON.stringify(this.carts_json)));
        console.log("Object.entries(obj);"+Object.entries(Object.entries(JSON.stringify(this.carts_json))));
        console.log("split"+this.cart2s);
        for (let i = 0; i < this.cart2s.length; i++) {
            console.log(this.cart2s[i]); 
            }
        }
      }                              
</script>