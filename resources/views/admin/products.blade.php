@include('components.adminHeader')
<main>
    <div class="container mt-4 text-center">
        <h3 class="mb-4">商品情報一覧</h3>
        <div class="row justify-content-center">
            @foreach($products as $product)
            <div class="col-lg-4 col-margin-0 bg-white ">
                <img src="/img/{{$product->img1}}" class="about-img ">
            </div>
            <div class="col-lg-8 bg-white p-3 col-margin-0 ">
                <h4 class="text-center">商品名：{{$product->name}}</h4>
                <p class="text-center">
                    金額：{{$product->price}}円
                </p>
                <!--
                @if(isset($product->img2))
                <p class="text-center">
                    サブ写真はあります。
                </p>
                @else
                <p class="text-center">
                    サブ写真はありません。
                </p>       
                @endif
                -->
                <p>販売日：{{$product->releaseYear}}年{{$product->releaseMonth}}月{{$product->releaseDate}}日</p>
                <p>商品説明：{{$product->description}}</p>
                <p>商品表示順番：{{$product->order}}</p>
                <p>商品状況：{{$product->situation}}</p>
                <div class="row">
                    <div class="col-md-4">
                    <a href="../admin/product?id={{$product->id}}&name={{$product->name}}&price={{$product->price}}&img1={{$product->img1}}&img2={{$product->img2}}&description={{$product->description}}&releaseYear={{$product->releaseYear}}&releaseMonth={{$product->releaseMonth}}&releaseDate={{$product->releaseDate}}&order={{$product->order}}&situation={{$product->situation}}" class="btn btn-primary d-inline-block btn-hover w-75 my-3 mr-l">{{$product->name}}の商品情報ページ</a>　
                    </div>
                    <div class="col-md-4">
                        <a href="../admin/productInformationChange?id={{$product->id}}&name={{$product->name}}&price={{$product->price}}&img1={{$product->img1}}&img2={{$product->img2}}&description={{$product->description}}&releaseYear={{$product->releaseYear}}&releaseMonth={{$product->releaseMonth}}&releaseDate={{$product->releaseDate}}&order={{$product->order}}&situation={{$product->situation}}" class="btn btn-primary d-inline-block btn-hover w-75 my-3 mr-l">{{$product->name}}の商品情報変更</a>　
                    </div>
                    <div class="col-md-4">
                        <a href="../admin/productDelete?id={{$product->id}}" class="btn btn-primary d-inline-block btn-hover w-75 my-3">{{$product->name}}の商品削除</a>
                    </div>
                </div>
                <!--
                    <a href="../admin/product?id={{$product->id}}&name={{$product->name}}&price={{$product->price}}&img1={{$product->img1}}&img2={{$product->img2}}&description={{$product->description}}&releaseYear={{$product->releaseYear}}&releaseMonth={{$product->releaseMonth}}&releaseDate={{$product->releaseDate}}&order={{$product->order}}&situation={{$product->situation}}" class="btn btn-primary d-inline-block btn-hover w-50 my-3 mr-l">{{$product->name}}の商品情報確認</a>
-->
            </div>
            <div class="mb-3">　</div>
            @endforeach
        </div>
        
    </div>
</main>
@include('components.footer')