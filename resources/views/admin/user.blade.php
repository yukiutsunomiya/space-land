@include('components.adminHeader')
<main>
    <div class="container my-5">
        <section class="text-center">
        <h2 class="mb-4 fw-bold">{{$user-> name}}様のユーザー情報</h2>
        <div>
            <p>登録番号：{{$user-> id}}</p>
            <p>名前：{{$user-> name}}</p>
            <p>フリガナ：{{$user-> furigana}}</p>
            <p>電話番号：{{$user-> telephone}}</p>
            <p>メールアドレス：{{$user-> email}}</p>
            <p>郵便番号：{{$user-> zipCode}}</p>
            <p>都道府県：{{$user-> prefectures}}</p>
            <p>住所：{{$user-> address}}</p>
            <!--<p>パスワード：{{$user-> password}}</p>-->
        </div>
        <a type="submit" href="../admin/userEdit?id={{$user->id}}&name={{$user-> name}}&furigana={{$user-> furigana}}&telephone={{$user-> telephone}}&email={{$user-> email}}&zipCode={{$user-> zipCode}}&prefectures={{$user-> prefectures}}&address={{$user-> address}}" class="btn btn-primary d-inline-block m-4 btn-hover w-25">ユーザー情報変更</a>
        <a type="submit" href="../admin/userCart?id={{$user->id}}&name={{$user-> name}}" class="btn btn-primary d-inline-block m-4 btn-hover w-25">カート確認</a>
        <a type="submit" href="../admin/userInquiryList?id={{$user->id}}&name={{$user-> name}}" class="btn btn-primary d-inline-block m-4 btn-hover w-25">お問い合わせ確認</a>
        <a type="submit" href="../admin/userDelete?id={{$user->id}}" onclick="return confirm('退会してよろしいでしょうか？')" class="btn btn-primary d-inline-block m-4 btn-hover w-25">{{$user-> name}}様ユーザー消去</a>
    </div>
    <div class="container-fluid text-center">
    <h2 class="pt-1 my-4 fw-bold">
     {{$user-> name}}様の購入履歴
    </h2>
    <article class="row text-center">
      @foreach($purchases as $purchase)
        <section class="col-lg-4 col-md-6 border pb-3">
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
            <input type="hidden" value="" name="user">
            <input type="hidden" value="{{$user->id}}" name="user_id">
            <input type="hidden" value="{{$purchase->id}}" name="purchase_id">
            <label for="ship" class="">発送状況変更：</label>
            <select id="ship" name="ship" class="mr-1 inline-block">
                <option value="選択してください。" selected hidden>選択してください。</option>
                <option value="未発送">未発送</option>
                <option value="発送済み">発送済み</option>
                <option value="完了">完了</option>
            </select>
            <button type="submit" class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-50">発送状況変更</button>
          </form>
          <!--<ship v-bind:ship='{{$purchase->ship}}'></ship>-->
        </section>
      @endforeach  
    </article>
  </div>
</main>
@include('components.footer')