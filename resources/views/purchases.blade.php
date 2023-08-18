@include('components.header')
<main>
  <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
      <?php $user = Auth::user(); ?>{{ $user->name }}様の購入履歴
    </h2>
    <article class="row text-center">
      @foreach($purchases as $purchase)
        <section class="col-lg-4 col-md-6 border mb-4">
          <p class="mt-3">商品名：{{$purchase->name}}</p>
          <img src="/img/{{$purchase->img1}}" class="d-block mx-auto img-fluid">
          @php
            $purchaseSum = $purchase->price * $purchase->quantity;
          @endphp
           @php
            $date = new DateTime($purchase-> created_at);
            $date->modify('+9 hours');
            $purchaseTime =$date->format('Y年m月d日 H時');
          @endphp
          <p class="mt-2">
            値段：{{$purchase->price}}円<br> 
            個数：{{$purchase->quantity}}個<br>
            合計金額：{{$purchaseSum}}円<br>
            購入日時：{{$purchaseTime}}
          </p>
        </section>
      @endforeach  
    </article>
    <?php $user_id = Auth::id(); ?>
  </div>
</main>
@include('components.footer')