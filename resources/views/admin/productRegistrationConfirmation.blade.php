@include('components.adminHeader')
<main>
    <div class="container my-5">
        <h3 class="mb-4">商品登録</h3>
        <div>
            <form method="get" action="admin/productRegistrationConfirmation">
                @csrf
                <p>名前：{{$name}}</p>
                <p>値段：{{$price}}</p>
                <p>メイン写真：<img src="/img/{{$img1}}" class="about-img"></p>
                <p>サブ写真：<img src="/img/{{$img2}}" class="about-img"></p>
                <p>商品説明：{{$description}}</p>
                <p>販売年：{{$releaseYear}}</p>
                <p>販売月：{{$releaseMonth}}</p>
                <p>販売日：{{$releaseDate}}</p>
                <p>販売状況：{{$situation}}</p>
                <!--<password></password>-->
            </form>
            <a type="submit" href="/admin" class="btn btn-primary d-inline-block mt-3 btn-hover w-25">{{$name}}の商品情報編集</a>
            <a type="submit" href="user" class="btn btn-primary d-inline-block mt-3 btn-hover w-25" onclick="return confirm('登録した商品を削除してもよろしいでしょうか。')" >{{$name}}の商品情報削除</a>
        </div>
    </div>
</main>
@include('components.footer')