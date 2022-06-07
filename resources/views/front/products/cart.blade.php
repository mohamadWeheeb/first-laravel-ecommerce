@extends('layouts.front')



@section('content')

<div class="ps-content pt-80 pb-80">
    <div class="ps-container">
        <div class="ps-cart-listing">
            <table class="table ps-cart__table">
                <thead>
                    <tr>
                        <th>All Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($carts as $cart)
                    <tr>
                        <td>
                            <a class="ps-product__preview" href="{{ route('products.view' , $cart->product->slug) }}"><img class="mr-15" src="{{ $cart->product->image_url }}" width="100" alt="">{{ $cart->name }}</a>
                        </td>
                        <td>${{ $cart->product->price }}</td>
                        <td>
                            <div class="form-group--number">
                                <button class="minus"><span>-</span></button>
                                <input class="form-control" type="text" value="{{ $cart->quantity }}">
                                <button class="plus"><span>+</span></button>
                            </div>
                        </td>
                        <td>${{ $cart->quantity  * $cart->product->price }}</td>
                        <td>
                            <div class="ps-remove"></div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td>
                            No Products Choise
                        </td>
                    </tr>

                    @endforelse
                </tbody>
            </table>
            <div class="ps-cart__actions">
                <div class="ps-cart__promotion">
                    <div class="form-group">
                        <div class="ps-form--icon"><i class="fa fa-angle-right"></i>
                            <input class="form-control" type="text" placeholder="Promo Code">
                        </div>
                    </div>
                    <div class="form-group">
                        <button class="ps-btn ps-btn--gray">Continue Shopping</button>
                    </div>
                </div>
                <div class="ps-cart__total">
                    <h3>Total Price: <span> {{ $totle_price }} $</span></h3><a class="ps-btn" href="{{ route('checkout') }}">Process to checkout<i class="ps-icon-next"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
