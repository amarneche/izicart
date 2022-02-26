@extends('customer.clean.layouts.app')
@section('page-title')
    <title>Products page </title>
@endsection
@section('content')
    <main class="page catalog-page">
        <section class="clean-block clean-catalog dark">
            <div class="container">
                <div class="block-heading">
                    <h2 class="text-info">{{ __('Our Catalog') }}</h2>
                    <p>{{ __('Catalog Page Description') }}</p>
                </div>
                <div class="row mb-5 p-3">
                    <div class="col-md-12">
                        <div class="products">
                            <div class="row g-4">
                                @foreach ($products as $product)
                                    <div class="col-12 col-md-6 col-lg-4 ">
                                        <div class="clean-product-item bg-white shadow-sm ">
                                            <div class="image"><a
                                                    href="{{ route('customer.products.show', ['product' => $product]) }}"><img
                                                        class="img-fluid d-block mx-auto"
                                                        src="{{ $product->featured_image->url }}"></a></div>
                                            <div class="product-name"><a
                                                    href="{{ route('customer.products.show', ['product' => $product]) }}">{{ $product->title }}</a>
                                            </div>
                                            <div class="about">
                                                <div class="rating">
                                                    <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                                    <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                                    <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                                    <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                                    <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                                </div>
                                                <div class="price">
                                                    <h3>{{ $product->price }}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ $products->links() }}
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </main>
@endsection
