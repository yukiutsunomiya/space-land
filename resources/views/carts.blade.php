@include('components.header')

<main>
  <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
      <?php $user = Auth::user(); ?>{{ $user->name }}様のカート
    </h2>
    <article class="row text-center">
      @foreach($carts as $cart)
        <section class="col-lg-4 col-md-6 border mb-4">
          <p class="mt-3">商品名：{{$cart->name}}</p>
          <img src="/img/{{$cart->img1}}" class="d-block mx-auto img-fluid">
          @php
            $cartSum = $cart->price * $cart->quantity;
          @endphp
          <p class="mt-2">
            値段：{{$cart->price}}円<br>
            個数：{{$cart->quantity}}個<br>
            合計金額：{{$cartSum}}円
          </p>
          <!--
            <carts-select v-bind:cartQuantity='{{$cart->quantity}}'></carts-select> 
          -->
          <a href="cartDeleate?id={{$cart-> id}}" onclick="return confirm('カートの削除はよろしいですか？')" class="btn btn-primary btn-hover d-inline-block mx-2 my-2">取り消し</a>
          <a href="changeCart?id={{$cart-> id}}&product_id={{$cart-> product_id}}&name={{$cart-> name}}&price={{$cart-> price}}&img1={{$cart-> img1}}&img2={{$cart-> img2}}&quantity={{$cart-> quantity}}" class="btn btn-primary btn-hover d-inline-block mx-2 my-2">個数を変更する</a>
          <a href="confirm?product_id={{$cart-> id}}&name={{$cart-> name}}&price={{$cart-> price}}&img1={{$cart-> img1}}&img2={{$cart-> img2}}&quantity={{$cart-> quantity}}&purchase=" name="purchase" onclick="return confirm('商品の購入でよろしいでしょうか？')" class="btn btn-primary btn-hover d-inline-block mx-2 my-2">購入する</a>
        </section> 
      @endforeach  
      
    </article>
    <?php $user_id = Auth::id(); ?>
    <a href="cartDeleates?user_id={{$user_id}}" onclick="return confirm('すべてのカートの削除します。よろしいですか？')" class="btn btn-primary btn-hover d-inline-block mx-2 mb-4" name="purchase">すべてカート取り消し</a>
  </div>
      
</main>
  <!--

<main>
  <article class="collaboration-article">
    <div class="container-fluid">
      <h2 class="text-center pt-4"><?php $user = Auth::user(); ?>{{ $user->name }}様のカート</h2>
      <div class="row">
        <carts-select v-bind:carts_json='{{json_encode($carts)}}'></carts-select>  
      </div>  
    </div>
  </article>
</main>
-->
@include('components.footer')