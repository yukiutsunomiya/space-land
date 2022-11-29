@include('components.header')
<!--
<main>
    <div class="container-fluid text-center">
      <h2 class="pt-1 my-4 fw-bold">
      <?php $user = Auth::user(); ?>{{ $user->name }}様のカート
      </h2>
      <table>
        <tr>
            <th>商品名</th><th>値段</th><th>個数</th>
        </tr>
        @foreach($carts as $cart)
        <tr>
            <th>{{$cart->name}}</th>
            <th>{{$cart->img1}}</th>
            <th>{{$cart->price}}円</th>
            <th>
                {{$cart->quantity}}
            </th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        @endforeach
      </table>
    </div>
  </main>
-->
<main>
  <article class="collaboration-article">
    <div class="container-fluid">
      <h2 class="text-center pt-4"><?php $user = Auth::user(); ?>{{ $user->name }}様のカート</h2>
      <div class="row">
        <carts-select v-bind:carts_json='{{ $carts_json }}'></carts-select>
        @foreach($carts as $cart)
          <div class="col-lg-4 col-md-6">
            <div class="">
              <div class="pt-2 px-4">
                <h5 class="text-center">{{$cart->name}}</h5>
                <p class="text-center">
                  商品金額：{{$cart->price}}円</br>
                  <select name="quantity" v-model="selectValue" required>
                    
                    @if({{$cart->quantity}})

                    @elseif
                      <option value="1">１</option>
                    @endif
                    <option value="1">１</option>
                    <option value="2">２</option>
                    <option value="3">３</option>
                    <option value="4">４</option>
                    <option value="5">５</option>
                    </select>
                  個数：{{$cart->quantity}}円</br>
                  合計金額：{{$cart->quantity}}円
                </p>
              </div>
              <img src="/img/{{$cart->img1}}" class="d-inline-block w-100">
            </div>       
          </div>
        @endforeach
      </div>
      
    </div>
  </article>
</main>
@include('components.footer')
