@include('components.adminHeader')
<main>
    <div class="container my-5">
        <h3 class="mb-4">{{$user-> name}}様のユーザー情報</h3>
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
        <a type="submit" href="../admin/userDelete?id={{$user->id}}" onclick="return confirm('退会してよろしいでしょうか？')" class="btn btn-primary d-inline-block m-4 btn-hover w-25">消去</a>
    </div>
</main>
@include('components.footer')