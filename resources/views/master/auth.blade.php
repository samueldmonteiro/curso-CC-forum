<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <title>Ciência da Computação Fórum</title>
    <link rel="stylesheet" href="{{ mix('css/vendor.css') }}">
    <link rel="stylesheet" href="{{ mix('css/style.css') }}">

</head>

<body>

    <header>
        <h1>Ciência da Computação Fórum</h1>
    </header>

    @yield('content')

    <script src="{{ mix('js/auth.js') }}"></script>
</body>

</html>

