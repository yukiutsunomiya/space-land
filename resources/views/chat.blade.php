<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--
      <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    -->
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
  <body>
    <div id="app">
      <header class="header">
        <div class="container">
          <h2 class="fw-bold text-center mb-0 mt-2">Space Land</h2>
          <p class="fw-bold text-center my-3 ">（株）総合研究舎</p>
          @auth
            <p class="fw-bold">ログインユーザー名：<?php $user = Auth::user(); ?>{{ $user->name }}</p>
          @endauth
          
        </div>
        
        <!--
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        <--
        <!-- / ナビゲーション -->
      </header>
      <main class="w-4/5 md:w-3/5 lg:w-2/5 m-auto">
        {{-- アプリのタイトル（.envに設定されているアプリ名を取得） --}}
        <h1 class="my-4 text-3xl font-bold">{{env('APP_NAME')}}</h1>
            <ul>
                {{-- チャットデータを繰り返し表示 --}}
                @foreach ($chats as $chat)
                  @auth
                    <p class="text-xs @if($chat->user_name ==  $user->name ) text-right @endif">{{$chat->created_at}} ＠{{$chat->user_name}}</p>
                    <li class="w-max mb-3 p-2 rounded-lg bg-blue-200 relative @if($chat->user_name ==  $user->name) self ml-auto @else other @endif">
                        {{$chat->message}}
                    </li>
                  @else
                    <p class="text-xs @if($chat->user_identifier == session('user_identifier')) text-right @endif">{{$chat->created_at}} ＠{{$chat->user_name}}</p>
                    <li class="w-max mb-3 p-2 rounded-lg bg-blue-200 relative @if($chat->user_identifier == session('user_identifier')) self ml-auto @else other @endif">
                        {{$chat->message}}
                    </li>
                  @endauth                                        
                @endforeach
            </ul>
        </div>

        {{-- 入力フォーム --}}
        <form class="my-4 py-2 px-4 rounded-lg bg-gray-300 text-sm flex flex-col md:flex-row flex-grow" action="/chat" method="POST">
            @csrf
            {{-- ユーザー識別子を隠しパラメータで保有 --}}
            <input type="hidden" name="user_identifier" value={{session('user_identifier')}}>
            
            @auth
              {{-- ユーザー名フォーム --}}
              <input class="py-1 px-2 rounded text-center flex-initial" type="text" name="user_name" placeholder="UserName" maxlength="20" value="{{ $user->name }}" required>
            @else
              <input class="py-1 px-2 rounded text-center flex-initial" type="text" name="user_name" placeholder="UserName" maxlength="20" value="{{session('user_name')}}" required>
            @endauth
            
            {{-- メッセージフォーム --}}
            <input class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded flex-auto" type="text" name="message" placeholder="Input message." maxlength="200" autofocus required>
            {{-- 送信ボタン --}}
            <button class="mt-2 md:mt-0 md:ml-2 py-1 px-2 rounded text-center bg-gray-500 text-white" type="submit">送信</button>
        </form>
        <script src="https://cdn.tailwindcss.com"></script>
      </main>
@include('components.footer')