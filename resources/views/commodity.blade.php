@include('components.header')
  <main>
    <div class="container-fluid text-center">
      <h2 class="pt-1 my-4 fw-bold">
        商品購入
      </h2>
      <h3 class="pt-1 mb-4 fw-bold update-information-h3">
        商品名：{{$name}}
      </h3>
      <p class="fw-bold">値段：{{$price}}円</p>
      <section class="text-center">
        <img src="/img/{{$img1}}" class="about-img">
      </section>
      <comodity-select></comodity-select>
    </div>
  </main>   
@include('components.footer')