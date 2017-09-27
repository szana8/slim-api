<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Slim</title>

    <!-- Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link href="css/app.css" rel="stylesheet" type="text/css">
    <style>
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
        -webkit-transition-delay: 9999s;
        transition-delay: 9999s;
        }
    </style>
    <link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">

</head>
    <body>
        <div id="app">
            <app></app>
        </div>

        <script src="js/app.js"></script>
    </body>
</html>
