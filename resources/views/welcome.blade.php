<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Laravel</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="preload" href="{{ asset('fonts/Inter-Regular.ttf') }}" as="font" type="font/ttf" crossorigin>

  <style>
    @font-face {
      font-family: "Inter-Regular";
      src: url("{{ asset('fonts/Inter-Regular.ttf') }}");
      font-style: normal;
      font-weight: 400;
    }
  </style>
</head>

<body class="antialiased text-neutral-800">
  <x-layouts.main-layout />
</body>

</html>
