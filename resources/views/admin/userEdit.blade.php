@include('components.adminHeader')
<main>
    <div class="container my-5 text-center">
        <h3 class="mb-4">{{$name}}様のユーザー情報</h3>
        <div>
            <form method="get" action="/admin/userUpdate">
                <p>登録番号：{{$id}}</p>
                <input type="hidden" value="{{$id}}" name="id">
                <p>名前：<input type="text" value="{{$name}}" name="name" class="w-50"></p>
                <p>フリガナ：<input type="text" value="{{$furigana}}" name="furigana" class="w-50"></p>
                <p>電話番号：<input type="tel" value="{{$telephone}}" name="telephone" class="w-50"></p>
                <p>メールアドレス：<input type="email" value="{{$email}}" name="email" class="w-50"></p>
                <p>郵便番号：<input type="number" value="{{$zipCode}}" name="zipCode" class="w-50"></p>
                <p>都道府県：<input type="text" value="{{$prefectures}}" name="prefectures" class="w-50"></p>
                <p>住所：<input type="text" value="{{$address}}" name="address" class="w-50"></p>
                <!--<password></password>-->
                <button type="submit" class="btn btn-primary d-inline-block mt-2 btn-hover w-25" onclick="return confirm('ユーザー情報を修正してよろしいでしょうか。')" >入力内容修正</button>
            </form>
            <a type="submit" href="../admin/user?id={{$id}}" class="btn btn-primary d-inline-block mt-3 btn-hover w-25">{{$name}}様のユーザー情報へ戻る</a>
        </div>
    </div>
</main>
@include('components.footer')