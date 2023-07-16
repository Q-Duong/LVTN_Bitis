@extends('layout')
@section('content')
@section('title', ' - ')

<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{ URL::to('/') }}">Trang chủ</a>
                        <a
                            href="{{ url('/collections/' . $product->category->category_slug) }}">{{ $product->category->category_name }}</a>
                        <a
                            href="{{ url('/collections/' . $product->category->category_slug . '/' . $product->productType->product_type_slug) }}">{{ $product->productType->product_type_name }}</a>
                        <span>{{ $product->product_name }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7 col-md-7">
                    <ul id="imageGallery">
                        @foreach ($gallery as $key => $gal)
                            <li style="width:100%; margin:auto; "
                                data-thumb="{{ asset('uploads/gallery/' . $gal->gallery_image) }}"
                                data-src="{{ asset('uploads/gallery/' . $gal->gallery_image) }}">
                                <img width="100%" src="{{ asset('uploads/gallery/' . $gal->gallery_image) }}"
                                    alt="{{ $gal->gallery_name }}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-1 d-none d-lg-block"> </div>
                <div class="col-lg-4 col-md-5">
                    <div class="product__details__text">
                        <h3>{{ $product->product_name }}</h3>
                        <span>Danh mục:</span> {{ $product->category->category_name }}
                        <div class="rating ">
                            <div class="row d-flex ">
                                {{-- <ul class="list-inline">
                                    @for ($count = 1; $count <= 5; $count++) @php if($count<=$rating){
                                        $color='color:#ffcc00;' ; } else { $color='color:#ccc;' ; } @endphp <li
                                        title="star_rating" data-product_id="{{$value->product_id}}"
                                        data-rating="{{$rating}}" class="rating"
                                        style="cursor:pointer; {{$color}} font-size:30px;">&#9733;</li>
                                        @endfor
                                </ul> --}}
                            </div>
                        </div>
                        <h5>{{ number_format($product->product_price, 0, ',', '.') . '₫' }}</h5>

                        <span><i class="fas fa-truck"></i> Giao hàng:</span>
                        <p class="delivery-message"></p>
                        <div class="product__details__option">
                            <div class="product__details__option__color">
                                <span>Màu:</span>
                                @foreach ($color as $key => $col)
                                    <label class="color" style="background-color:{{ $col->color->color_value }};"
                                        for="sp-{{ $key + 1 }}">
                                        <input type="radio" class="color_id" value="{{ $col->color->color_id }}"
                                            id="sp-{{ $key + 1 }}">
                                    </label>
                                @endforeach
                            </div>
                            <div class="product__details__option__size">
                                <span>Size:</span>
                                @foreach ($size as $key => $siz)
                                    <label class="size" for="{{ $siz->size->size_attribute }}">
                                        {{ $siz->size->size_attribute == 0 ? 'Không có size' : $siz->size->size_attribute }}
                                        <input type="radio" class="size_id" value="{{ $siz->size->size_id }}"
                                            id="{{ $siz->size->size_attribute }}">
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <form id="data_cart">
                        @csrf
                        <a class="product_slug" href="{{ URL::to('/products/' . $product->product_slug) }}"></a>
                        <input type="hidden" name="ware_house_id" value="" class="cart_ware_house_id">
                        <input type="hidden" name="product_color" class="product_color" value="">
                        <input type="hidden" name="product_size" class="product_size" value="">

                        <input type="hidden" name="product_id" value="{{ $product->product_id }}" class="product_id">
                        <input type="hidden" name="product_name" value="{{ $product->product_name }}"
                            class="cart_product_name">
                        <input type="hidden" name="product_price" value="{{ $product->product_price }}">
                        <img name="product_image" src="{{ URL::to('uploads/product/' . $product->product_image) }}"
                            style="display:none;" class="product_image" />

                        <div class="product__details__cart__option">
                            <button type="button" class="primary-btn-add add-cart" name="add-to-cart"
                                onclick="add_cart();">
                                <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                            </button>
                        </div>
                        <div class="product__details__btns__option">
                            <a type="button" class="primary-btn-wistlist" id="{{ $product->product_id }}"
                                onclick="add_wistlist(this.id);">
                                <i class="fa fa-heart"></i>
                                Yêu thích
                            </a>
                        </div>
                        <div class="product__details__last__option">
                            <h5><span>Phương thức thanh toán</span></h5>
                            <img src="{{ asset('frontend/img/shop-details/details-payment.png') }}" alt="">
                        </div>
                    </form>
                </div>
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
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh giá({{$countRating}})</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <p class="note"></p>
                                    <div class="product__details__tab__content__item">
                                        <p>{!! $product->product_description !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-6" role="tabpanel">
                                <div class="product__details__tab__content">
                                    <div class="h-30 row d-flex justify-content-center">
                                        <div class="col-lg-12 centered">
                                            <div class="product-rating">
                                                <div class="product-rating-title">
                                                    <h4>Đánh giá & nhận xét {{ $product->product_name }}</h4>
                                                </div>
                                                <div class="product-rating-review">
                                                    <div class="product-rating-score">
                                                        <h4 class="rating-score-title">{{$avgRating != null ? $avgRating : 0}}/5.0</h4>
                                                        <div class="item-rating-score-star">
                                                            <i class="fas fa-star {{ $roundAvgRating >= 1 ? 'active':''}}"></i>
                                                            <i class="fas fa-star {{ $roundAvgRating >= 2 ? 'active':''}}"></i>
                                                            <i class="fas fa-star {{ $roundAvgRating >= 3 ? 'active':''}}"></i>
                                                            <i class="fas fa-star {{ $roundAvgRating >= 4 ? 'active':''}}"></i>
                                                            <i class="fas fa-star {{ $roundAvgRating >= 5 ? 'active':''}}"></i>
                                                        </div>
                                                        <p><strong>{{$countRating}}</strong> đánh giá và nhận xét</p>
                                                    </div>
                                                    <div class="product-rating-star">
                                                        <div class="rating-level">
                                                            <div class="star-count">
                                                                <span class="star-title">5</span>
                                                                <div class="is-active">
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div> 
                                                            <progress max="{{$countRating}}" value="{{$star5}}" class="progress progress-rating "></progress> 
                                                            <span class="rating-count">{{$star5}} đánh giá </span>
                                                        </div>
                                                        <div class="rating-level">
                                                            <div class="star-count">
                                                                <span class="star-title">4</span>
                                                                <div class="is-active">
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div> 
                                                            <progress max="{{$countRating}}" value="{{$star4}}" class="progress progress-rating "></progress> 
                                                            <span class="rating-count">{{$star4}} đánh giá </span>
                                                        </div>
                                                        <div class="rating-level">
                                                            <div class="star-count">
                                                                <span class="star-title">3</span>
                                                                <div class="is-active">
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div> 
                                                            <progress max="{{$countRating}}" value="{{$star3}}" class="progress progress-rating "></progress> 
                                                            <span class="rating-count">{{$star3}} đánh giá </span>
                                                        </div>
                                                        <div class="rating-level">
                                                            <div class="star-count">
                                                                <span class="star-title">2</span>
                                                                <div class="is-active">
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div> 
                                                            <progress max="{{$countRating}}" value="{{$star2}}" class="progress progress-rating "></progress> 
                                                            <span class="rating-count">{{$star2}} đánh giá </span>
                                                        </div>
                                                        <div class="rating-level">
                                                            <div class="star-count">
                                                                <span class="star-title">1</span>
                                                                <div class="is-active">
                                                                    <i class="fas fa-star"></i>
                                                                </div>
                                                            </div> 
                                                            <progress max="{{$countRating}}" value="{{$star1}}" class="progress progress-rating "></progress> 
                                                            <span class="rating-count">{{$star1}} đánh giá </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Review Popup -->
                                                <div class="popup-model-review">
                                                    <div class="overlay-model-review"></div>
                                                    <div class="model-review-content">
                                                        <form action="{{URL::to('/send-rating')}}" method='POST'>
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{$product->product_id}}"/>
                                                        <div class="model-review-close">
                                                            <p class="model-review-tile">Đánh giá sản phẩm</p>
                                                            <p class="close-model"><i class="fas fa-times"></i></p>
                                                        </div>
                                                        <div class="model-review-img">
                                                            <img class="review-img"
                                                                src="{{ asset('uploads/product/' . $product->product_image) }}"
                                                                alt="{{ $product->product_image }}" />
                                                        </div>
                                                        <h6 class="model-review-product">
                                                            Đánh giá & nhận xét {{ $product->product_name }}
                                                        </h6>
                                                        <div class="model-review-description">
                                                            <textarea class="model-review-textarea" rows="5" name="comment" 
                                                                placeholder="Xin mời chia sẻ một số cảm nhận về sản phẩm....."></textarea>
                                                        </div>

                                                        <div class="model-review-star">
                                                            <p class="model-review-star-title">Bạn thấy sản phẩm này
                                                                như thế nào?</p>
                                                            <div class="section-rating">
                                                                <input type="radio" class="rating" id="star1"
                                                                    name="rating" value="1" />
                                                                <input type="radio" class="rating" id="star2"
                                                                    name="rating" value="2" />
                                                                <input type="radio" class="rating" id="star3"
                                                                    name="rating" value="3" />
                                                                <input type="radio" class="rating" id="star4"
                                                                    name="rating" value="4" />
                                                                <input type="radio" class="rating" id="star5"
                                                                    name="rating" value="5" />

                                                                <label class="rating_label" for="star1">
                                                                    <p>Rất tệ</p>
                                                                </label>
                                                                <label class="rating_label" for="star2">
                                                                    <p>Tệ</p>
                                                                </label>
                                                                <label class="rating_label" for="star3">
                                                                    <p>Tạm ổn</p>
                                                                </label>
                                                                <label class="rating_label" for="star4">
                                                                    <p>Tốt</p>
                                                                </label>
                                                                <label class="rating_label" for="star5">
                                                                    <p>Rất tốt</p>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="checkout__input">
                                                            <button type="submit" name="send-rating"
                                                                class="site-btn send-rating">
                                                                Gửi đánh giá
                                                            </button>
                                                        </div>
                                                    </form>   
                                                    </div>
                                                </div>
                                                <!--End Review Popup -->

                                                <p class="title-buttonn-rating">Bạn đánh giá sao sản phẩm này</p>
                                                <div class="row">
                                                    <div class="col-lg-12 text-center">
                                                        <button class="site-btn button-review">
                                                            Đánh giá ngay
                                                        </button>
                                                    </div>
                                                </div>

                                                @foreach ($getAllRating as $key => $rating)
                                                    <div class="review-rating-item">
                                                        <div class="review-rating-item-title">
                                                            <span class="name-rating">{{$rating -> user -> profile -> profile_lastname}}</span>
                                                            <span class="date-rating">{{$rating -> created_at -> format('d/m/Y H:i')}}</span>
                                                        </div>
                                                        <div class="review-rating-item-content">
                                                            <div class="item-rating">
                                                                <strong>Đánh giá : </strong>
                                                                <div class="item-rating-star">
                                                                    <i class="fas fa-star {{ $rating->rating_star >= 1 ? 'active':''}}"></i>
                                                                    <i class="fas fa-star {{ $rating->rating_star >= 2 ? 'active':''}}"></i>
                                                                    <i class="fas fa-star {{ $rating->rating_star >= 3 ? 'active':''}}"></i>
                                                                    <i class="fas fa-star {{ $rating->rating_star >= 4 ? 'active':''}}"></i>
                                                                    <i class="fas fa-star {{ $rating->rating_star >= 5 ? 'active':''}}"></i>
                                                                </div>
                                                            </div>
                                                            <div class="item-comment">
                                                                <div class="comment-content">
                                                                    <strong>Nhận xét : </strong> {{$rating -> rating_comment}}
                                                                </div>
                                                            </div>
                                                        </div>
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
            </div>
        </div>
    </div>
</section>

<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Sản phẩm liên quan</h3>
            </div>
        </div>
        <div class="row">
            @foreach ($relate as $key => $lienquan)
                <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                    <a class="heart" type="button" id="{{ $lienquan->product_id }}"
                        onclick="add_wistlist(this.id);">
                        <i class="far fa-heart"></i>
                    </a>
                    <div class="product__item">
                        <a id="wishlist_producturl{{ $lienquan->product_id }}"
                            href="{{ URL::to('/products/' . $lienquan->product_slug) }}">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ URL::to('uploads/product/' . $lienquan->product_image) }}">
                                @if ($lienquan->product_tag == 1)
                                    <span class="label">
                                        Mới
                                    </span>
                                @elseif($lienquan->product_tag == 3)
                                    <span class="label">
                                        Khuyến mãi
                                    </span>
                                @else
                                @endif
                                @if ($lienquan->product_tag == 2)
                                    <div class="product_sold_out">
                                        <p>Sold out</p>
                                    </div>
                                @else
                                @endif
                            </div>
                        </a>
                        <input type="hidden" value="{{ $lienquan->product_id }}"
                            class="cart_product_id_{{ $lienquan->product_id }}">

                        <input type="hidden" id="wishlist_productname{{ $lienquan->product_id }}"
                            value="{{ $lienquan->product_name }}"
                            class="cart_product_name_{{ $lienquan->product_id }}">

                        <input type="hidden" id="wishlist_productprice{{ $lienquan->product_id }}"
                            value="{{ number_format($lienquan->product_price, 0, ',', '.') }}₫">

                        <img id="wishlist_productimage{{ $lienquan->product_id }}"
                            src="{{ URL::to('uploads/product/' . $lienquan->product_image) }}"
                            style="display:none;" />

                        <div class="product__item__text">
                            <h6>{{ $lienquan->product_name }}</h6>
                            <h5>{{ number_format($lienquan->product_price, 0, ',', '.') }}₫</h5>
                        </div>
                        <div class="product__item__text">
                            <div class="rating">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Related Section End -->
@endsection
