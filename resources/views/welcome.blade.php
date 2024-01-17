<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="mN7w6BXtnbJfeqo7FdDLI9yAHI_CcDuqTrhbEXSxYSY" />
        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        
    </head>
    <body class="antialiased">
        <div>
            <h1>This Web Testing API</h1>
            @foreach ($products as $product)
                <ul>
                    <li>Name  : {{ $product->name }}</li>
                    <li>Price : {{ $product->price }}</li>
                    <li>Avaibility: {{ $product->ketersediaan }}</li>
                    <li>Desc :{{ $product->description }}</li>
                </ul>
            @endforeach
            {{ route('generateFeed') }}
            <div>
                <a href="{{ route('generateFeed') }}">Link to Feed</a>
            </div>
        </div>
    </body>
</html>
