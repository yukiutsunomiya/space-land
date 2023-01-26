@include('components.header')
    <main>
        @if ($errors->any())  {{--  エラーがあれば出力する --}}
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        @endif

        <form method="POST" action="{{ route("admin.login") }}">  {{--  routeはここと同じ --}}
            @csrf
            <label for="email">Mail</label>
            <input type="text" id="email" name="email">
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
            <button type="submit">Login</button>
        </form>
    </main> 
@include('components.footer')