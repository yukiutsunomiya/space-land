<h2 class="mx-5 mt-5 mb-3">{{$user-> name}}様</h2>
<nav class="navbar navbar-expand-md">
<!-- ハンバーガーメニュー -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item py-2">
                <a class="nav-link fw-bold" href="../admin/userEdit?id={{$user->id}}&name={{$user-> name}}&furigana={{$user-> furigana}}&telephone={{$user-> telephone}}&email={{$user-> email}}&zipCode={{$user-> zipCode}}&prefectures={{$user-> prefectures}}&address={{$user-> address}}">ユーザー情報変更</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item py-2">
                <a class="nav-link fw-bold" href="../admin/userOrderHistory?user_id={{$user->id}}&user_name={{$user-> name}}&ship=全履歴">購入履歴</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item py-2">
                <a class="nav-link fw-bold" href="../admin/userCart?id={{$user->id}}&name={{$user-> name}}">カート確認確認</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item py-2">
                <a class="nav-link fw-bold" href="../admin/userInquiryList?id={{$user->id}}&name={{$user-> name}}">お問い合わせ確認</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item py-2">
                <a class="nav-link fw-bold" href="../admin/userDelete?id={{$user->id}}" onclick="return confirm('退会してよろしいでしょうか？')" >{{$user->name}}様のユーザー削除</a>
            </li>
        </ul>
    </div>
</nav>