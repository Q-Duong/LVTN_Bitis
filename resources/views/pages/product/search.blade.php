@extends('layout')
@section('content')
@section('title', 'Search Products - ')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Tìm kiếm</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>Tìm kiếm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="category_product_title">
                <p>Kết quả tìm kiếm</p>
            </div>
        </div>
    </div>
    <div class="row product__filter">
        @foreach($product as $key => $product)
        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
            <a class="heart" type="button" id="{{$product->product_id}}" onclick="add_wistlist(this.id);">
                <i class="far fa-heart"></i>
            </a>
            <div class="product__item">
                <a id="wishlist_producturl{{$product->product_id}}"
                    href="{{URL::to('/products/'.$product->product_slug)}}">
                    <div class="product__item__pic set-bg"
                        data-setbg="{{URL::to('uploads/product/'.$product->product_image)}}">
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
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection