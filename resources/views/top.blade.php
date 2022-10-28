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

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
</head>
  <body>
    <div id="app">
      <header class="header">
        <div class="container">
          <h2 class="fw-bold text-center mb-0">Space Land</h2>
          <p class="fw-bold text-center my-3 ">（株）総合研究舎</p>
          @auth
            <p class="fw-bold">ログインユーザー名：<?php $user = Auth::user(); ?>{{ $user->name }}</p>
          @endauth
          <nav class="navbar navbar-expand-md">
            <!-- ハンバーガーメニュー -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-around" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/">HOME</router-link>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/#about">ABOUT</router-link>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/news">NEWS</router-link>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class=" nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/items">ITEMS</router-link>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/q-and-a">Q＆A</router-link>
                </li>
              </ul>
              <ul class="navbar-nav">
                <li class="nav-item py-2">
                  <router-link class="nav-link fw-bold" to="/online-store">ONLINE STORE</router-link>
                </li>
              </ul>
              @if (Route::has('login'))
                @auth
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
      <main>
          <router-view/>
      </main>
      <footer>
        <p class="text-center fw-bold text-light">
          Copyright (C) 2017 Foreign Policy Center. All Rights Reserved.
        </p>
      </footer>
    </div>
  </body>  
</html>