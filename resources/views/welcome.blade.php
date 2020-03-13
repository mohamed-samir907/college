<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="frontend/css/app.css">
    </head>
    <body>
        <div id="app">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm">
                        <data-table endpoint="{{ route('admin.courses.index') }}"></data-table>
                    </div>
                </div>
            </div>
        </div>
        <script src="frontend/js/app.js"></script>
    </body>
</html>
