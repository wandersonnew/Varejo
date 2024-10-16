<!-- resources/views/components/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Todo Manager' }}</title>

    <style>
        body {
            background-image: url('index-background.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
            opacity: 0.9;
        }
    </style>


    <link rel="shortcut icon" href="shop.svg" type="image/x-icon">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>
<body>

    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <div class="navbar-brand">{{ $navtitle ?? '' }}</div>
            @if (Route::has('login'))
                <div class="ms-auto">
                    <livewire:welcome.navigation />
                </div>
            @endif
        </div>
    </nav>    


    {{ $slot }}
    @livewireScripts
</body>
</html>
