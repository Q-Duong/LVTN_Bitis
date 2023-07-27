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
                            <span>{{ $category->category_name }}</span>
                            <input type="hidden" class="category_id" value="{{ $category->category_id }}">
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
                                <div class="category-product-content">
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
                <div class="col-lg-3">
                    @if ($category->category_slug != 'phu-kien')
                        <div class="shop__sidebar">
                            <div class="shop__sidebar__search">
                            </div>
                            <div class="shop__sidebar__accordion">
                                <div class="accordion" id="accordionExample">
                                    <div class="card">
                                        <div class="card-heading">
                                            <a data-toggle="collapse" data-target="#collapseOne">Size</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <div class="shop__sidebar__categories">
                                                    <div class="row">
                                                        @foreach ($getAllSize as $key => $size)
                                                            @if ($size->size_attribute != 0)
                                                                <div class="col-4">
                                                                    <div class="section-size">
                                                                        <label class="size-wrapper size"
                                                                            for="{{ $size->size_attribute }}">
                                                                            <input type="checkbox"
                                                                                class="size-input size_filter"
                                                                                value="{{ $size->size_id }}"
                                                                                id="{{ $size->size_attribute }}" />
                                                                            <span class="size-tile">
                                                                                <span class="size-label">
                                                                                    {{ $size->size_attribute }}</span>
                                                                            </span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Màu</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="">
                                                    <div class="row">
                                                        @foreach ($getAllColor as $key => $color)
                                                            <div class="col-4">
                                                                <div class="section-color">
                                                                    <input type="checkbox" name="color_id"
                                                                        id="{{ $key }}_checkbox"
                                                                        class="_checkbox color_filter"
                                                                        value="{{ $color->color_id }}">
                                                                    <label for="{{ $key }}_checkbox"
                                                                        class="label_color"
                                                                        style="background-color:{{ $color->color_value }};">
                                                                        <div id="tick_mark"></div>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="shop__sidebar">
                        <div class="shop__sidebar__search">
                        </div>
                        <div class="shop__sidebar__accordion">
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Giá</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <div class="section-price">
                                                    <p>
                                                        <input class="price-wrapper" type="text" id="amount"
                                                            readonly>
                                                    </p>
                                                    <input type="hidden" id="min-price" value="0">
                                                    <input type="hidden" id="max-price" value="20000000">
                                                    <div class="price_filter"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row product">
                        @foreach ($getAllListProductCategory as $key => $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
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
                                        <div class="product__color__select">
                                            @foreach ($getAllListProductCategory->unique('color_id') as $key => $attr)
                                                @if ($attr->product_id == $product->product_id)
                                                    @foreach ($getAllListProductCategory->unique('color_id') as $key => $a)
                                                        @if ($a->color_id == $attr->color_id)
                                                            <label style="background-color:{{ $attr->color_value }};">
                                                                <input type="radio">
                                                            </label>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
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
