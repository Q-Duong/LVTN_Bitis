@extends('layout_not_slider')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Sản phẩm</h4>
                    <div class="breadcrumb__links">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <span>{{$category->category_name}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="category_product">
        @foreach($getAllListCategoryType as $key => $categoryType)
            @if($categoryType->category_id == $category->category_id)
                <a href="{{asset(URL::to($categoryType->category->category_slug.'/'.$categoryType->productType->product_type_slug))}}">
                    <div class="category_product_item">
                        <p>
                            {{$categoryType->productType->product_type_name}}
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
                <p>{{$category->category_name}}</p>
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
                    @foreach($getAllListProductCategory as $key => $product)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a class="heart" type="button" id="{{$product->product_id}}" onclick="add_wistlist(this.id);">
                            <i class="far fa-heart"></i>
                        </a>
                        <div class="product__item">
                            <a id="wishlist_producturl{{$product->product_id}}" href="{{URL::to('/product/'.$product->product_slug)}}">
                                <div class="product__item__pic set-bg"
                                    data-setbg="{{URL::to('uploads/product/'.$product->product_image)}}">
                                    @if($product->product_tag==2)
                                    <span class="label">
                                        Mới
                                    </span>
                                    @elseif($product->product_tag==1)
                                    <span class="label">
                                        Khuyến mãi
                                    </span>
                                    @else
                                    @endif

                                    @if($product->product_tag==0)
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
                                    <h6>{{$product->product_name}}</h6>
                                    <a type="button" data-id_product="{{$product->product_id}}" name="add-to-cart"
                                        class="add-cart add-to-cart">+ Thêm vào giỏ hàng</a>
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <h5> {{number_format($product->product_price).'₫'}}</h5>
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