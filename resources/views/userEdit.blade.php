@include('components.header')
<main>
    <div class="container my-5">
        <h3 class="mb-4">{{$name}}様のユーザー情報</h3>
        <div>
            <form method="get" action="userUpdate">
                <!--<p>登録番号：{{$id}}</p>-->
                <input type="hidden" value="{{$id}}" name="id">
                <p>名前：<input type="text" value="{{$name}}" name="name"></p>
                <p>フリガナ：<input type="text" value="{{$furigana}}" name="furigana"></p>
                <p>電話番号：<input type="tel" value="{{$telephone}}" name="telephone"></p>
                <p>メールアドレス：<input type="email" value="{{$email}}" name="email"></p>
                <p>郵便番号：<input type="number" value="{{$zipCode}}" name="zipCode"></p>
                <p>都道府県：<input type="text" value="{{$prefectures}}" name="prefectures"></p>
                <p>住所：<input type="text" value="{{$address}}" name="address"></p>
                <!--<password></password>-->
                <button type="submit" class="btn btn-primary d-inline-block mt-2 btn-hover w-25" onclick="return confirm('ユーザー情報を修正してよろしいでしょうか。')" >入力内容修正</button>
            </form>
            <a type="submit" href="user?id={{$id}}" class="btn btn-primary d-inline-block mt-3 btn-hover w-25">{{$name}}様のユーザー情報へ戻る</a>
        </div>
    </div>
</main>
@include('components.footer')