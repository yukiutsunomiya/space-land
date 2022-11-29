@include('components.header')

<main>
  <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
      <?php $user = Auth::user(); ?>{{ $user->name }}様のカート
    </h2>
    <article class="row">
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
          <a href="cartDeleate?id={{$cart-> id}}" class="btn btn-primary btn-hover d-inline-block mx-2 my-2">取り消し</a>
          <button type="submit" class="btn btn-primary btn-hover d-inline-block mx-2" name="purchase">個数を変更する</button>
          <button type="submit" class="btn btn-primary btn-hover d-inline-block mx-4 mb-2" name="purchase">購入する</button>
        </section>  
      @endforeach  
    </article>
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