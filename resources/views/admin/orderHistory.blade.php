@include('components.adminHeader')
<main>
  <div class="container-fluid text-center mb-4">
    <h2 class="pt-1 my-4 fw-bold">
      購入履歴
    </h2>
    <p>発送状況：{{$ship_situation}}</p>
    <form method="get" action="/admin/orderHistory">
      <input type="hidden" value="" name="user_name">
      <input type="hidden" value="" name="id">
      <label for="ship_situation" class="">発送状況変更：</label>
      <select id="ship_situation" name="ship_situation" class="ml-2 inline-block">
        <option hidden>選択してください。</option>
        <option value="全履歴">全履歴</option>
        <option value="未発送">未発送</option>
        <option value="発送済み">発送済み</option>
        <option value="完了">完了</option>
      </select>
      <button type="submit" class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-25">対応状況変更</button>
    </form>
    <article class="row text-center mt-5">
      @foreach($purchases as $purchase)
        <section class="col-lg-4 col-md-6 border pb-4">
          <p class="mt-3">商品名：{{$purchase->name}}</p>
          <img src="/img/{{$purchase->img1}}" class="d-block mx-auto img-fluid">
          @php
            $purchaseSum = $purchase->price * $purchase->quantity;
          @endphp
          @php
            $date = new DateTime($purchase-> created_at);
            $date->modify('+9 hours');
            $purchaseTime =$date->format('Y年m月d日 H時')
          @endphp
          <p class="mt-2">
            値段：{{$purchase->price}}円<br> 
            個数：{{$purchase->quantity}}個<br>
            合計金額：{{$purchaseSum}}円<br>
            購入日時：{{$purchaseTime}}<br>
            発送状況：{{$purchase->ship}}
          </p>
          <form method="get" action="/admin/shipUpdate">
            <input type="hidden" value="" name="orderHistory">
            <input type="hidden" value="{{$ship_situation}}" name="ship_situation">
            <input type="hidden" value="{{$purchase->user_id}}" name="user_id">
            <input type="hidden" value="{{$purchase->id}}" name="id">
            <label for="ship" class="">発送状況変更：</label>
            <select id="ship" name="ship" class="mr-1 inline-block">
                <option hidden>選択してください。</option>
                <option value="未発送">未発送</option>
                <option value="発送済み">発送済み</option>
                <option value="完了">完了</option>
            </select>
            <button type="submit" class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-50">発送状況変更</button>
          </form>
          <a type="submit" href="../admin/user?id={{$purchase->user_id}}" class="btn btn-primary d-inline-block mt-3 btn-hover w-50">購入者情報確認</a>
        </section>
      @endforeach  
    </article>
  </div>
</main>
@include('components.footer')