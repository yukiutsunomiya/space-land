@include('components.adminHeader')
<main>
    <div class="container my-5 text-center">
        <h3 class="mb-4">商品情報変更</h3>
        <div class="row justify-content-center">
            <div class="col-md-5 text-left col-margin-0 ">
                <img :src=" '/img/'+ product.img1" class="about-img">
            </div>

        </div>
        
    </div>
</main>
@include('components.footer')