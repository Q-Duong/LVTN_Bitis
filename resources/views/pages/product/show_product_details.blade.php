@extends('layout_not_slider')
@section('content')
@section('title', ' - ')

<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{URL::to('/')}}">Trang chủ</a>
                        <a href="{{url('/collections/'.$product->category->category_slug)}}">{{$product->category->category_name}}</a>
                        <span>{{$product->product_name}}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <ul id="imageGallery">
                        @foreach($gallery as $key => $gal)
                        <li style="width:100%; margin:auto; "
                            data-thumb="{{asset('uploads/gallery/'.$gal->gallery_image)}}"
                            data-src="{{asset('uploads/gallery/'.$gal->gallery_image)}}">
                            <img width="100%" src="{{asset('uploads/gallery/'.$gal->gallery_image)}}"
                                alt="{{$gal->gallery_name}}" />
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-1 d-none d-lg-block"> </div>
                <div class="col-lg-4 col-md-5">
                    <div class="product__details__text">
                        <h3>{{$product->product_name}}</h3>
                        <span>Danh mục:</span> {{$product->category->category_name}}
                        <div class="rating ">
                            <div class="row d-flex ">
                                {{-- <ul class="list-inline">
                                    @for($count=1; $count<=5; $count++) @php if($count<=$rating){
                                        $color='color:#ffcc00;' ; } else { $color='color:#ccc;' ; } @endphp <li
                                        title="star_rating" data-product_id="{{$value->product_id}}"
                                        data-rating="{{$rating}}" class="rating"
                                        style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                        @endfor
                                </ul> --}}
                            </div>
                        </div>
                        <h5>{{number_format($product->product_price,0,',','.').'₫'}}</h5>
                        
                        <span><i class="fas fa-truck"></i> Giao hàng:</span> <p class="delivery-message"></p>
                        <div class="product__details__option">
                            <div class="product__details__option__color">
                                <input type="hidden" name="product_color_id" class="product_color_id" value="">
                                <span>Màu:</span>
                                @foreach($color as $key => $col)
                                    <label class="color" style="background-color:{{$col -> color -> color_value}};" for="sp-{{$key+1}}">
                                        <input type="radio" class="color_id" value="{{$col -> color -> color_id}}" id="sp-{{$key+1}}">
                                    </label>
                                    {{-- <label class="c-2" for="sp-2">
                                        <input type="radio" id="sp-2">
                                    </label>
                                    <label class="c-3" for="sp-3">
                                        <input type="radio" id="sp-3">
                                    </label>
                                    <label class="c-4" for="sp-4">
                                        <input type="radio" id="sp-4">
                                    </label>
                                    <label class="c-9" for="sp-9">
                                        <input type="radio" id="sp-9">
                                    </label> --}}
                                @endforeach
                            </div>
                                <div class="product__details__option__size">
                                    <input type="hidden" name="product_size_id" class="product_size_id" value="">
                                    <span>Size:</span>
                                    @foreach($size as $key => $siz)
                                        <label class="size" for="{{$siz -> size -> size_attribute}}">
                                            {{$siz -> size -> size_attribute}}
                                            <input type="radio" class="size_id" value="{{$siz -> size -> size_id}}" id="{{$siz -> size -> size_attribute}}">
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <form id="data_cart">
                            @csrf
                            <a class="product_slug" href="{{URL::to('/products/'.$product->product_slug)}}"></a>
                            <input type="hidden" name="ware_house_id" value="" class="cart_ware_house_id">
                            <input type="hidden" name="product_id" value="{{$product->product_id}}" class="product_id">
                            <input type="hidden" name="product_name" value="{{$product->product_name}}" class="cart_product_name">
                            <input type="hidden" name="product_price" value="{{$product->product_price}}">
                            <input type="hidden" name="product_color" class="product_color" value="">
                            <input type="hidden" name="product_size" class="product_size" value="">
                            <img name="product_image" src="{{URL::to('uploads/product/'.$product->product_image)}}" style="display:none;" class="product_image"/>

                            <div class="product__details__cart__option">
                                <button type="button" class="primary-btn-add add-cart" name="add-to-cart" onclick="add_cart();">
                                    <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                </button>
                            </div>
                            <div class="product__details__btns__option">
                                <a type="button" class="primary-btn-wistlist" id="{{$product->product_id}}" onclick="add_wistlist(this.id);">
                                    <i class="fa fa-heart"></i> 
                                    Yêu thích
                                </a>
                            </div>
                            <div class="product__details__last__option">
                                <h5><span>Phương thức thanh toán</span></h5>
                                <img src="{{asset('frontend/img/shop-details/details-payment.png')}}" alt="">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="product__details__content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Thông số kỹ
                                    thuật</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đặc điểm nổi bật</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-7" role="tab">Đánh giá(5)</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note">{!!$product->description!!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note"></p>
                                    <div class="product__details__tab__content__item">
                                        <p>{!!$product->description!!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-7" role="tabpanel">
                                <div class="product__details__tab__content">
                                    

                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop Details Section End -->

<!-- Related Section Begin -->
{{-- <section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Sản phẩm liên quan</h3>
            </div>
        </div>
        <div class="row">
            @foreach($relate as $key => $lienquan)
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <a class="heart" type="button" id="" onclick="add_wistlist(this.id);">
                    <i class="far fa-heart"></i>
                </a>
                <div class="product__item">
                    <a id=""
                        href="{{URL::to('/product/'.$lienquan->product_slug)}}">
                        <div class="product__item__pic set-bg"
                            data-setbg="{{URL::to('uploads/product/'.$lienquan->product_image)}}">
                        </div>
                    </a>

                    <div class="product__item__text">
                        <h6>{{$lienquan->product_name}}</h6>
                        <h5>{{number_format($lienquan->product_price,0,',','.').'₫'}}</h5>
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
</section> --}}
<!-- Related Section End -->
@endsection