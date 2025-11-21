<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <!-- Simple CSS -->
            <style>
                body {
                    font-family: 'Instrument Sans', ui-sans-serif, system-ui, sans-serif;
                    min-height: 100vh;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    background-color: #f9fafb;
                    margin: 0;
                    padding: 0;
                }
                h1 {
                    font-size: 2.25rem;
                    font-weight: 700;
                    color: #60a5fa;
                }
            </style>
        @endif
    </head>
    <body class="min-h-screen flex items-center justify-center bg-gray-50">
        <h1 class="text-4xl font-bold text-blue-400">{{ config('app.name', 'Laravel') }} budget</h1>
    </body>
</html>
