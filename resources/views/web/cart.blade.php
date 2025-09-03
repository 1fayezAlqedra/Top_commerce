@extends('web.master')
@section('content')

    <!-- End Offset Wrapper -->
    <!-- Start Bradcaump area -->
    <div class="ht__bradcaump__area"
        style="background: rgba(0, 0, 0, 0) url({{ asset('siteasset/images/bg/2.jpg') }}) no-repeat scroll center center / cover ;">
        <div class="ht__bradcaump__wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">Cart</h2>
                            <nav class="bradcaump-inner">
                                <a class="breadcrumb-item" href="{{ route('web.index') }}">Home</a>
                                <span class="brd-separetor">/</span>
                                <span class="breadcrumb-item active">Cart</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Bradcaump area -->
    <!-- cart-main-area start -->
    <div class="cart-main-area ptb--120 bg__white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <form method="POST" action="{{ route('web.update_cart') }} ">
                        @csrf
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                        <th class="product-remove">Remove</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($carts as $cart)
                                        @php
                                            $total += $cart->price * $cart->qty;
                                        @endphp
                                        <tr>
                                            <td class="product-thumbnail"><a
                                                    href="{{ route('web.product', $cart->product_id) }}">
                                                    @if ($cart->product->image && file_exists(public_path('uploads/images/' . $cart->product->image)))
                                                        <img src="{{ asset('uploads/images/' . $cart->product->image) }}"
                                                            alt="product img" />
                                                    @else
                                                        <img src="{{ asset('siteasset/images/image-not-available-icon-vector-set-white-background-eps-330821927.webp') }}"
                                                            alt="product img" />
                                                    @endif
                                                </a></td>
                                            <td class="product-name"><a
                                                    href="{{ route('web.product', $cart->product_id) }}">{{ $cart->product->name }}</a>
                                            </td>
                                            <td class="product-price"><span class="amount">{{ $cart->price }}</span></td>
                                            <td class="product-quantity"><input name="new_qty[{{ $cart->id }}]"
                                                    type="number" value="{{ $cart->qty }}" /></td>
                                            <td class="product-subtotal">{{ $cart->price * $cart->qty }}</td>
                                            <td class="product-remove"><a
                                                    href="{{ route('remove_cart', $cart->id) }}">X</a>
                                            </td>
                                        </tr>
                                    @endforeach



                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-8 col-sm-7 col-xs-12">
                                <div class="buttons-cart">
                                    <input type="submit" value="Update Cart" />
                                    <a href="{{ route('web.shop') }}">Continue Shopping</a>
                                </div>

                            </div>
                            <div class="col-md-4 col-sm-5 col-xs-12">
                                <div class="cart_totals">
                                    <table>
                                        <thead>
                                            <th>
                                                <h2>Cart Totals :</h2>
                                            </th>
                                        </thead>
                                        <tbody>

                                            <tr class="order-total">
                                                <th>Total</th>
                                                <td>
                                                    <strong><span
                                                            class="amount">${{ number_format($total, 2) }}</span></strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="{{ route('web.checkout') }}">Proceed to Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-main-area end -->
@stop
