
@foreach ($filter_unique as $key => $product)
    <div class="col-lg-4 col-md-6 col-sm-6">
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
            <input type="hidden" value="{{ $product->product_id }}" class="cart_product_id_{{ $product->product_id }}">

            <input type="hidden" id="wishlist_productname{{ $product->product_id }}" value="{{ $product->product_name }}"
                                        class="cart_product_name_{{ $product->product_id }}">

            <input type="hidden" id="wishlist_productprice{{ $product->product_id }}" value="{{ number_format($product->product_price, 0, ',', '.') }}₫">

            <img id="wishlist_productimage{{ $product->product_id }}" src="{{ URL::to('uploads/product/' . $product->product_image) }}" style="display:none;" />

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