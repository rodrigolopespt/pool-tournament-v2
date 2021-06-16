<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600;800&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('/assets/css/custom.css')}}">
        <title>BOLD Pool Challenge</title>
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light my-md-2">
                <a class="navbar-brand mr-auto" href="/">
                    <h3 class="header-title">Pool Tournament</h3>
                </a>
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu"
                    aria-controls="navbarsExample10" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" style="justify-content: flex-end;" id="menu">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                    </ul>
                </div> -->
            </nav>
            <hr>
            <div class="row mt-2">
                <div class="col-md-5">
                    @include('partials.rankingBlock')
                </div>
                <div class="col-md-7">
                    @include('partials.gamesBlock')
                </div>
            </div>         
        </div>
        @include('partials.addGameModal')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{asset('/assets/js/app.js')}}"></script>
    </body>
</html>
