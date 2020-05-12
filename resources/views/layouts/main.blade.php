<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | FishosFriend</title>

      <!-- Styles -->
      <style>
        html, body {
          min-height: 100vh;
          margin: 0;
        }
      </style>
  </head>
  <body>
    <div id="app">
      @yield('content')
    </div>
  </body>
</html>
