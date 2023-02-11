@include('components.header')
  <main>
    <div class="container">
      <article class="text-center mb-3">
        <h2 class="mt-3">問い合わせ一覧</h2>
        <a class="btn btn-primary d-inline-block btn-hover w-25 mb-3">チャット</a>
        @foreach($contacts as $contact)
          <div class="p-2 border border-dark hover btn-hover">
            <a href="inquiry?id={{$contact->id}}">返信希望：{{$contact -> replyRequest}} &emsp; 件名：{{$contact -> content}} &emsp; メールアドレス：{{$contact-> email}} </a><br>
          </div>
        @endforeach
      </article>
    </div>
  </main>   
@include('components.footer')