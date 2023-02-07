@include('components.adminHeader')
<main>
    <div class="container my-5">
        <h3>ユーザー情報</h3>
        @foreach($users as $user)
            <div class="p-2 border border-dark hover btn-hover">
                <a href="../admin/user?id={{$user->id}}">番号：{{$user-> id}} &emsp; 名前：{{$user-> name}} &emsp; メールアドレス：{{$user-> email}} &emsp; 電話番号：{{$user-> telephone}}</a><br>
            </div>
        @endforeach  
    </div>
</main>
@include('components.footer')