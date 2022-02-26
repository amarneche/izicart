@extends('customer.clean.layouts.app')
@section('page-title')
    <title>{{ tenant()->store_name }}</title>
@endsection
@section('content')
    <main>
        <section class="clean-block clean-hero"
            style="background-image:url(&quot;assets/img/tech/image4.jpg&quot;);color:rgba(9, 162, 255, 0.85);">
            <div class="text">
                <h2>Lorem ipsum dolor sit amet.</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis
                    vitae leo.</p><button class="btn btn-outline-light btn-lg" type="button">Learn More</button>
            </div>
        </section>
        <section class="featured-products">
            <div class="container">

                <div class="products">
                    <div class="row g-0">
                        @foreach ($featuredProducts as $product)
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="clean-product-item">
                                    <div class="image">
                                        <a href="{{ route('customer.products.show', ['product' => $product]) }}">
                                            <img class="img-fluid d-block mx-auto"
                                                src="{{ $product->featured_image->getUrl() }}">
                                        </a>
                                    </div>
                                    <div class="product-name">
                                        <a href="{{ route('customer.products.show', ['product' => $product]) }}">{{ $product->title }}
                                        </a>
                                    </div>
                                    <div class="about">
                                        <div class="rating">
                                            <img src="{{ global_asset('themes/clean/img/star.svg') }}">
                                            <img src="{{ global_asset('themes/clean/img/star.svg') }}">
                                            <img src="{{ global_asset('themes/clean/img/star.svg') }}">
                                            <img src="{{ global_asset('themes/clean/img/star.svg') }}">
                                            <img src="{{ global_asset('themes/clean/img/star.svg') }}">

                                        </div>
                                        <div class="price">
                                            <h3>$100</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    {{ $featuredProducts->links() }}
                </div>


            </div>
        </section>
        @include('customer.clean.partials.faq')
    </main>
@endsection
