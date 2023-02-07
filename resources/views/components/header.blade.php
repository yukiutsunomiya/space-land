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
    
          @auth('admin')
            <p class="fw-bold">管理者ログインユーザー名：{{ Auth::guard('admin')->user()->name }}</p>
          @endauth
          <nav class="navbar navbar-expand-md">
            <!-- ハンバーガーメニュー -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
          @if(Request::is('/') || Request::is('news') || Request::is('items') || Request::is('q-and-a') || Request::is('online-store'))
            
              <!--
                <header-nav></header-nav>
              -->
            <ul class="navbar-nav">
              <li class="nav-item dropdown py-2">
                <router-link class="nav-link dropdown-toggle fw-bold" to="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Space Land
                </router-link>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><router-link class="dropdown-item" to="/">HOME</router-link></li>
                  <li><router-link class="dropdown-item" to="/#about">ABOUT</router-link></li>
                </ul>
              </li>
            </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/news">NEWS</router-link>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class=" nav-item py-2">
                @auth
                  <router-link class="nav-link fw-bold" to="/items?session=user">ITEMS</router-link>
                @else
                  <router-link class="nav-link fw-bold" to="/items">ITEMS</router-link>
                @endauth
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/q-and-a">Q＆A</router-link>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                @auth
                  <router-link class="nav-link fw-bold" to="/online-store?session=user">ONLINE STORE</router-link>
                @else
                  <router-link class="nav-link fw-bold" to="/online-store">ONLINE STORE</router-link>
                @endauth
                </li>
              </ul>
          @else
            <ul class="navbar-nav">
              <li class="nav-item dropdown py-2">
                <a class="nav-link dropdown-toggle fw-bold" href="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Space Land
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="/">HOME</a></li>
                  <li><a class="dropdown-item" href="/#about">ABOUT</a></li>
                </ul>
              </li>
            </ul>
            <ul class="navbar-nav ">
              <li class="nav-item py-2">
                <a class="nav-link fw-bold" href="/items?session=user">ITEMS</a>
              </li>
            </ul>
          @endif
              @if (Route::has('login'))
                @auth
                  <ul class="navbar-nav">
                    <li class="nav-item dropdown py-2">
                      <a class="nav-link dropdown-toggle fw-bold" href="/" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        ユーザー管理情報
                      </a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="/carts">CARTS</a></li>
                        <li><a class="dropdown-item" href="/purchases">購入履歴</a></li>
                        <li><a class="dropdown-item" href="/inquiryList">お問い合わせ履歴</a>
                        <li><a class="dropdown-item" href="/user">ユーザー情報</a>
                      </ul>
                    </li>
                  </ul>
                  <ul class="navbar-nav">
                    <li class="nav-item py-2">
                      <a href="{{ route('logout') }}" 
                          onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" class="nav-link fw-bold">
                          {{ __('Logout') }}
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                    </li>
                  </ul>
                  
                @else
                  <ul class="navbar-nav">
                    <li class="nav-item py-2">
                      <a href="{{ route('login') }}" class="nav-link fw-bold">login</a>
                    </li>
                  </ul>
                  @if (Route::has('register'))
                    <ul class="navbar-nav">
                      <li class="nav-item py-2">
                        <a href="{{ route('register') }}" class="nav-link fw-bold">Register</a>
                      </li>
                    </ul>
                  @endif
                @endauth
              @endif
              @if(!(Request::is('/contactconfirm')))
              <ul class="navbar-nav ">
                <li class="nav-item py-2">
                  <a class="nav-link fw-bold" href="/contact">CONTACT</a>
                </li>
              </ul>
              @endif
            </div>
          </nav>
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