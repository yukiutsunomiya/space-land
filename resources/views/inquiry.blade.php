@include('components.header')
<main>
    <div class="container">
      <article class="text-center mb-3">
        <h2 class="mt-3">問い合わせ内容</h2>
            <section class="border pt-3">
              <p class="px-2">返信希望：{{$contact -> replyRequest}}</p>
              @php
                $date = new DateTime($contact-> created_at);
                $date->modify('+9 hours');
                $contactTime =$date->format('Y年m月d日 H時');
              @endphp
              <p class="px-2">問い合わせ日時：{{$contactTime}}</p>
              <p class="px-2">メールアドレス：{{$contact -> email}}</p>
              <p class="px-2">件名：{{$contact -> subject}}</p>
              <p class="px-2">内容：<br>{{$contact -> content}}</p>
            </section>
            <a href="/inquiryList" class="btn btn-primary d-inline-block btn-hover w-25 my-3">お問い合わせ一覧へ</a>
      </article>
    </div>
  </main>   
@include('components.footer')

        