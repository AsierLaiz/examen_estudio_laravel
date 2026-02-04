<!DOCTYPE html>
<html lang="eu">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'E2E Errepaso')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        a { color: blue; text-decoration: none; }
    </style>
</head>
<body>
    <h1>@yield('header', 'E2E Errepaso')</h1>
    @yield('content')
</body>
</html>
