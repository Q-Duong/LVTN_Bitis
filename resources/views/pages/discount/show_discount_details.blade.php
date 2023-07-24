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
                            <a href="{{URL::to('/collections/discount')}}">Khuyến mãi</a>
                            <span>{{ $discount->discount_name }}</span>
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
                            <div class="category-product-content {{Route::current()->parameters()['discount_slug'] == $discount->discount_slug ? 'active-category' : ''}}">
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
                    <p>{{ $discount->discount_name }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        @foreach ($getAllListProductDiscount as $key => $product)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <a class="heart" type="button" id="{{ $product->product_id }}"
                                    onclick="add_wistlist(this.id);">
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
                                            @elseif($product->product_tag == 3)
                                                <span class="label">
                                                    Khuyến mãi
                                                </span>
                                            @else
                                            @endif

                                            @if ($product->product_tag == 0)
                                                <div class="product_sold_out">
                                                    <p>Sold out</p>
                                                </div>
                                            @else
                                            @endif
                                        </div>
                                    </a>
                                    <form>
                                        @csrf
                                        <div class="product__item__text">
                                            <h6>{{ $product->product_name }}</h6>
                                            <div class="rating">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <h5> {{ number_format($product->product_price) . '₫' }}</h5>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
