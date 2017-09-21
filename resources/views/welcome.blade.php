<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Slim</title>

    <!-- Fonts -->
    <link href="css/app.css" rel="stylesheet" type="text/css">

</head>
    <body>
        <div id="app">
            <app></app>
        </div>

        <script src="js/app.js"></script>
    </body>
</html>
