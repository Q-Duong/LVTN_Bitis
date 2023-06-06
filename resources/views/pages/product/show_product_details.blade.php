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
                        {{-- <span>Danh mục:</span> {{$product->category_product_name}} --}}
                        
                        <div class="product__details__option">
                                <!-- <div class="product__details__option__size">
                                    <span>Size:</span>
                                    <label for="xxl">xxl
                                        <input type="radio" id="xxl">
                                    </label>
                                    <label class="active" for="xl">xl
                                        <input type="radio" id="xl">
                                    </label>
                                    <label for="l">l
                                        <input type="radio" id="l">
                                    </label>
                                    <label for="sm">s
                                        <input type="radio" id="sm">
                                    </label>
                                </div> -->
                                <div class="product__details__option__color">
                                    <span>Màu:</span>
                                    <label class="c-1" for="sp-1">
                                        <input type="radio" id="sp-1">
                                    </label>
                                    <label class="c-2" for="sp-2">
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
                                    </label>
                                </div>
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

<!-- Related Section End -->
@endsection