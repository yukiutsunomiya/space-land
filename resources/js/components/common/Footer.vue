<template>
    <div>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
  
      <!-- CSRFトークン -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
  
      <title>{{ config('app.name', 'Laravel') }}</title>
    
      <!-- フォント -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <!-- jQuery（BootstrapのJavaScriptプラグインに必要） -->
      <!--
        <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
      -->
      <link href="@vite(['resources/sass/app.scss'])">
      <!--
        <script src="@vite(['resources/js/app.js'])"></script>
      -->
    </div>
</template>
    
    <script>
    export default {
      name: 'Head',
    }
    </script>
    
    <style scoped>
    /* スタイルをここに追加 */
    </style>