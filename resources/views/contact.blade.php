@include('components.header')
  <main>
    <article id="contact">
        <h2 class="text-center mt-4 mb-2">contact</h2>
        <p class="text-center">お問い合わせ・もにまるずの販売・​コラボ制作依頼は</p>
        <p class="text-center">メール・もしくは以下のフォームからご連絡ください。</p>
        <div class="button_wrapper">
            <section>
            <?php $user = Auth::user(); ?>
                <a href="/chat??{{$user->name}}" class="btn btn-primary d-inline-block mb-5 btn-hover w-25 ">チャットで対応の方</a>
                <form action = "/contactconfirm" method="get">
                    @if(isset($name))
                        <input placeholder="お名前" class="d-inline-block mb-3 w-25" name = "name" value="{{$name}}" required><br>
                        <input placeholder="メールアドレス" class="d-inline-block mb-3 w-25" name = "email" value="{{$email}}" required><br>
                        <label for="replyRequestOk"><input id="replyRequestOk" type="radio" name="replyRequest" value="返信を希望" required>返信を希望　</label>
	                    <label for="replyRequestNo"><input id="replyRequestNo" type="radio" name="replyRequest" value="返信を希望しない">返信を希望しない </label><br>
                        <input placeholder="件名" class="d-inline-block mb-3 w-25" name = "subject" value="{{$subject}}" required><br>
                        <textarea placeholder="メッセージを入力してください。" class="d-inline-block mb-4 w-25" name = "content" value="{{$content}}" required></textarea>
                    @else
                        <input placeholder="お名前" class="d-inline-block mb-3 w-25" name = "name" value="" required><br>
                        <input placeholder="メールアドレス" class="d-inline-block mb-3 w-25" name = "email" value="" required><br>
                        <label for="replyRequestOk"><input id="replyRequestOk" type="radio" name="replyRequest" value="返信を希望" required>返信を希望　</label>
	                    <label for="replyRequestNo"><input id="replyRequestNo" type="radio" name="replyRequest" value="返信を希望">返信を希望しない </label><br>
                        <input placeholder="件名" class="d-inline-block mb-3 w-25" name = "subject" value="" required><br>
                        <textarea placeholder="メッセージを入力してください。" class="d-inline-block mb-4 w-25" name = "content" value="" required></textarea>
                    @endif
                        <br>
                        <button type="submit" class="btn btn-primary d-inline-block mb-5 btn-hover w-25">送信する</button>
                </form>
            </section>
        </div> 
    </article>
  </main>
@include('components.footer')