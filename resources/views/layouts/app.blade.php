<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
        <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
            body, html {
                height: 100%;
                color: #777;
                line-height: 1.8;
            }

            /* Create a Parallax Effect */
            .bgimg-1, .bgimg-2, .bgimg-3 {
                background-attachment: fixed;
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
            }

            /* First image (Logo. Full height) */
            .bgimg-1 {
                background-image: url('/w3images/parallax1.jpg');
                min-height: 100%;
            }

            /* Second image (Portfolio) */
            .bgimg-2 {
                background-image: url("/w3images/parallax2.jpg");
                min-height: 400px;
            }

            /* Third image (Contact) */
            .bgimg-3 {
                background-image: url("/w3images/parallax3.jpg");
                min-height: 400px;
            }

            .w3-wide {letter-spacing: 10px;}
            .w3-hover-opacity {cursor: pointer;}

            /* Turn off parallax scrolling for tablets and phones */
            @media only screen and (max-device-width: 1600px) {
                .bgimg-1, .bgimg-2, .bgimg-3 {
                    background-attachment: scroll;
                    min-height: 400px;
                }
            }
        </style>
    </head>
    <body>

        <!-- Navbar (sit on top) -->
        <div class="w3-top">
            <div class="w3-bar" id="myNavbar">
                <a class="w3-bar-item w3-button w3-hover-black w3-hide-medium w3-hide-large w3-right" href="javascript:void(0);" onclick="toggleFunction()" title="Toggle Navigation Menu">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="/home" class="w3-bar-item w3-button">HOME</a>
                <a href="/books" class="w3-bar-item w3-button w3-hide-small"><i class="	fa fa-thumbs-o-up"></i> NEW ARRIVALS</a>
                <a href="/bookXML" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-th"></i> CURRENT BOOKS LIST</a>
                <a href="/checkout" class="w3-bar-item w3-button w3-hide-small"><i class="fa fa-shopping-cart"></i> CHECKOUT</a>

                </a>
                <!-- Right Side Of Navbar -->

                <!-- Authentication Links -->
                @guest
                @if (Route::has('login'))
                <a class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red" href="{{ route('login') }}">{{ __('Login') }}</a>
                @endif

                @if (Route::has('register'))
                <a class="w3-bar-item w3-button w3-hide-small w3-right w3-hover-red" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif

                @else

                <div class="w3-bar-item w3-hide-small w3-right" aria-labelledby="navbarDropdown">
                    <a class="w3-bar-item w3-button w3-hide-small w3-right" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>


                    <a class="w3-bar-item w3-button w3-hide-small w3-right" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-money"></i>Tokens: {{ Auth::user()->tokens }}
                    </a>
                    <a class="w3-bar-item w3-button w3-hide-small w3-right " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i> Welcome back, {{ Auth::user()->name }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
                @endguest

            </div>

        </div>
        <br><br><br>



    <main class="py-4">
        @yield('content')
    </main>
</body>
</html>
