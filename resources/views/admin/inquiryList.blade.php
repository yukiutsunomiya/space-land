@include('components.adminHeader')
  <main>
    <div class="container">
      <article class="text-center mb-3">
        <h2 class="mt-3">問い合わせ一覧</h2>
        <a class="btn btn-primary d-inline-block btn-hover w-25 mb-3">チャット一覧へ</a>
        @foreach($contacts as $contact)
          @php
            $date = new DateTime($contact-> created_at);
            $date->modify('+9 hours');
            $contactTime =$date->format('Y年m月d日 H時');
          @endphp
          <div class="p-2 border border-dark hover btn-hover">
            <a href="../admin/inquiry?id={{$contact->id}}">対応状況：{{$contact -> admin_situation}} &emsp; 問い合わせ日時：{{$contactTime}} &emsp;返信希望：{{$contact -> replyRequest}} &emsp;ユーザー名：{{$contact -> name}} &emsp; 件名：{{$contact -> subject}} &emsp; メールアドレス：{{$contact-> email}} </a><br>
          </div>
        @endforeach
      </article>
    </div>
  </main>   
@include('components.footer')