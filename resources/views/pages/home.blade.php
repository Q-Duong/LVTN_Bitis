@extends('layout')
@section('content')
    <section id="a" class="hero">
        <div class="hero__slider owl-carousel">
            @foreach ($getAllBanner as $key => $banner)
                <div class="hero__items set-bg active" data-setbg="{{ asset('uploads/banner/' . $banner->banner_image) }}">
                </div>
            @endforeach
        </div>
    </section>
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="category_product_title">
                        <p><i class="fas fa-phone-laptop"></i> Sản phẩm mới</p>
                    </div>
                </div>
            </div>
            <div class="row product__filter">
                @foreach ($getAllListNewProduct as $key => $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6  mix new-arrivals ">
                        <a class="heart" type="button" id="{{ $product->product_id }}" onclick="add_wistlist(this.id);">
                            <i class="far fa-heart"></i>
                        </a>
                        <div class="product__item">
                            <a id="wishlist_producturl{{ $product->product_id }}"
                                href="{{ URL::to('/products/' . $product->product_slug) }}">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ URL::to('uploads/product/' . $product->product_image) }}">
                                    @if ($product->product_tag == 1)
                                        <span class="label">
                                            Mới
                                        </span>
                                    @else
                                    @endif
                                </div>
                            </a>
                            <input type="hidden" value="{{ $product->product_id }}"
                                class="cart_product_id_{{ $product->product_id }}">

                            <input type="hidden" id="wishlist_productname{{ $product->product_id }}"
                                value="{{ $product->product_name }}" class="cart_product_name_{{ $product->product_id }}">

                            <input type="hidden" id="wishlist_productprice{{ $product->product_id }}"
                                value="{{ number_format($product->product_price, 0, ',', '.') }}₫">

                            <img id="wishlist_productimage{{ $product->product_id }}"
                                src="{{ URL::to('uploads/product/' . $product->product_image) }}" style="display:none;" />

                            <div class="product__item__text">
                                <h6>{{ $product->product_name }}</h6>
                                <h5>{{ number_format($product->product_price, 0, ',', '.') }}₫</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="category_product_title">
                        <p><i class="fas fa-phone-laptop"></i> Sản phẩm khuyến mãi</p>
                    </div>
                </div>
            </div>
            <div class="row product__filter">
                @foreach ($getAllListSaleProduct as $key => $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-md-6  mix new-arrivals ">
                        <a class="heart" type="button" id="{{ $product->product_id }}" onclick="add_wistlist(this.id);">
                            <i class="far fa-heart"></i>
                        </a>
                        <div class="product__item">
                            <a id="wishlist_producturl{{ $product->product_id }}"
                                href="{{ URL::to('/products/' . $product->product_slug) }}">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{ URL::to('uploads/product/' . $product->product_image) }}">
                                    @if ($product->product_tag == 3)
                                        <span class="label">
                                            Khuyến mãi
                                        </span>
                                    @else
                                    @endif
                                </div>

                            </a>
                            <input type="hidden" value="{{ $product->product_id }}"
                                class="cart_product_id_{{ $product->product_id }}">

                            <input type="hidden" id="wishlist_productname{{ $product->product_id }}"
                                value="{{ $product->product_name }}" class="cart_product_name_{{ $product->product_id }}">

                            <input type="hidden" id="wishlist_productprice{{ $product->product_id }}"
                                value="{{ number_format($product->product_price, 0, ',', '.') }}₫">

                            <img id="wishlist_productimage{{ $product->product_id }}"
                                src="{{ URL::to('uploads/product/' . $product->product_image) }}" style="display:none;" />

                            <div class="product__item__text">
                                <h6>{{ $product->product_name }}</h6>
                                <h5>{{ number_format($product->product_price, 0, ',', '.') }}₫</h5>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="category_product_title">
                        <p><i class="fas fa-newspaper"></i> tin tức</p>
                    </div>
                </div>
            </div>
            <div class="row product__filter">
                @foreach ($getAllPost as $key => $pst)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic set-bg"
                                data-setbg="{{ asset('uploads/post/' . $pst->post_image) }}"></div>
                            <div class="blog__item__text">
                                <span><img src="{{ asset('frontend/img/icon/calendar.png') }}" alt=""> 16 February
                                    2020</span>
                                <h5>{{ $pst->post_title }}</h5>
                                <a href="{{ URL::to('/blog/' . $pst->post_slug) }}">Xem tin</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Section End -->
@endsection
