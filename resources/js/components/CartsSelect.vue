<template v-for="cart in carts_json">
          <div class="col-lg-4 col-md-6">
            <div class="">
              <div class="pt-2 px-4">
                <h5 class="text-center">{{cart.name}}</h5>
                <p class="text-center">
                  商品金額：{{cart.price}}円</br>
                  <select name="quantity" v-model="selectValue" required>
                    
                    @if({{cartquantity}})

                    @elseif
                      <option value="1">１</option>
                    @endif
                    <option value="1">１</option>
                    <option value="2">２</option>
                    <option value="3">３</option>
                    <option value="4">４</option>
                    <option value="5">５</option>
                    </select>
                  個数：{{$cart->quantity}}円</br>
                  合計金額：{{$cart->quantity}}円
                </p>
              </div>
              <img src="/img/{{$cart->img1}}" class="d-inline-block w-100">
            </div>       
          </div>
</template>
          <script>
    export default {
        props: {
            shopData: {
                type: Object
            },
        },
       name:'shop-page'
   }
</script>