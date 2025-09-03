@extends('web.master')
@section('content')
    <style>
        .pro__thumb a img {

            height: 200px;
            object-fit: cover;
        }
    </style>

    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area"
        style="background: rgba(0, 0, 0, 0) url({{ asset('siteasset/images/bg/2.jpg') }}) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">SHOP</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('web.index') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">SHOP</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- Start Our Product Area -->
    <section class="htc__product__area shop__page ptb--130 bg__white">
        <div class="container">
            <div class="htc__product__container">
                <div class="row">
                    <div class="product__list another-product-style">
                        <!-- Start Single Product -->
                        @foreach ($products as $product)
                            <div class="col-md-3 single__pro col-lg-3  col-sm-4 col-xs-12">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                            <a href="{{ route('web.product', $product->id) }}">
                                                <img src="{{ asset('uploads/images/' . $product->image) }}"
                                                    alt="product images">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="product__details">
                                        @php
                                            $name = 'name_' . App::currentLocale();
                                        @endphp
                                        <h2><a href="{{ route('web.product', $product->id) }}">{{ $product->$name }}</a>
                                        </h2>
                                        <ul class="product__price">
                                            @if ($product->sale_price !== null)
                                                <li class="old__price">${{ $product->price }}</li>
                                                <li class="new__price">${{ $product->sale_price }}</li>
                                            @else
                                                <li class="new__price">${{ $product->price }}</li>
                                            @endif

                                        </ul>
                                    </div>
                                </div>
                            </div># 1- تهيئة git داخل المشروع (لو مش عاملها قبل)
git init

# 2- ربط المشروع مع الريبو على GitHub (استبدل الرابط برابط الريبو عندك)
git remote add origin https://github.com/USERNAME/REPO_NAME.git

# 3- إضافة كل الملفات للتتبع
git add .

# 4- عمل أول كوميت مع ر�