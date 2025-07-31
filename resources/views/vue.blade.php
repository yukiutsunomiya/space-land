<!DOCTYPE html>
<html lang="ja">
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
        <main id="app">
            <!-- Vue.jsアプリケーションがここにマウントされます -->
            
        </main>
        <footer>
            <p class="text-center fw-bold text-light">
            Copyright (C) 2017 Foreign Policy Center. All Rights Reserved.
            </p>
        </footer>
    </body>
</html>