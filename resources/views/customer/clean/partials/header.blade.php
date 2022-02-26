<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
     @yield('page-title')

    <meta name="twitter:description" content="site_description">
    <meta name="twitter:card" content="summary_large_image">
    <meta property="og:title" content="site_title">
    <meta property="og:type" content="website">
    <meta name="description" content="site description">
    <meta property="og:image" content="themes/clean/img/tech/image4.jpg">
    <meta property="og:description" content="site_description">
    <meta name="twitter:title" content="site_title">

    <link rel="icon" type="image/jpeg" sizes="1600x1068" href="themes/clean/img/tech/image4.jpg">
    <link rel="stylesheet" href="{{route('customer.serveCSS')}}">
    <link rel="manifest" href="manifest.json">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
    <link rel="stylesheet" href="{{global_asset("themes/clean/fonts/simple-line-icons.min.css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
    <link rel="stylesheet" href="{{global_asset("themes/clean/css/styles.min.css")}}">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-lg fixed-top bg-white clean-navbar">
        <div class="container"><a class="navbar-brand logo" href="{{route('customer.homePage')}}">{{tenant()->store_name}}</a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="{{route('customer.homePage')}}">Home</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{route('customer.products.index')}}">Products</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{route('customer.showCartPage')}}">Cart</a></li>
                    <li class="nav-item"><a class="nav-link " href="{{route('customer.showCheckoutPage')}}">Checkout</a></li>

                </ul>
            </div>
        </div>
    </nav>