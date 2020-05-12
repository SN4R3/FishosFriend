<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | FishosFriend</title>
    {{-- Fonts --}}
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <!-- Styles -->
    <style>
      html, body {
        min-height: 100vh;
        margin: 0;
      }
      #app {
        background-color: #f5f5f5;
        border-color: #f5f5f5;
      }
    </style>
  </head>
  <body>
    <div id="app">
      <v-app>
        <nav-bar></nav-bar>
        @yield('content')
      </v-app>
    </div>
    <script src="{{asset('/js/app.js')}}"></script>
  </body>
</html>
