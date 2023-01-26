@include('components.header')
  <main>
    <div class="container">
      <article class="text-center">
        <h2 class="mt-3">問い合わせ内容</h2>
        @foreach($contacts as $contact)
          <section class="border pt-3">
            <p class="px-2">件名：{{$contact -> subject}}</p>
            <p class="px-2">内容：<br>{{$contact -> content}}</p>
            <a class="btn btn-primary d-inline-block btn-hover w-25 mb-3">チャット</a>
          </section>
        @endforeach
      </article>
    </div>
  </main>   
@include('components.footer')