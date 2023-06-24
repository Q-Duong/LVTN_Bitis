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
                            <input type="hidden" class="category_id" value="{{$category->category_id}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="category_product">
            @foreach ($getAllListCategoryType as $key => $categoryType)
                @if ($categoryType->category_id == $category->category_id)
                    <a
                        href="{{ asset(URL::to('/collections/' . $categoryType->category->category_slug . '/' . $categoryType->productType->product_type_slug)) }}">
                        <div class="category_product_item">
                            <img width="100%"
                                src="{{ asset('uploads/productType/' . $categoryType->productType->product_type_img) }}">
                            <p>
                                {{ $categoryType->productType->product_type_name }}
                            </p>
                        </div>
                    </a>
                @endif
            @endforeach
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
                                                {{-- <ul class="nice-scroll">
                                                    <li>
                                                        Size
                                                    </li>
                                                    
                                                </ul> --}}
                                                <div class="row">
                                                    @foreach ($getAllSize as $key => $size)
                                                        <div class="col-lg-4">
                                                            <label for="size{{ $key }}">
                                                                {{ $size->size_attribute }}
                                                                <input type="checkbox" id="size{{ $key }}"
                                                                    value="{{ $size->size_id }}" class="size_filter">
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
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
                                        <a data-toggle="collapse" data-target="#collapseOne">Màu</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <div class="row">
                                                        @foreach ($getAllColor as $key => $color)
                                                            <div class="col-lg-4">
                                                                <div class="section-color">
                                                                    <input type="checkbox" name="color_id" id="{{ $key }}_checkbox" class="_checkbox color_filter" value="{{ $color->color_id }}" >
                                                                    <label for="{{ $key }}_checkbox" class="label_color" style="background-color:{{ $color->color_value }};">
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
                                                <ul class="nice-scroll">
                                                    <li>
                                                        Size
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="shop__product__option">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__left">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="shop__product__option__right">
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            <img src="{{ URL::to('uploads/product/' . $product->product_image) }}"/>
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
                                            <label for="pc-1">
                                                <input type="radio" id="pc-1">
                                            </label>
                                            <label class="active black" for="pc-2">
                                                <input type="radio" id="pc-2">
                                            </label>
                                            <label class="grey" for="pc-3">
                                                <input type="radio" id="pc-3">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        {{-- {{ $getAllListProductCategory->links('pagination::bootstrap-4') }} --}}

    </section>
@endsection
