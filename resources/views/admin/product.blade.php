@include('components.adminHeader')
<main>
    <div class="container my-5 text-center">
        <h3 class="mb-4">{{$name}}商品情報</h3>
        <div class="row justify-content-center">
            <div class="col-md-6 text-left col-margin-0 ">
                <img src="/img/{{$img1}}" class="about-img">
            </div>
            @if(isset($img2))
            <div class="col-md-6 text-left col-margin-0 ">
                <img src="/img/{{$img2}}" class="about-img">
            </div>
            @else
            <div class="col-md-6 text-left col-margin-0 ">
                <h3 class="text-center mt-5">サブ写真はありません。</h3>
            </div>
            @endif
        </div>
        <div class="">
            <h4 class="text-center mt-4">商品名：{{$name}}</h4>
            <p class="text-center">
                金額：{{$price}}円
            </p>
            <p>販売日：{{$releaseYear}}年{{$releaseMonth}}月{{$releaseDate}}日</p>
            <p>商品説明：{{$description}}</p>
            <p>商品表示順番：{{$order}}</p>
            <p>商品状況：{{$situation}}</p>
            <div class="row">
                <div class="col-md-4">
                    <a href="../admin/products" class="btn btn-primary d-inline-block btn-hover w-75 my-3">商品一覧ページへ</a>　
                </div>
                <div class="col-md-4">
                    <a href="../admin/productInformationChange?id={{$id}}&name={{$name}}&price={{$price}}&img1={{$img1}}&img2={{$img2}}&description={{$description}}&releaseYear={{$releaseYear}}&releaseMonth={{$releaseMonth}}&releaseDate={{$releaseDate}}&order={{$order}}&situation={{$situation}}" class="btn btn-primary d-inline-block btn-hover w-75 my-3 mr-l">{{$name}}の商品情報変更</a>　
                </div>
                <div class="col-md-4">
                    <a href="../admin/productDelete?id={{$id}}" class="btn btn-primary d-inline-block btn-hover w-75 my-3">{{$name}}の商品削除</a>
                </div>
            </div>  
        </div>
    </div>
</main>
@include('components.footer')