@extends('customer.clean.layouts.app')
@section('page-title')
    <title>{{ $product->title }} </title>
@endsection
@section('content')
    <main class="page product-page">
        <section class="clean-block clean-product dark">
            <div class="container">

                <div class="block-content">
                    <div class="product-info">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="gallery">
                                    <div id="product-preview" class="vanilla-zoom">
                                        <div class="zoomed-image"></div>
                                        <div class="sidebar">
                                            <img src="{{ $product->featured_image->url }}" alt=""
                                                class="img-fluid d-block small-preview ">
                                            @foreach ($product->gallery as $image)
                                                <img class="img-fluid d-block small-preview" src="{{ $image->url }}">
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info">
                                    <h3>{{ $product->title }}</h3>
                                    <div class="rating">
                                        <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                        <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                        <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                        <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                        <img src="{{global_asset("themes/clean/img/star.svg")}}">
                                    </div>
                                    <div class="price">
                                        <h3>{{ $product->price }} DZD</h3>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="summary">
                                                <p>
                                                    {{ $product->short_description }}
                                                </p>
                                            </div>
                                        </div>

                                        <form
                                            action="{{ route('customer.products.quickOrder', ['product' => $product]) }}"
                                            method="post">
                                            @csrf
                                            @method('post')
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Full name') }}</label>
                                                        <input type="text" class="form-control" name="full_name" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Phone number') }}</label>
                                                        <input type="text" class="form-control" name="phone" id=""
                                                            aria-describedby="helpId" placeholder="">
                                                        <span class="text-danger"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Choose wilaya') }}</label>
                                                        <select class="form-control" name="wilaya_id" id="">
                                                            <option></option>
                                                            <option></option>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="form-group">
                                                        <label for="">{{ __('Choose Commmune') }}</label>
                                                        <select class="form-control" name="commune_id" id="">
                                                            <option></option>
                                                            <option></option>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">

                                                    <button class="btn  w-100 btn-primary btn-block" type="submit"><i
                                                            class="icon-basket"></i>{{ __('Order Now') }}</button>

                                                </div>
                                            </div>
                                        </form>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-info">

                    </div>
                    <div class="product-info">
                        <div>
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                                <li class="nav-item" role="presentation"><a class="nav-link active" role="tab"
                                        data-bs-toggle="tab" id="description-tab" href="#description">Description</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab"
                                        data-bs-toggle="tab" id="specifications-tabs"
                                        href="#specifications">Specifications</a></li>
                                <li class="nav-item" role="presentation"><a class="nav-link" role="tab"
                                        data-bs-toggle="tab" id="reviews-tab" href="#reviews">Reviews</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active description" role="tabpanel" id="description">
                                    {!! $product->description !!}
                                </div>
                                <div class="tab-pane fade specifications" role="tabpanel" id="specifications">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="stat">Display</td>
                                                    <td>5.2"</td>
                                                </tr>
                                                <tr>
                                                    <td class="stat">Camera</td>
                                                    <td>12MP</td>
                                                </tr>
                                                <tr>
                                                    <td class="stat">RAM</td>
                                                    <td>4GB</td>
                                                </tr>
                                                <tr>
                                                    <td class="stat">OS</td>
                                                    <td>iOS</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="reviews">
                                    <div class="reviews">
                                        <div class="review-item">
                                            <div class="rating"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star-empty.svg"></div>
                                            <h4>Incredible product</h4><span class="text-muted"><a href="#">John
                                                    Smith</a>, 20 Jan 2018</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc,
                                                pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit
                                                amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                    <div class="reviews">
                                        <div class="review-item">
                                            <div class="rating"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star-empty.svg"></div>
                                            <h4>Incredible product</h4><span class="text-muted"><a href="#">John
                                                    Smith</a>, 20 Jan 2018</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc,
                                                pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit
                                                amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                    <div class="reviews">
                                        <div class="review-item">
                                            <div class="rating"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star-empty.svg"></div>
                                            <h4>Incredible product</h4><span class="text-muted"><a href="#">John
                                                    Smith</a>, 20 Jan 2018</span>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec augue nunc,
                                                pretium at augue at, convallis pellentesque ipsum. Lorem ipsum dolor sit
                                                amet, consectetur adipiscing elit.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clean-related-items">
                        <h3>Related Products</h3>
                        <div class="items">
                            <div class="row justify-content-center">
                                <div class="col-sm-6 col-lg-4">
                                    <div class="clean-related-item">
                                        <div class="image"><a href="#"><img class="img-fluid d-block mx-auto"
                                                    src="assets/img/tech/image2.jpg"></a></div>
                                        <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                            <div class="rating"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star-half-empty.svg"><img
                                                    src="assets/img/star-empty.svg"></div>
                                            <h4>$300</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="clean-related-item">
                                        <div class="image"><a href="#"><img class="img-fluid d-block mx-auto"
                                                    src="assets/img/tech/image2.jpg"></a></div>
                                        <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                            <div class="rating"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star-half-empty.svg"><img
                                                    src="assets/img/star-empty.svg"></div>
                                            <h4>$300</h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4">
                                    <div class="clean-related-item">
                                        <div class="image"><a href="#"><img class="img-fluid d-block mx-auto"
                                                    src="assets/img/tech/image2.jpg"></a></div>
                                        <div class="related-name"><a href="#">Lorem Ipsum dolor</a>
                                            <div class="rating"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star.svg"><img src="assets/img/star.svg"><img
                                                    src="assets/img/star-half-empty.svg"><img
                                                    src="assets/img/star-empty.svg"></div>
                                            <h4>$300</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
