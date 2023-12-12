<!-- resources/views/components/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your App Title')</title>
    <!-- Add your stylesheets, scripts, etc. here -->
</head>

<body>
    <header>
        <h1>Organizational Tree</h1>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer>
        <!-- Your footer content goes here -->
    </footer>

    <!-- Add your scripts, analytics, etc. here -->
</body>

</html>
