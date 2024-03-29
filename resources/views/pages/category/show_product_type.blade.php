@extends('layout')
@section('content')
@php
    $category_slug = Route::current()->parameters()['category_slug'];
    $product_type_slug = Route::current()->parameters()['product_type_slug'];
@endphp
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Sản phẩm</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ URL::to('/') }}">Trang chủ</a>
                            <a href="{{URL::to('/collections/' . $category->category_slug)}}">{{ $category->category_name }}</a>
                            <span>{{ $product_type->product_type_name }}</span>
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
                    @foreach ($getAllListCategoryType as $key => $categoryType)
                        @if ($categoryType->category_id == $category->category_id)
                            <a class="category-product-item" href="{{ asset(URL::to('/collections/' . $categoryType->category->category_slug . '/' . $categoryType->productType->product_type_slug)) }}">
                                <div class="category-product-content {{$category_slug .'/'. $product_type_slug == $category->category_slug . '/' . $categoryType->productType->product_type_slug ? 'active-category' : ''}}">
                                    <img class="category-product-content-img" src="{{ asset('uploads/productType/' . $categoryType->productType->product_type_img) }}">
                                    <p class="lead">
                                        {{ $categoryType->productType->product_type_name }}
                                    </p>
                                </div>
                            </a>
                        @endif
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
                    <p>{{ $category->category_name }}</p>
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
                        @foreach ($getAllListProductCategory as $key => $product)
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
