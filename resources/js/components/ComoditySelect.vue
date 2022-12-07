<template>
    <section class="py-4 text-center mx-ax">
        <form action = "/confirm" method="get">
            <dl class="contact7">
                <dt>個数<span class="must">必須</span></dt>
                <dd>
                    <select name="quantity" v-model="selectValue" required>
                    <option value="1">１</option>
                    <option value="2">２</option>
                    <option value="3">３</option>
                    <option value="4">４</option>
                    <option value="5">５</option>
                    </select>
                </dd>
            </dl>
            <input type = "text" name="product_id" :value= "this.$route.query.id" class="d-none">
            <input type = "text" name="name" :value= "this.$route.query.name" class="d-none">
            <input type = "text" name="price" :value= "this.$route.query.price" class="d-none">
            <input type = "text" name="img1" :value= "this.$route.query.img1" class="d-none">
            <input type = "text" name="img2" :value= "this.$route.query.img2" class="d-none">

            <p>合計請求額：
                <template v-if="selectValue === '1'" name="purchasePrice" value = "this.$route.query.price">{{this.$route.query.price}}円</template>
                <template v-if="selectValue === '2'" name="purchasePrice" value = "this.$route.query.price">{{this.$route.query.price * 2}}円</template>
                <template v-if="selectValue === '3'" name="purchasePrice" value = "this.$route.query.price">{{this.$route.query.price * 3}}円</template>
                <template v-if="selectValue === '4'" name="purchasePrice" value = "this.$route.query.price">{{this.$route.query.price * 4}}円</template>
                <template v-if="selectValue === '5'" name="purchasePrice" value = "this.$route.query.price">{{this.$route.query.price * 5}}円</template>
            </p>
            <button type="submit" class="btn btn-primary btn-hover d-inline-block mx-4" name="cart">カートに入れる</button>
            <button type="submit" onclick="return confirm('商品の購入でよろしいでしょうか？')"  class="btn btn-primary btn-hover d-inline-block mx-4" name="purchase">購入する</button>
        </form>
    </section>
</template>
<script>
    export default{
        data(){
            return{
                selectValue : '０円',
                countPrice : ''
            }
        }
  }
    
</script>