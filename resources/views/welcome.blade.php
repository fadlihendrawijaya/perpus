<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <style>
            html, body {
                background-color: #fff;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .navbar {
                padding-bottom: 90px;
            }

            .full-height {
                height: 6vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: left;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                right: 10px;
                top: 18px;
            }

            .links > a {
                color: black;
                padding: 8px 40px 8px 40px;
                font-size: 15px;
                font-weight: 700;
                letter-spacing: .1rem;
                text-decoration: none;
                border: 1px;
                border-style: solid;
                border-radius: 18px;
            }

            .links > a:hover{
                background-color: #3490dc;
                color: white;
                border-radius: 18px;
            }

            .img {
                padding-left: 40px;
            }

            .m-b-md {
                text-align: justify;
                padding: 30px 0px 0px 60px;
            }
            .title {
                font-weight: 700;
                font-size: 50px;
            }

            .span{
                color: #3490dc;
                padding: 0;
            }
            .paragh {
                font-size: 19px;
                font-weight: 200;
                width: 60vh;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                    <div class="navbar-header">
                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <b><Strong>MAN<span class = "text-primary">Perpus</span></Strong></b>
                    </a>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="row">
                    <div class="img col-lg-6">
                        <img src="/image/6607.jpg" alt="Image" width="650px" height="350px">
                    </div>
                    <div class="col-lg-6 m-b-md">
                        <Strong class="title">MAN<span class = "span">Perpus</span></Strong>
                        <p class="paragh">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit distinctio itaque quidem assumenda vero enim odio quasi. Distinctio, voluptatum repudiandae explicabo at exercitationem magni eveniet, rem adipisci doloribus, quis maxime.</p>
                        <div class="flex-center position-ref full-height">
                            @if (Route::has('login'))
                                <div class="top-right links">
                                    @auth
                                        <a href="{{ url('/home') }}">Home</a>
                                    @else
                                        <a href="{{ route('login') }}">Login</a>
                
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}">Register</a>
                                        @endif
                                    @endauth
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
