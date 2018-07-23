<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="./images/fav.png" />
    <!-- Css Files -->
    <link href="{{ asset('css/custom-new.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/color.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet" />

    <style>

		html body {
			background: none;
		}

    .owl-prev, .owl-next {
      background-color: #00aeef;
			height: 25%
    }

		div#featured-slider.owl-theme .owl-nav [class*=owl-] {
			color: #FFF;
			font-size: 0;
			margin: 0;
			padding: 0;
			background: #00aeef;
			display: inline-block;
			cursor: pointer;
			border-radius: 0;
			width: 35px;
			height: 50px;
			text-align: center;
			line-height: 50px;
			position: relative;
		}

		div#featured-slider.owl-theme .owl-nav [class*=owl-]:hover {
			background: #00aeef;
			color: #fff;
		}

    .news-section-wrapper {
      box-shadow:none;
    }


    </style>

    @yield('css')

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

    <!--Wrapper Start-->
    <div class="wrapper-full color-option-2">
       <!--Header Start-->
        <header class="header color-2" id="header">
            <div class="logo-nav">
                <div class="container">
                    <div class="row">
                        <!--Logo Start-->
                        <div class="col-md-3 nop">
                            <div class="logo">
                                <a href="{{ route('home') }}"> <!--<img src="./images/logo.png" alt="" />--> <h2>BSPORTS</h2></a>
                            </div>
                        </div>
                        <!--Logo End-->

                        <!--Nav Start-->
                        <div class="col-md-9">
                            @include('layouts.includes.menu')
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.second-menu')

            @if(\App\Helpers\Helper::getConfig('categorias-home'))
                @yield('categorias')
            @endif
        </header>

				@yield('content')

        @include('partials.footer')

    </div>
    <!--Wrapper Div End-->

    <!--Js Files Start-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-1.4.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ticker.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.4/holder.min.js"></script>

    @yield('js')
</body>

</html>
