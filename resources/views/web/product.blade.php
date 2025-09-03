@extends('web.master')
@section('titel', $product->name . ' | ' . env('APP_NAME'))
@section('stayls')
    <style>
        .star-rating {
            font-size: 30px;
            direction: ltr;
            display: inline-flex;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            color: #ddd;
            cursor: pointer;
            padding: 0 3px;
        }

        .star-rating label:hover,
        .star-rating label:hover~label {
            color: gold;
        }

        .star-rating input:checked~label {
            color: gold;
        }

        .custom-btn {
            background: linear-gradient(135deg, #ff4d4d, #cc0000);
            color: #fff;
            border: none;
            padding: 10px 25px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s ease;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .custom-btn:hover {
            background: linear-gradient(135deg, #cc0000, #990000);
            transform: scale(1.05);
            box-shadow: 0px 6px 12px rgba(0, 0, 0, 0.3);
        }
    </style>
@stop
@section('content')

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area"
        style="background: rgba(0, 0, 0, 0) url({{ asset('siteasset/images/bg/2.jpg') }}) no-repeat scroll center center / cover;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">{{ $product->name }} Details</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('web.index') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">{{ $product->name }} Details</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->

    <!-- Start Product Details -->
    <section class="htc__product__details pt--120 pb--100 bg__white">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                    <div class="product__details__container">
                        <div role="tabpanel" class="tab-pane fade in active product-video-position" id="img-tab-1">
                            <img src="{{ asset('uploads/images/' . $product->image) }}" alt="full-image">
                        </div>
                    </div>
                </div>

                <!-- Product Details -->
                <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12 smt-30 xmt-30">
                    <div class="htc__product__details__inner">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="pro__detl__title">
                            <h2>{{ $product->name }}</h2>
                        </div>

                        <div class="pro__dtl__rating">
                            @php
                                $stars = round($product->reviews->avg('stars'), 2);
                                $count = 1;
                                $result = '';

                                for ($i = 1; $i <= 5; $i++) {
                                    if ($stars >= $count) {
                                        $result .= '<span><i class="zmdi zmdi-star"></i><</span>';
                                    } else {
                                        $result .= '<span><span class="ti-star"></span></span>';
                                    }
                                    $count++;
                                }
                                echo $result;
                            @endphp

                            <span class="rat__qun">( {{ round($product->reviews->avg('stars'), 2) }})</span>


                            <span class="rat__qun">( Based On ( {{ $product->reviews->count() }} )Ratings)</span>
                        </div>
                        <div class="pro__details">
                            {!! $product->description !!}
                        </div>

                        <ul class="pro__dtl__prize">
                            @if ($product->sale_price > 0)
                                <li class="old__prize">{{ $product->price }}</li>
                                <li>{{ $product->sale_price }}</li>
                            @else
                                <li>{{ $product->price }}</li>
                            @endif
                        </ul>

                        <!-- Start Add to Cart Form -->
                        <form id="myform" method="POST" action="{{ route('add-to-cart') }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="product-action-wrap">
                                <div class="prodict-statas"><span>Quantity :</span></div>
                                <div class="product-quantity">
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" type="number"
                                            max="{{ $product->quntity }}"name="qty" value="1" min="1">
                                    </div>
                                </div>
                            </div>

                            <ul class="pro__dtl__btn">
                                <li class="buy__now__btn">
                                    <button type="submit"> <i class="ti-shopping-cart"></i>Add To Cart</button>
                                </li>
                                <li><a href="#"><span class="ti-heart"></span></a></li>
                                <li><a href="#"><span class="ti-email"></span></a></li>
                            </ul>
                        </form>
                        <!-- End Add to Cart Form -->

                        <div class="pro__social__share">
                            <h2>Share :</h2>
                            <ul class="pro__soaial__link">
                                <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Details -->

    <!-- Start Product tab -->
    <section class="htc__product__details__tab bg__white pb--120">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                    <ul class="product__deatils__tab mb--60" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#description" role="tab" data-toggle="tab">Description</a>
                        </li>
                        <li role="presentation">
                            <a href="#sheet" role="tab" data-toggle="tab">Data sheet</a>
                        </li>
                        <li role="presentation">
                            <a href="#reviews" role="tab" data-toggle="tab">Reviews</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="product__details__tab__content">
                        <!-- Description Tab -->
                        <div role="tabpanel" id="description" class="product__tab__content fade in active">
                            <div class="product__description__wrap">
                                <div class="product__desc">
                                    <h2 class="title__6">Details</h2>
                                    <p>{!! $product->description !!}</p>
                                </div>
                                <div class="pro__feature">
                                    <h2 class="title__6">Features</h2>
                                    <ul class="feature__list">
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Duis aute irure dolor
                                                in reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Irure dolor in
                                                reprehenderit in voluptate velit esse</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Sed do eiusmod tempor
                                                incididunt ut labore et</a></li>
                                        <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Nisi ut aliquip ex ea
                                                commodo consequat.</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Data Sheet Tab -->
                        <div role="tabpanel" id="sheet" class="product__tab__content fade">
                            <div class="pro__feature">
                                <h2 class="title__6">Data sheet</h2>
                                <ul class="feature__list">
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Irure dolor in
                                            reprehenderit in voluptate velit esse</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Sed do eiusmod tempor
                                            incididunt ut labore et</a></li>
                                    <li><a href="#"><i class="zmdi zmdi-play-circle"></i> Nisi ut aliquip ex ea
                                            commodo consequat.</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div role="tabpanel" id="reviews" class="product__tab__content fade">
                            <div class="review__address__inner">
                                <div class="pro__review">
                                    <div class="review__thumb">
                                        <img src="{{ asset('siteasset/images/review/1.jpg') }}" alt="review images">
                                    </div>
                                    <div class="review__details">
                                        <div class="review__info">
                                            <h4><a href="#">{{ $product->name }}</a></h4>
                                            <ul class="rating">
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star"></i></li>
                                                <li><i class="zmdi zmdi-star-half"></i></li>
                                                <li><i class="zmdi zmdi-star-half"></i></li>
                                            </ul>
                                        </div>
                                        <div class="review__date">
                                            <span>27 Jun, 2016 at 2:30pm</span>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit...</p>
                                    </div>
                                </div>
                            </div>
                            @if (Auth::check())
                                <form action="{{ route('web.add_review') }}" method="POST" id="review-form">
                                    @csrf
                                    <div class="star-rating" style="margin-top: 40px">
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="radio" id="star1" name="stars" value="5" />
                                        <label for="star1" title="Star1">★</label>

                                        <input type="radio" id="star2" name="stars" value="4" />
                                        <label for="star2" title="Star2">★</label>

                                        <input type="radio" id="star3" name="stars" value="3" />
                                        <label for="star3" title="Star3">★</label>

                                        <input type="radio" id="star4" name="stars" value="2" />
                                        <label for="star4" title="Star4">★</label>

                                        <input type="radio" id="star5" name="stars" value="1" />
                                        <label for="star5" title="Star5">★</label>

                                        <div class="review__box">
                                            <div class="single-review-form">
                                                <div class="review-box message">
                                                    <textarea name="rev_content" placeholder="Write your review" style="width: 500px"></textarea>
                                                </div>
                                            </div>
                                            <div class="review-btn">
                                                <button type="submit" class="custom-btn">Submit Review</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>
                    </div>

                </div>
                @endif
                <!-- End Reviews Tab -->

            </div>
        </div>
        </div>
        </div>
    </section>
    <!-- End Product tab -->
@stop
@section('scripts')
    <script></script>
@stop
