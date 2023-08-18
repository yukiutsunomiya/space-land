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
        }
    }                              
</script>