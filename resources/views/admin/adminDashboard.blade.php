@include('components.adminHeader')
    <main>
        <ul>
            <li>
                ログイン中：{{ Auth::guard('admin')->user()->name ?? 'undefined' }}
            </li>
            <li>
                <a href="{{ route('admin.logout') }}">
                    ログアウト
                </a>
            </li>
        </ul>
    </main> 
@include('components.footer')