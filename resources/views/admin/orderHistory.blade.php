@include('components.adminHeader')
<main>
  <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
      購入履歴
    </h2>
    <article class="row text-center">
      @foreach($purchases as $purchase)
        <section class="col-lg-4 col-md-6 border mb-4">
          <p class="mt-3">商品名：{{$purchase->name}}</p>
          <img src="/img/{{$purchase->img1}}" class="d-block mx-auto img-fluid">
          @php
            $purchaseSum = $purchase->price * $purchase->quantity;
          @endphp
          <p class="mt-2">
            値段：{{$purchase->price}}円<br> 
            個数：{{$purchase->quantity}}個<br>
            合計金額：{{$purchaseSum}}円
          </p>
        </section>
      @endforeach  
    </article>
  </div>
</main>
@include('components.footer')