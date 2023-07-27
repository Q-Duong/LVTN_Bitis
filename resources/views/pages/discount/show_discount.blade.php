@extends('layout')
@section('content')
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Sản phẩm</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ URL::to('/') }}">Trang chủ</a>
                            <span>Khuyến mãi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="category-product" data-items="1,3,5,6" data-slide="1" id="MultiCarousel" data-interval="1000">
                <div class="category-product-inner">
                    @foreach ($getAllDiscount as $key => $discount)
                        <a class="category-product-item"
                            href="{{ asset(URL::to('/collections/discount/' . $discount->discount_slug)) }}">
                            <div class="category-product-content">
                                <img class="category-product-content-img"
                                    src="{{ asset('uploads/discount/' . $discount->discount_image) }}">
                                <p class="lead">
                                    {{ $discount->discount_name }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
                <button class=" leftLst">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class=" rightLst">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section End -->
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category_product_title">
                    <p>Khuyến mãi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row product">
                        @foreach ($getAllProduct as $key => $product)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                <a class="heart" type="button" id="{{ $product->product_id }}"
                                    onclick="add_wistlist(this.id);">
                                    <i class="far fa-heart"></i>
                                </a>
                                <div class="product__item">
                                    <a id="wishlist_producturl{{ $product->product_id }}"
                                        href="{{ URL::to('/products/' . $product->product_slug) }}">
                                        <div class="product__item__picture">
                                            <img src="{{ URL::to('uploads/product/' . $product->product_image) }}" />
                                            @if ($product->product_tag == 1)
                                                <span class="label">
                                                    Mới
                                                </span>
                                            @elseif($product->product_tag == 3)
                                                <span class="label">
                                                    Khuyến mãi
                                                </span>
                                            @else
                                            @endif
                                            @if ($product->product_tag == 2)
                                                <div class="product_sold_out">
                                                    <p>Sold out</p>
                                                </div>
                                            @else
                                            @endif
                                        </div>
                                    </a>
                                    <input type="hidden" value="{{ $product->product_id }}"
                                        class="cart_product_id_{{ $product->product_id }}">

                                    <input type="hidden" id="wishlist_productname{{ $product->product_id }}"
                                        value="{{ $product->product_name }}"
                                        class="cart_product_name_{{ $product->product_id }}">

                                    <input type="hidden" id="wishlist_productprice{{ $product->product_id }}"
                                        value="{{ number_format($product->product_price, 0, ',', '.') }}₫">

                                    <img id="wishlist_productimage{{ $product->product_id }}"
                                        src="{{ URL::to('uploads/product/' . $product->product_image) }}"
                                        style="display:none;" />

                                    <div class="product__item__text">
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h6>{{ $product->product_name }}</h6>
                                        <h5>{{ number_format($product->product_price, 0, ',', '.') }}₫</h5>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
