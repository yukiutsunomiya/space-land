@include('components.header')
<main>
    <article class="text-center">
        <h2 class="mt-3">内容確認</h2>
        <div>
            <form method="get" action="/sendContact">
                <p>名前：{{$name}}</p>
                <input name="name" value="{{$name}}" type="hidden">
                <p>メールアドレス：{{$email}}</p>
                <input name="email" value="{{$email}}" type="hidden">
                <p>返信希望：{{$replyRequest}}</p>
                <input name="replyRequest" value="{{$replyRequest}}" type="hidden">
                <p>件名：{{$subject}}</p>
                <input name="subject" value="{{$subject}}" type="hidden">
                <p>内容：{{$content}}</p>
                <input name="content" value="{{$content}}" type="hidden">
                <input type="hidden" name = "admin_situation" value="対応中">
                <button type="submit" name="back" class="btn btn-primary d-inline-block mb-3 btn-hover w-25">入力内容修正</button><br>
                <button type="submit" name="submit" onclick="return confirm('送信でよろしいでしょうか？')" class="btn btn-primary d-inline-block mb-4 btn-hover w-25">送信する</button>
            </form>
        </div>
    </article>
</main>
@include('components.footer')