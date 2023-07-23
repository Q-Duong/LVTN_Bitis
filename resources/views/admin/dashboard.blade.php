@extends('admin_layout')
@section('admin_content')
<div class="container-fluid">
    <div class="market-updates">
        <div class="col-md-3 market-update-gd">
            <a href="{{URL::to('/list-customer')}}">
                <div class="market-update-block clr-block-1">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-users"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Khách hàng</h4>
                        <h3>{{$app_customer}}</h3>
                        <p>Tổng số khách hàng đã đăng ký.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 market-update-gd">
            <a href="{{URL::to('/all-product')}}">
                <div class="market-update-block clr-block-3">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-usd"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Sản phẩm</h4>
                        <h3>{{$product_count}}</h3>
                        <p>Tổng số sản phẩm đã kinh doanh.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 market-update-gd">
            <a href="{{URL::to('/manage-order')}}">
                <div class="market-update-block clr-block-4">
                    <div class="col-md-4 market-update-right">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Đơn hàng</h4>
                        <h3>{{$order_count}}</h3>
                        <p>Tổng số đơn hàng đã nhận.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 market-update-gd">
            <a href="{{URL::to('/list-post')}}">
                <div class="market-update-block clr-block-2">
                    <div class="col-md-4 market-update-right">
                        <i class="fab fa-blogger-b"></i>
                    </div>
                    <div class="col-md-8 market-update-left">
                        <h4>Bài viết</h4>
                        <h3>{{$post_count}}</h3>
                        <p>Tổng bài viết có trên web.</p>
                    </div>
                    <div class="clearfix"> </div>
                </div>
            </a>
        </div>
        <div class="clearfix"> </div>
    </div>


    <div class="row chart_sta">
        <p class="title_statistical">Thống kê doanh thu</p>
        <div class="chart">
            <form autocomplete="off">
                <div class="col-md-12">
                    {{csrf_field()}}
                    <div class="col-md-3">
                        <p>Từ ngày: <input type="date" name="from_date" class="form-control"></p>
                        </p>

                    </div>
                    <div class="col-md-3">
                        <p>Đến ngày: <input type="date" name="to_date" class="form-control"></p>
                    </div>
                    <div class="col-md-3">
                        <p>
                            <input type="button" class="btn btn-primary filter"
                                value="Lọc kết quả">
                        </p>
                    </div>
                </div>
            </form>
            <div class="col-md-12">
                <div id="chart" style="height: 280px;"></div>
            </div>
        </div>
    </div>
</div>

@endsection