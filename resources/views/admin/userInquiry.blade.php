@include('components.adminHeader')
<main>
    <div class="container">
      <article class="text-center mb-3">
        <h2 class="mt-3">{{$user_name}}様の問い合わせ内容</h2>
            <section class="border py-3">
                <p class="px-2">返信希望：{{$contact -> replyRequest}}</p>
                <p class="px-2">件名：{{$contact -> subject}}</p>
                <p class="px-2">メールアドレス：{{$contact -> email}}</p>
                <p class="px-2">内容：<br>{{$contact -> content}}</p>
                <p class="px-2">対応状況：<br>{{$contact -> admin_situation}}</p>
                <form method="get" action="/admin/situationUpdate">
                    <input type="hidden" value="{{$user_name}}" name="user_name">
                    <input type="hidden" value="{{$contact->id}}" name="id">
                    <label for="contactSituation" class="">対応状況：</label>
                    <select id="contactSituation" name="admin_situation" class=" inline-block">
                        <option value="選択してください。" selected disabled>選択してください。</option>
                        <option value="対応中">対応中</option>
                        <option value="対応済み">対応済み</option>
                        <option value="完了">完了</option>
                    </select><br>
                    <button type="submit" class="btn btn-primary d-inline-block mt-2 ml-2 btn-hover w-25">対応状況変更</button>
                </form>
            </section>
            <a href="../admin/userInquiryList?id={{$contact->user_id}}&name={{$user_name}}" class="btn btn-primary d-inline-block btn-hover w-25 my-3">{{$user_name}}様のお問い合わせ一覧へ</a>
      </article>
    </div>
  </main>
@include('components.footer')